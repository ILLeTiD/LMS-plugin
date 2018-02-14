<?php

namespace LmsPlugin\Models;

class Section
{
    const LINK_TARGET_OPTIONS = [
        '_blank' => 'New tab',
        '_self' => 'Same window'
    ];

    const IMAGE_ALIGNMENT_OPTIONS = [
        'center center' => 'center center',
        'top center' => 'top center',
        'bottom center' => 'bottom center',
        'center left' => 'center left',
        'top left' => 'top left',
        'bottom left' => 'bottom left',
        'center right' => 'center right',
        'top right' => 'top right',
        'bottom right' => 'bottom right',
    ];
}