<?php

namespace Mrstroz\Edi\Segments;

use Mrstroz\Edi\Segment;

/**
 * Class Ak2Segment
 * @package Mrstroz\Edi\Segments
 */
class Ak2Segment extends Segment
{
    public $segmentMapping = [
        0 => parent::EDI_QUALIFIER_KEY, //To specify basic and most frequently used line item data
        1 => 'transaction_identifier_code', //Code identifying a Transaction Set
        2 => 'transaction_control_number', //Identifying control number
        3 => 'implementation_convention_ref', //Reference assigned to identify Implementation Convention
    ];
}