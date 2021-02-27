<?php

namespace App\Interfaces;

interface ShortUrlInterface {
    public function checkRedirection($url);
    public function getAllUrl();
    public function createNewUrl($long);
    public function deleteUrl($id);
    public function getSingleRedirection($id);
    public function getAllRedirection();
}
