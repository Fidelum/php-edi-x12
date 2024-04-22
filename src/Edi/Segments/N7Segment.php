<?php

namespace Mrstroz\Edi\Segments;

use Mrstroz\Edi\Segment;

/**
 * Class N7Segment
 * @package Mrstroz\Edi\Segments
 */
class N7Segment extends Segment
{
    public $segmentMapping = [
        0 => parent::EDI_QUALIFIER_KEY, //Equipment Information
        1 => 'equipment_initial',
        2 => 'equipment_number',
        3 => 'weight',
        4 => 'weight_qualifier',
        5 => 'tare_weight',
        6 => 'weight_allowance',
        7 => 'dunnage',
        8 => 'volume',
        9 => 'volume_unit_qualifier',
        10 => 'ownership_code',
        11 => 'equipment_description_code',
        12 => 'standard_carrier_alpha_code',
        13 => 'standard_carrier_alpha_code',
        14 => 'position',
        15 => 'equipment_length',
        16 => 'tare_qualifier_code',
        17 => 'weight_unit_code',
        18 => 'equipment_number_check_digit',
        19 => 'type_of_service_code',
        20 => 'height',
        21 => 'width',
        22 => 'equipment_type',
        23 => 'standard_carrier_alpha_code',
        24 => 'car_type_code',
    ];
}