<?php
namespace App\Lib;

class LocalizedNumber2Number
{

    // TODO refactor this into a Behaviour

    public static function change($localizedNumber)
    {
        $localizedNumber = str_replace(' ', '', $localizedNumber);
        $localizedNumber = str_replace(',', '.', $localizedNumber);
        return $localizedNumber;
    }
}
