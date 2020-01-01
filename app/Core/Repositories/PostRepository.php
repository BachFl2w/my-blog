<?php

namespace App\Core\Repositories;

use Carbon\Carbon;

use App\Models\Post;
use App\Core\Repositories\Repository;
use App\Http\Requests\StorePost as RequestStorePost;
use App\Http\Requests\UpdatePost as RequestUpdatePost;
use App\Http\Resources\Post as PostResource;
use App\Core\Traits\SlugTrait;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostReporsitory extends Repository
{
    use SlugTrait;

    protected $model = Post::class;

    protected $onlyAttribute = [
        'parent_id', 'title', 'summary', 'published', 'content',
    ];

    public function listPost()
    {
        return $this->all()->load('user');
    }

    public function storePost(RequestStorePost $request)
    {
        $data = $this->getInputValues($request);

        return $this->create($data);
    }

    public function updatePost(Post $post, RequestUpdatePost $request)
    {
        $data = $this->getInputValues($request);
        $post->update($data);
    }

    protected function getInputValues($request)
    {
        $data = $request->only($this->onlyAttribute);
        $data['user_id'] = $request->user()->id;
        $data['meta_title'] = $request['title'];
        $data['slug'] = $this->getSlug($request['title']);
        $data['published_at'] = $request->published ? Carbon::now()->toDateTimeString() : null;

        return $data;
    }

    public function showPost($value)
    {
        return $this->firstOrFail($value);
    }

    public function showPostBySlug($value)
    {
        return $this->firstOrFail($value, 'slug');
    }
}
