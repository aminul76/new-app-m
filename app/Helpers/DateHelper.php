<?php

namespace App\Helpers;

class DateHelper
{
    public static function toBengaliNumerals($string)
    {
        $search = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $replace = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        return str_replace($search, $replace, $string);
    }

    public static function toBengaliMonth($month)
    {
        $months = [
            'January' => 'জানুয়ারী',
            'February' => 'ফেব্রুয়ারী',
            'March' => 'মার্চ',
            'April' => 'এপ্রিল',
            'May' => 'মে',
            'June' => 'জুন',
            'July' => 'জুলাই',
            'August' => 'আগস্ট',
            'September' => 'সেপ্টেম্বর',
            'October' => 'অক্টোবর',
            'November' => 'নভেম্বর',
            'December' => 'ডিসেম্বর',
        ];
        return $months[$month] ?? $month;
    }
}
