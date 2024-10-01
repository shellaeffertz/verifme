<?php

namespace App\Utilities;

class EmailUtility
{
    public static function getProccessedGmail($email)
    {
        if ($email) {
            if (strpos($email, '@gmail.com') !== false) {
                $username = explode('@gmail.com', $email)[0];
                $username = str_replace('.', '', $username);
                $username = str_replace('+', '', $username);
                return $username . '@gmail.com';
            }
        }
        return $email;
    }
}