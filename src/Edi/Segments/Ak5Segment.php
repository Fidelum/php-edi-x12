<?php

namespace Mrstroz\Edi\Segments;

use Mrstroz\Edi\Segment;

/**
 * Class Ak5Segment
 * @package Mrstroz\Edi\Segments
 */
class Ak5Segment extends Segment
{
    public $segmentMapping = [
        0 => parent::EDI_QUALIFIER_KEY, //To specify basic and most frequently used line item data
        1 => 'transaction_ack_code', //Code indicating accept or reject condition, A or E = accepted
        2 => 'transaction_syntax_error_code', //Code indicating error found based on the syntax editing of a transaction set
        3 => 'transaction_syntax_error_code2', //Code indicating error found based on the syntax editing of a transaction set
        4 => 'transaction_syntax_error_code3', //Code indicating error found based on the syntax editing of a transaction set
        5 => 'transaction_syntax_error_code4', //Code indicating error found based on the syntax editing of a transaction set
        6 => 'transaction_syntax_error_code5', //Code indicating error found based on the syntax editing of a transaction set
    ];
}