<?php


namespace App\Util;


class Crypto
{
    private static $_FC42_IV = "\x70\x84\x06\x1A\xC9\x20\x96\x8E\x1D\x09\xA0\x90\x98\x11\xCA\x40";
    private static string $_FC42_PS = "DsysGzICH4ReLfc.OPrRYfcUgfdv6JqW";
    private static string $method = 'aes-256-cbc';

    public static function encrypt(string $plainText)
    {
        try {

            return base64_encode(openssl_encrypt($plainText, static::$method, static::$_FC42_PS, OPENSSL_RAW_DATA, static::$_FC42_IV));
        } catch (\Exception $ex) {
            return "";
        }
    }

    public static function decrypt(string $cypherText)
    {
        try {
            return openssl_decrypt(base64_decode($cypherText), static::$method, static::$_FC42_PS, OPENSSL_RAW_DATA, static::$_FC42_IV);
        } catch (\Exception $ex) {
            return "";
        }
    }
}