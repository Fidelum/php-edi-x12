<?php

namespace Mrstroz\Edi\Segments;

use Mrstroz\Edi\Segment;

/**
 * Class R3Segment
 * @package Mrstroz\Edi\Segments
 */
class R3Segment extends Segment
{
    public $segmentMapping = [
        0 => parent::EDI_QUALIFIER_KEY, // Route Information
        1 => 'standard_carrier_alpha_code',
        2 => 'routing_sequence_code',
        3 => 'city_name',
        4 => 'transportation_method_type_code',
        5 => 'standard_point_location_code',
        6 => 'invoice_number',
        7 => 'route_date',
        8 => 'amount',
        9 => 'freeform_description',
        10 => 'service_level_code',
        11 => 'service_level_code2',
        12 => 'service_level_code3',
    ];
}