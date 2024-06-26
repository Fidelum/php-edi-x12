<?php

namespace Mrstroz;


use Mrstroz\Edi\Document;

/**
 * A class to parse ASC X12 EDI documents
 */
class Edi
{

    public const SEGMENT_TERMINATOR_POSITION = 105;
    public const SUBELEMENT_SEPARATOR_POSITION = 104;
    public const ELEMENT_SEPARATOR_POSITION = 3;

    public static $segmentMapping = [
        'AK1' => 'Mrstroz\Edi\Segments\Ak1Segment',
        'AK2' => 'Mrstroz\Edi\Segments\Ak2Segment',
        'AK3' => 'Mrstroz\Edi\Segments\Ak3Segment',
        'AK4' => 'Mrstroz\Edi\Segments\Ak4Segment',
        'AK5' => 'Mrstroz\Edi\Segments\Ak5Segment',
        'AK9' => 'Mrstroz\Edi\Segments\Ak9Segment',
        'AMT' => 'Mrstroz\Edi\Segments\AmtSegment',
        'B3' => 'Mrstroz\Edi\Segments\B3Segment',
        'B4' => 'Mrstroz\Edi\Segments\B4Segment',
        'BEG' => 'Mrstroz\Edi\Segments\BegSegment',
        'C3' => 'Mrstroz\Edi\Segments\C3Segment',
        'CTT' => 'Mrstroz\Edi\Segments\CttSegment',
        'DTM' => 'Mrstroz\Edi\Segments\DtmSegment',
        'FOB' => 'Mrstroz\Edi\Segments\FobSegment',
        'GE' => 'Mrstroz\Edi\Segments\GeSegment',
        'GS' => 'Mrstroz\Edi\Segments\GsSegment',
        'IEA' => 'Mrstroz\Edi\Segments\IeaSegment',
        'ISA' => 'Mrstroz\Edi\Segments\IsaSegment',
        'L0' => 'Mrstroz\Edi\Segments\L0Segment',
        'L1' => 'Mrstroz\Edi\Segments\L1Segment',
        'L3' => 'Mrstroz\Edi\Segments\L3Segment',
        'LX' => 'Mrstroz\Edi\Segments\LXSegment',
        'MSG' => 'Mrstroz\Edi\Segments\MsgSegment',
        'N1' => 'Mrstroz\Edi\Segments\N1Segment',
        'N2' => 'Mrstroz\Edi\Segments\N2Segment',
        'N3' => 'Mrstroz\Edi\Segments\N3Segment',
        'N4' => 'Mrstroz\Edi\Segments\N4Segment',
        'N7' => 'Mrstroz\Edi\Segments\N7Segment',
        'N9' => 'Mrstroz\Edi\Segments\N9Segment',
        'PER' => 'Mrstroz\Edi\Segments\PerSegment',
        'PID' => 'Mrstroz\Edi\Segments\PidSegment',
        'PO1' => 'Mrstroz\Edi\Segments\Po1Segment',
        'Q2' => 'Mrstroz\Edi\Segments\Q2Segment',
        'R3' => 'Mrstroz\Edi\Segments\R3Segment',
        'R4' => 'Mrstroz\Edi\Segments\R4Segment',
        'REF' => 'Mrstroz\Edi\Segments\RefSegment',
        'S5' => 'Mrstroz\Edi\Segments\S5Segment',
        'SAC' => 'Mrstroz\Edi\Segments\SacSegment',
        'SE' => 'Mrstroz\Edi\Segments\SeSegment',
        'ST' => 'Mrstroz\Edi\Segments\StSegment',
        'TC2' => 'Mrstroz\Edi\Segments\Tc2Segment',
        'TD1' => 'Mrstroz\Edi\Segments\Td1Segment',
        'TD4' => 'Mrstroz\Edi\Segments\Td4Segment',
        'TD5' => 'Mrstroz\Edi\Segments\Td5Segment',
    ];

    /**
     * Parse an EDI document. Data will be returned as an array of instances of
     * EDI\Document. Document should contain exactly one ISA/IEA envelope.
     */
    public static function parse($res)
    {
        if (!$res) {
            throw new \Exception('No resource or string passed to parse()');
        }

        $documents = array();
        if (is_resource($res)) {
            $meta = stream_get_meta_data($res);
            if (!$meta['seekable']) {
                throw new \Exception('Stream is not seekable');
            }

            throw new \Exception('Not implemented!');
        } else {
            $data = $res;
            // treat as string.
            if (strcasecmp(substr($data, 0, 3), 'ISA') != 0) {
                throw new \Exception('ISA segment not found in data stream');
            }

            $segment_terminator = substr($data, self::SEGMENT_TERMINATOR_POSITION, 1);
            $element_separator = substr($data, self::ELEMENT_SEPARATOR_POSITION, 1);
            $subelement_separator = substr($data, self::SUBELEMENT_SEPARATOR_POSITION, 1);

            $raw_segments = explode($segment_terminator, $data);
        }

        $current_isa = null;
        $current_gs = null;
        $current_st = null;

        foreach ($raw_segments as $segment) {
            $elements = array_map('trim', explode($element_separator, $segment));
            $identifier = strtoupper($elements[0]);

            // only inspect each element if the subelement separator is present in the string
            if (strpos($segment, $subelement_separator) !== FALSE && $identifier != 'ISA') {
                foreach ($elements as &$element) {
                    if (strpos($segment, $subelement_separator) !== FALSE) {
                        $element = explode($subelement_separator, $element);
                    }
                }
                unset($element);
            }

            /* This is a ginormous switch statement, but necessarily so. 
            * The idea is that the parser will, for each transaction set
            * in the ISA envelope, create a new Document instance with 
            * the containing ISA and GS envelopes copied in.
            */
            switch ($identifier) {
                case 'ISA':
                    $current_isa = array('isa' => $elements);
                    break;
                case 'GS':
                    $current_gs = array('gs' => $elements);
                    break;
                case 'ST':
                    $current_st = array('st' => $elements);
                    break;
                case 'SE':
                    assert($current_gs != null, 'GS data structure isset');
                    $current_st['se'] = $elements;
                    if (!isset($current_gs['txn_sets'])) {
                        $current_gs['txn_sets'] = array();
                    }
                    array_push($current_gs['txn_sets'], $current_st);
                    $current_st = null;
                    break;
                case 'GE':
                    assert($current_isa != null, 'ST data structure isset');
                    $current_gs['ge'] = $elements;
                    if (!isset($current_isa['func_groups'])) {
                        $current_isa['func_groups'] = array();
                    }
                    array_push($current_isa['func_groups'], $current_gs);
                    $current_gs = null;
                    break;
                case 'IEA':
                    $current_isa['iea'] = $elements;
                    foreach ($current_isa['func_groups'] as $gs) {
                        foreach ($gs['txn_sets'] as $st) {
                            $segments = array_merge(
                                array(
                                    $current_isa['isa'],
                                    $gs['gs'],
                                    $st['st']
                                ),
                                $st['segments'],
                                array(
                                    $st['se'],
                                    $gs['ge'],
                                    $current_isa['iea']
                                )
                            );
                            $document = new Document($segments);
                            array_push($documents, $document);
                        }
                    }
                    break;
                default:
                    if (!isset($current_st['segments'])) {
                        $current_st['segments'] = array();
                    }
                    array_push($current_st['segments'], $elements);
                    break;
            }
        }

        return $documents;
    }

    /**
     * @param $file
     * @return array
     * @throws \Exception
     */
    public static function parseFile($file)
    {
        $contents = file_get_contents($file);
        return self::parse($contents);
    }
}
