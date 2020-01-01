<?php

namespace App\Core\Repositories;

use Carbon\Carbon;

use App\Models\Tag;
use App\Core\Repositories\Repository;
use App\Http\Requests\StoreTag as RequestStoreTag;
use App\Http\Requests\UpdateTag as RequestUpdateTag;
use App\Http\Resources\Tag as TagResource;
use App\Core\Traits\SlugTrait;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagReporsitory extends Repository
{
    use SlugTrait;

    protected $model = Tag::class;

    protected $onlyAttribute = [
        'meta_title', 'title', 'slug', 'content',
    ];

    public function listTag()
    {
        return $this->all();
    }

    public function storeTag(RequestStoreTag $request)
    {
        $data = $this->getInputValues($request);

        return $this->create($data);
    }

    public function updateTag(Tag $tag, RequestUpdateTag $request)
    {
        $data = $this->getInputValues($request);
        $tag->update($data);
    }

    protected function getInputValues($request)
    {
        $data = $request->only($this->onlyAttribute);
        $data['title'] = $request['title'];
        $data['meta_title'] = $request->get['meta_title'];
        $data['slug'] = $this->getSlug($request['slug']);
        $data['content'] = $request['content'];
        $data['published_at'] = $request->published ? Carbon::now()->toDateTimeString() : null;

        return $data;
    }

    public function showTag($value)
    {
        return $this->firstOrFail($value);
    }

    public function showTagBySlug($value)
    {
        return $this->firstOrFail($value, 'slug');
    }
}
