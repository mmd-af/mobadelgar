<?php

namespace App\Http\Controllers\Site\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Site\HomeRepository;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;

class HomeController extends Controller
{

    protected $HomeRepository;

    public function __construct(HomeRepository $HomeRepository)
    {
        $this->HomeRepository = $HomeRepository;
    }

    public function homeIndex()
    {
        SEOMeta::setTitle('در حال راه اندازی');
        SEOMeta::setDescription('در حال راه اندازی');
        SEOMeta::setCanonical(url('/'));

        OpenGraph::setDescription('در حال راه اندازی');
        OpenGraph::setTitle('در حال راه اندازی');
        OpenGraph::setUrl(url('/'));
        OpenGraph::addProperty('type', 'articles');

        JsonLd::setTitle('در حال راه اندازی');
        JsonLd::setDescription('در حال راه اندازی');
//        JsonLd::addImage('https://codecasts.com.br/img/logo.jpg');

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
