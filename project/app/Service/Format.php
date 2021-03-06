<?php
namespace App\Service;


class Format
{
   public static function formatMoneyNumber($amount)
   {
       return number_format( ($amount/100), 2,'.','');
   }

   public static function formatMoney($amount)
   {
       return round($amount /100,2);
   }

    public static function formatFormMoney($amount)
    {
        if(!is_numeric($amount)) {
            return null;
        }

        return floor($amount * 100);
    }
}
