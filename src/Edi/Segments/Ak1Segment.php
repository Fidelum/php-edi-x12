<?php

namespace Mrstroz\Edi\Segments;

use Mrstroz\Edi\Segment;

/**
 * Class Ak1Segment
 * @package Mrstroz\Edi\Segments
 */
class Ak1Segment extends Segment
{
    public $segmentMapping = [
        0 => parent::EDI_QUALIFIER_KEY, //To specify basic and most frequently used line item data
        1 => 'functional_identifier_code', //Code identifying a group of application related transaction sets
        2 => 'group_control_number', //Assigned number
        3 => 'identifier_code', //Code indicating the version, release, subrelease, and industry identifier of the EDI standard
    ];
}