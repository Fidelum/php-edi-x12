<?php

namespace Mrstroz\Edi\Segments;

use Mrstroz\Edi\Segment;

/**
 * Class LXSegment
 * @package Mrstroz\Edi\Segments
 */
class LXSegment extends Segment
{
    public $segmentMapping = [
        0 => parent::EDI_QUALIFIER_KEY,
        1 => 'assigned_number',
    ];
}