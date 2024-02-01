<?php

namespace App\Helpers;

class Utils
{
    //valida si un elemento esta checkeado
    public static function validar_check(string $checkeado, $elementos)
    {
        if ($elementos != null) {
            $array_elementos = explode(',', $elementos);

            foreach ($array_elementos as $elemento) {
                if ((trim($elemento) === trim($checkeado))) {
                    return true;
                }
            }
        }
        return false;
    }
}
