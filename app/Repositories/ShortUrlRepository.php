<?php

namespace App\Repositories;

use App\Interfaces\ShortUrlInterface;

use App\Models\Url;
use Exception;

class ShortUrlRepository implements ShortUrlInterface
{
    public function checkRedirection($url) {
        $redirection = Url::select('long_url')->where('short_url', $url)->get()->first();

        if($redirection->isEmpty()){
            throw new Exception("Url passed not exist, redirection failed");
        }

        return $redirection->short_url;
    }

    public function getAllUrl() {
        $all = Url::all();
        return $all;
    }

    public function createNewUrl($long) {

        $exist = Url::where('long_url', $long)->get()->first();

        if($exist->isEmpty()) {

            $this->shortUrlGenerator = app()->make('shorterUrlGeneratorHelper');
            $short = $this->shortUrlGenerator->generate($long);

            $n            = new Url();
            $n->long_url  = $long;
            $n->short_url = $short;

            if($n->save()) {
                return $short;
            }
        }

        return false;
    }

    public function deleteUrl($id) {
        $url = Url::find($id);

        if(!$url->delete()) {
            throw new Exception("Failded to delete url id: ".$id);
        }
        return true;
    }

    public function getSingleRedirection($id) {
        $url = Url::find($id);

        if($url->isEmpty()) {
            throw new Exception("Url id not found");
        }
        return $url->redirect;
    }

    public function getAllRedirection() {
        return Url::sum('redirect');
    }

}
