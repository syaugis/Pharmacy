<?php

namespace App\Helpers;

class OrderHelpers
{
    public static function getStatus($id)
    {
        $statusDescriptions = [
            1 => 'Not Paid',
            2 => 'Already Pay',
            3 => 'Cancelled',
        ];

        return $statusDescriptions[$id];
    }
}
