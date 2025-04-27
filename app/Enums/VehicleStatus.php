<?php

namespace App\Enums;

enum VehicleStatus:string {

    case AVAILABLE ='available';
    case IN_USE ='in_use';
    case MAINTENANCE = 'maintenance';
    case OUT_OF_SERVICE ='out_of_service';

    public static function getStatus(): array
    {
        return array_column(self::cases(), 'value');
    }


}