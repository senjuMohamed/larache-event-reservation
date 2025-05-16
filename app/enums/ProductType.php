<?php

namespace App\Enums;

enum ProductType: string
{
    case SERVICE = 'service';
    case STOCKABLE = 'produit';

    // Method to get all values of the enum
    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
