<?php

namespace App\Helpers;

class FileHelper {
    public static function generateRandomString()
    {
        $character  = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $characterLenght    = strlen($character); 
        $randomCode = '';
        
        for($i=0;$i<10;$i++)
        {
            // concat assigment (.=)
            //  (-=) berfungsi untuk menggabungkan tipe data string dengan string
            $randomCode .= $character[rand(0, $characterLenght - 1)];
        }

        return $randomCode;
    }
    
}