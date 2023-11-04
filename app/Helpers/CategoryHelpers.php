<?php

namespace App\Helpers;

class CategoryHelpers
{
    public static function getCategoryDescriptions($id)
    {
        $categoryDescriptions = [
            1 => 'Tablet',
            2 => 'Pcs',
        ];

        return "/ " . $categoryDescriptions[$id];
    }
}
