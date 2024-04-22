<?php

namespace Mrstroz\Edi\Segments;

use Mrstroz\Edi\Segment;

/**
 * Class B3Segment
 * @package Mrstroz\Edi\Segments
 */
class B3Segment extends Segment
{
    public $segmentMapping = [
        0 => parent::EDI_QUALIFIER_KEY, // Invoice Information
        1 => 'shipment_qualifier',
        2 => 'invoice_number',
        3 => 'carrier_generated_invoice',
        4 => 'shipment_method_of_payment',
        5 => 'weight_unit_code',
        6 => 'invoice_date',
        7 => 'net_amount_due',
        8 => 'correction_indicator',
        9 => 'delivery_date',
        10 => 'delivery_date_qualifier',
        11 => 'standard_carrier_alpha_code',
        12 => 'ship_date',
        13 => 'tariff_service_code',
        14 => 'transportation_terms_code',
    ];
}