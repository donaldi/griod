<?php
namespace KateMorley\Grid\UI;

class GDate
{
    public static function fmt(string $fmtPattern, int $time): string
    {
        // only going to handle the minimum fmt patterns needed by the code
        // IntlDateFormatter should be the way to do this but in my tests it
        // didn't work for all required patterns on the live server. Also,
        // due to bug in Gaelic localisation for linux days of the week are
        // spelt incorrectly.
        $tAbbr = "m";
        if (date("G", $time) > 11) {
            $tAbbr = "f";
        }
        if ($fmtPattern == "a") {
            return $tAbbr;
        }
        if ($fmtPattern == "g:ia") {
            return date("g:i", $time) . $tAbbr;
        }
        if ($fmtPattern == "jS F Y") {
            $d = date("j", $time);
            $F = self::m2ms(intval(date("n", $time)) - 1);
            return $d . " " . $F . " " . date("Y", $time);
        }
        if ($fmtPattern == "l") {
            return self::d2ds(intval(date("w", $time)));
        }

        return date($fmtPattern, $time);
    }

    private static function d2ds(int $d): string
    {
        switch ($d) {
            case 0:
                return "Didòmhnaich";
            case 1:
                return "Diluain";
            case 2:
                return "Dimàirt";
            case 3:
                return "Diciadain";
            case 4:
                return "Diardaoin";
            case 5:
                return "Dihaoine";
            case 6:
                return "Disathairne";
        }
        return "Err";
    }
    private static function m2ms(int $m): string
    {
        switch ($m) {
            case 0:
                return "Faoilleach";
            case 1:
                return "Gearran";
            case 2:
                return "Màrt";
            case 3:
                return "Giblean";
            case 4:
                return "Cèitean";
            case 5:
                return "Ògmhios";
            case 6:
                return "Iuchar";
            case 7:
                return "Lùnastal";
            case 8:
                return "Sultain";
            case 9:
                return "Dàmhair";
            case 10:
                return "Samhain";
            case 11:
                return "Dùbhlachd";
        }
        return "Err";
    }
}
?>
