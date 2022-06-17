<?php


namespace App\Model\Base;


interface IBaseModel
{
    // public function selectOne();
    // public function selectMany();
    public function create();
    public function update();
    public function delete();
}
