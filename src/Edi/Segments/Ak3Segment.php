<?php

namespace Mrstroz\Edi\Segments;

use Mrstroz\Edi\Segment;

/**
 * Class Ak3Segment
 * @package Mrstroz\Edi\Segments
 */
class Ak3Segment extends Segment
{
    public $segmentMapping = [
        0 => parent::EDI_QUALIFIER_KEY, //To specify basic and most frequently used line item data
        1 => 'segment_id_code', //Code specifying the segment ID of the data segment in error
        2 => 'segment_position', //The numerical count position of this data segment from the start of the transaction set: the transaction set header is count position 1
        3 => 'loop_identifier_code', //The loop ID number given on the transaction set diagram is the value for this data element in segments LS and LE
        4 => 'segment_syntax_error_code', //Code indicating error found based on the syntax editing of a segment
    ];
}