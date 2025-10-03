<?php

namespace App\Http\Controllers\Site\Post;

use App\Http\Controllers\Controller;
use App\Repositories\Site\PostRepository;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->getAllPosts();
        SEOMeta::setTitle("");
        SEOMeta::setDescription("");
        OpenGraph::setTitle("");
        OpenGraph::setDescription("");
        OpenGraph::setUrl(route('site.posts.index'));
        OpenGraph::addImage("");
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', 'fa_IR');
        OpenGraph::setSiteName("مبدل گر");
        return view('site.posts.index', compact('posts'));
    }

    public function show($post)
    {
        $post = $this->postRepository->getPostBySlug($post);
        SEOMeta::setTitle($post->meta_title);
        SEOMeta::setDescription($post->meta_description);
        OpenGraph::setTitle($post->meta_title);
        OpenGraph::setDescription($post->meta_description);
        OpenGraph::setUrl(route('site.posts.show', $post->slug));
        OpenGraph::addImage($post->images->url, ['height' => 200, 'width' => 200]);
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', 'fa_IR');
        OpenGraph::setSiteName("مبدل گر");
        return view('site.posts.show', compact('post'));
    }
}
