<?php

namespace App\Http\Controllers\Admin\Faq;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\FaqRepository;
use Illuminate\Http\Request;

class FaqAjaxController extends Controller
{
    protected $faqRepository;

    public function __construct(FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    public function destroy($faq)
    {
        $this->faqRepository->destroy($faq);
        return response()->json([
            'data' => $faq
        ]);
    }
}
