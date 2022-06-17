<?php


namespace App\Util;


class FilterPayload
{
    public $sortBy = '';
    public $sortDesc = false;
    public $page = 1;
    public $pageSize = 50;
    public $itemsPerPage = 50;
    public $filters = [];

    public static function parse(array $payload): FilterPayload
    {
        $keys = ['sortBy', 'sortDesc', 'page', 'itemsPerPage'];
        $fp = new self;
        $fp->sortBy = Arr::get($payload, 'sortBy', '');
        $fp->sortDesc = Arr::get($payload, 'sortDesc', false);
        $fp->page = Arr::get($payload, 'page', 1);
        $fp->itemsPerPage = Arr::get($payload, 'itemsPerPage', 50);
        $fp->pageSize = Arr::get($payload, 'itemsPerPage', 50);
        $fp->filters = array_filter($payload, static function($v, $k) use ($keys) {
            if (!in_array($k, $keys, true)) {
               return true;
            }
            return false;
        }, \ARRAY_FILTER_USE_BOTH);

        return $fp;
    }
}
