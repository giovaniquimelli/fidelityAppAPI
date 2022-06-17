<?php


namespace App\Doctrine\Types;


use DateTime;

class Date extends \DateTime
{
    public static function fromDateTime(\DateTimeInterface $dateTime): Date
    {
        $dt = new self();
        $dt->setTimestamp($dateTime->getTimestamp());
        return $dt;
    }

    public static function createFromFormat($format, $time, \DateTimeZone $timezone = null): Date
    {
        return self::fromDateTime(\DateTime::createFromFormat($format, $time, $timezone));
    }

    public static function createDate($format, $date, \DateTimeZone $timezone = null): Date
    {
        $date_time = DateTime::createFromFormat($format, $date, $timezone);
        return self::createFromFormat($format, $date_time, $timezone);
    }

    public function toDateTime(): DateTime
    {
        return (new \DateTime())->setTimestamp($this->getTimestamp());
    }
}
