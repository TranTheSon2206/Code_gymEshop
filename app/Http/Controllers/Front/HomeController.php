<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Product;
use App\Service\Blog\BlogServiceInterface;
use App\Service\Product\ProductServiceInterface;
use Illuminate\Http\Request;

class Homecontroller extends Controller
{
    private $productService;
    private $blogService;

    public function __construct(ProductServiceInterface $productService, BlogServiceInterface $blogService)
    {
        $this->productService=$productService;
        $this->blogService=$blogService;
    }

    public function index(){
        $featuredProducts = $this->productService->getFeaturedProducts();
        $blogs = $this->blogService->getRelatedBlogs();

        return view('front.index', compact('featuredProducts','blogs'));
    }
 }
