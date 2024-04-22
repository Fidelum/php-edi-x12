<?php

namespace Mrstroz\Edi\Segments;

use Mrstroz\Edi\Segment;

/**
 * Class Ak4Segment
 * @package Mrstroz\Edi\Segments
 */
class Ak4Segment extends Segment
{
    public $segmentMapping = [
        0 => parent::EDI_QUALIFIER_KEY, //To specify basic and most frequently used line item data
        1 => 'segment_position', //This is used to indicate the relative position of a simple data element, or the relative position of a composite data structure with the relative position of the component within the composite data structure, in error
        2 => 'element_ref_code', //Code identifying the location of the data element in the Data Element Dictionary
        3 => 'element_syntax_error_code', //Code indicating the error found after syntax edits of a data element
        4 => 'bad_data_element', //This is a copy of the data element in error
    ];
}