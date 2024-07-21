<?php

namespace Mrstroz\Edi;

/**
 * Class Segment
 * @package Mrstroz\Edi
 */
class Segment implements SegmentInterface
{
    /**
     *  Array key used for EDI QUALIFIER
     */
    public const EDI_QUALIFIER_KEY = 'edi_qualifier';

    /**
     *  Array key used for EDI MAX_SEGMENTS
     */
    public const MAX_SEGMENTS_KEY = 'max_segments';

    /**
     * Map segment indexes into keys
     * @var array
     */
    public $segmentMapping = [];

    /**
     * List of functions that will be called during generate
     * @var array
     */
    public $callFunction = [];

    /**
     * Parse the segment content.
     * @param $segment
     * @return array
     */
    public function parse($segment): array
    {
        $content = [];
        foreach ($segment as $key => $value) {
            if (isset($this->segmentMapping[$key]) && $this->segmentMapping[$key]) {
                $content[$this->segmentMapping[$key]] = $value;
            }
        }
        return $content;
    }

    /**
     * Generate the segment line
     * @param $array
     * @return string
     */
    public function generate($array): string
    {
        $content = [];
        if (is_array($array)) {
            $segmentMapping = $this->segmentMapping;
            if (isset($array[self::MAX_SEGMENTS_KEY])) {
                $segmentMapping = array_slice($segmentMapping, 0, $array[self::MAX_SEGMENTS_KEY] + 1);
            }
            foreach ($segmentMapping as $index => $key) {
                $value = $array[$key] ?? '';
                // Remove line breaks
                $value = preg_replace("/\r\n|\r|\n/", " ", $value);
                // Remove asterisk (delimiter)
                $value = str_replace("*", "#", $value);
                if (isset($this->callFunction[$index])) {
                    $value = call_user_func_array($this->callFunction[$index]['name'], array_merge([$value], $this->callFunction[$index]['args']));
                }
                $content[] = $value;
            }
        }
        return implode('*', $content);
    }
}