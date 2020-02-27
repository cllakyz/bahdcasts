<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use SEO;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Seo generate function
     *
     * @param $title
     * @param $description
     */
    public function setSeo($title, $description) {
        SEO::setTitle($title);
        SEO::setDescription($description);
        SEO::opengraph()->setUrl(request()->url());
        SEO::setCanonical(request()->url());
        SEO::opengraph()->addProperty('type', 'screencasts');
        SEO::twitter()->setSite('@bahdcasts');
    }
}
