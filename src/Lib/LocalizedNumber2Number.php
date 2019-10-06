<?php
namespace App\Lib;

class LocalizedNumber2Number
{
    public static function change($localizedNumber)
    {
        $localizedNumber = str_replace(' ', '', $localizedNumber);
        $localizedNumber = str_replace(',', '.', $localizedNumber);
        return $localizedNumber;
    }
}
