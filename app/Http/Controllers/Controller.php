<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $langs;

    public function __construct() {

        //Language
        $this->langs = array(

            "en" => "en",
            "de" => "de",
            "it" => "it",

        );
    }

    public function cutLocation($langs) {

        if (($key = array_search(app()->getLocale(), $langs)) !== false) {

            unset($langs[$key]);

        }

        return $langs;
    }
}
