<?php

namespace App\Core\Traits;

use App\Models\Post;
use \Cviebrock\EloquentSluggable\Services\SlugService;

trait SlugTrait
{
    protected function getSlug($slug, $column = 'slug', $option = ['unique' => false])
    {
        return SlugService::createSlug(Post::class, $column, $slug, $option);
    }
}
