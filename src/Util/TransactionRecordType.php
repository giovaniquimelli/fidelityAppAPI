<?php


namespace App\Util;


class TransactionRecordType
{
    public const PURCHASE = 0;
    public const EXCHANGE = 1;
    public const INDICATION = 2;
    public const LOTTERY = 3;
    public const TRANSFER = 4;
    public const LOCK = 5;
    public const REVERSING = 6;
    public const EXPIRED = 7;
}
