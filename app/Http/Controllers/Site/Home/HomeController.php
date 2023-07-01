<?php

namespace App\Http\Controllers\Site\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Site\HomeRepository;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class HomeController extends Controller
{

    protected $HomeRepository;

    public function __construct(HomeRepository $HomeRepository)
    {
        $this->HomeRepository = $HomeRepository;
    }

    public function homeIndex()
    {
        SEOMeta::setTitle('مبدل گر - خواهش میکنم - فلان و هر چیزی که به ذهنت میاد');
        SEOMeta::setDescription('This is my page description');
        SEOMeta::setCanonical('https://codecasts.com.br/lesson');

        OpenGraph::setDescription('This is my page description');
        OpenGraph::setTitle('Home');
        OpenGraph::setUrl('http://current.url.com');
        OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle('Homepage');
        TwitterCard::setSite('@LuizVinicius73');

        JsonLd::setTitle('Homepage');
        JsonLd::setDescription('This is my page description');
        JsonLd::addImage('https://codecasts.com.br/img/logo.jpg');


        JsonLdMulti::setTitle("title");
        JsonLdMulti::setDescription("description");
        JsonLdMulti::setType('Article');

        return view('site.home.index');
    }

    public function aboutus()
    {
//        $services = $this->HomeRepository->getServices();
//        $this->HomeRepository->getHomeSeoTools();
//        $getJsonLd = $this->HomeRepository->getAboutJsonLd();
//        return view('site.pages.about', compact('getJsonLd', 'services'));
    }
}
