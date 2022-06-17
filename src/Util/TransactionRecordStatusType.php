<?php


namespace App\Util;


class TransactionRecordStatusType
{
    public const OK = 0;
    public const CANCELLED = 1;
    public const CHARGED_BACK = 2; // or REVERSED
    public const LOCKED = 3;
}
