<?php


namespace App\Service\Blog;

use App\Service\ServiceInterface;

interface BlogServiceInterface extends ServiceInterface{
    public function getRelatedBlogs($limit = 3);
}