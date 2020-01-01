<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Core\Repositories\TagReporsitory;
use App\Http\Requests\StoreTag as RequestStoreTag;
use App\Http\Requests\UpdateTag as RequestUpdateTag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagReporsitory;

    public function __construct(TagReporsitory $tagReporsitory)
    {
        $this->tagReporsitory = $tagReporsitory;
    }
}
