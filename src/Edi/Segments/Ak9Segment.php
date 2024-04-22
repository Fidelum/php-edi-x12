<?php

namespace Mrstroz\Edi\Segments;

use Mrstroz\Edi\Segment;

/**
 * Class Ak9Segment
 * @package Mrstroz\Edi\Segments
 */
class Ak9Segment extends Segment
{
    public $segmentMapping = [
        0 => parent::EDI_QUALIFIER_KEY, //To specify basic and most frequently used line item data
        1 => 'group_ack_code', //Code indicating accept or reject condition, A or E = accepted
        2 => 'number_of_transactions', //Number of Transaction Sets Included - Total number of transaction sets included in the functional group or interchange (transmission) group terminated by the trailer containing this data element
        3 => 'number_of_transactions_received', //Number of Transaction Sets received
        4 => 'number_of_transactions_accepted', //Number of accepted Transaction Sets
        5 => 'group_syntax_error_code', //Code indicating error found based on the syntax editing of the functional group header and/or trailer
        6 => 'group_syntax_error_code2', //Code indicating error found based on the syntax editing of the functional group header and/or trailer
        7 => 'group_syntax_error_code3', //Code indicating error found based on the syntax editing of the functional group header and/or trailer
        8 => 'group_syntax_error_code4', //Code indicating error found based on the syntax editing of the functional group header and/or trailer
        9 => 'group_syntax_error_code5', //Code indicating error found based on the syntax editing of the functional group header and/or trailer
    ];
}