<?php

namespace App\Repositories;

use App\Interfaces\ShortUrlInterface;

use App\Models\Url;
use Exception;

class ShortUrlRepository implements ShortUrlInterface
{
    public function checkRedirection($url) {
        $redirection = Url::select('id','long_url','redirect')->where('short_url', $url)->get()->first();

        if(!$redirection){
            die("Url passed not exist, redirection failed");
        }
        $count  = $redirection->redirect +1;
        $update = Url::find($redirection->id);

        $update->redirect = $count;
        $update->save();

        return $redirection->long_url;
    }

    public function getAllUrl() {
        $all = Url::all();

        foreach ($all as $a) {
            $a->short_url = env('APP_URL').$a->short_url;
        }
        return $all;
    }

    public function createNewUrl($long) {

        $exist = Url::where('long_url', $long)->get()->first();

        if(!$exist) {
            $this->shortUrlGenerator = app()->make('ShorterGeneratorHelper');
            $short = $this->shortUrlGenerator->generate($long);

            $n            = new Url();
            $n->long_url  = $long;
            $n->short_url = $short;

            if($n->save()) {
                return env('APP_URL').$short;
            }
        }

        return false;
    }

    public function deleteUrl($id) {
        $url = Url::find($id);

        if(!$url->delete()) {
            die("Failded to delete url id: ".$id);
        }
        return true;
    }

    public function getSingleRedirection($id) {
        $url = Url::find($id);

        if(!$url) {
            die("Url id not found");
        }
        return $url->redirect;
    }

    public function getAllRedirection() {
        return Url::sum('redirect');
    }

}
