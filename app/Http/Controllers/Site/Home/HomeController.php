<?php

namespace App\Http\Controllers\Site\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Site\HomeRepository;
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
        SEOMeta::setTitle("ابزارهای آنلاین رایگان، سرگرمی ها و اطلاعات متنوع");
        SEOMeta::setDescription("جامع ترین بانک ابزارهای آنلاین رایگان، بازی های آنلاین، فال، نقشه، وضعیت آب و هوایی، تقویم و زمان، اطلاعات عمومی و کاربردی و...");
        OpenGraph::setTitle(" مبدل گر- ابزارهای آنلاین رایگان، سرگرمی ها و اطلاعات متنوع");
        OpenGraph::setDescription("جامع ترین بانک ابزارهای آنلاین رایگان، بازی های آنلاین، فال، نقشه، وضعیت آب و هوایی، تقویم و زمان، اطلاعات عمومی و کاربردی و...");
        OpenGraph::setUrl(url('/'));
//        OpenGraph::addImage(asset('logo/mobadelgarir.jpg'), ['height' => 200, 'width' => 1000]);
        OpenGraph::addImage(asset('logo/mobadelgarir-1.jpg'));
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', 'fa_IR');
        OpenGraph::setSiteName("مبدل گر");
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
