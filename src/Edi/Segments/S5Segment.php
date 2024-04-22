<?php

namespace Mrstroz\Edi\Segments;

use Mrstroz\Edi\Segment;

/**
 * Class S5Segment
 * @package Mrstroz\Edi\Segments
 */
class S5Segment extends Segment
{
    public $segmentMapping = [
        0 => parent::EDI_QUALIFIER_KEY, //Carrier Details (Routing Sequence/Transit Time),
        1 => 'stop_sequence_number', //Identifying number for the specific stop
        2 => 'stop_reason_code', // Code specifying the reason for the stop
        3 => 'weight', //Numeric value of weight
        4 => 'weight_unit_code', //Code specifying the weight unit
        5 => 'number_units_shipped', //Numeric value of units shipped
        6 => 'unit_basis_measurement_code', //Code specifying the units in which a value is being expressed
        7 => 'volume', //Value of volumetric measure
        8 => 'volume_unit_qualifier', //Code identifying the volume unit
        9 => 'description', //A free-form description to clarify the related data elements and their content
        10 => 'standard_point_location_code', //Code specifying the Standard Point Location code defined by the NMFTA/CTA
        11 => 'accomplish_code', //Code indicating the status of a specified stop
    ];
}