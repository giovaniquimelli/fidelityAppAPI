<?php


namespace App\Util;


class TransactionRecordExchangeStatusType
{
    public const PENDING = 0;
    public const FINALIZED = 1;
    public const REFUND = 2; // or REVERSED
    public const CANCELED = 3;
}
