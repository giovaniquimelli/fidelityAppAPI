<?php


namespace App\Doctrine\Types;


use DateTimeInterface;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;

class DateType extends \Doctrine\DBAL\Types\DateType
{
    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return Date|\DateTime|DateTimeInterface|false|mixed|null
     * @throws ConversionException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value instanceof DateTimeInterface) {
            return $value;
        }

        $val = Date::createFromFormat('!' . $platform->getDateFormatString(), $value);
        if (!$val) {
            throw ConversionException::conversionFailedFormat($value, $this->getName(), $platform->getDateFormatString());
        }

        return $val;
    }
}
