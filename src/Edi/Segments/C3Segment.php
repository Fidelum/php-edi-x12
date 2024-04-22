<?php

namespace Mrstroz\Edi\Segments;

use Mrstroz\Edi\Segment;

/**
 * Class C3Segment
 * @package Mrstroz\Edi\Segments
 */
class C3Segment extends Segment
{
    public $segmentMapping = [
        0 => parent::EDI_QUALIFIER_KEY, // Currency Information
        1 => 'billing_currency_code', // e.g. USD
        2 => 'exchange_rate', // Decimal conversion factor e.g. 1.21
        3 => 'payment_currency_code', // e.g. USD
        4 => 'rated_currency_code', // e.g. USD
    ];
}