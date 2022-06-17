<?php


namespace App\Util;


use Ramsey\Uuid\Uuid;

class Str
{
    public static function snakeToCamelCase($string)
    {
        return $string;
    }

    public static function getDataFromUniqueConstraintViolation($details): array
    {
        $matches = [];
        $pattern = '/(DETAIL:\s\sKey\s\()([\w]{1,})(\)\=\()([\w]{0,})(\)\salready exists\.)$/';
        preg_match_all($pattern, $details, $matches); // , PREG_OFFSET_CAPTURE, 0);
        $flattened = Arr::flatten($matches);
        return ['field' => $flattened[2], 'value' => $flattened[4]];
    }

    public static function asCamelCase(string $str): string
    {
        return lcfirst(self::asPascalCase($str));
    }

    public static function asPascalCase(string $str): string
    {
        return strtr(ucwords(strtr($str, ['_' => ' ', '.' => ' ', '\\' => ' '])), [' ' => '']);
    }

    public static function asSnakeCase(string $value): string
    {
        return strtolower(preg_replace(['/([A-Z]+)/', '/_([A-Z]+)([A-Z][a-z])/'], ['_$1', '_$1_$2'], lcfirst($value)));
    }

    public static function isValidUuid(string $str): bool
    {
        return Uuid::isValid($str);
    }

    public static function randomStringCode(
        int $length = 8,
        string $keyspace = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ): string
    {
        if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces [] = $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }
}
