<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Core\Repositories\PostReporsitory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePost as RequestStorePost;
use App\Http\Requests\UpdatePost as RequestUpdatePost;
use App\Http\Resources\Post as PostResource;

use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postReporsitory;

    public function __construct(PostReporsitory $postReporsitory)
    {
        $this->postReporsitory = $postReporsitory;
        $this->middleware('checkIsOwner')->only('update', 'destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postReporsitory->listPost();

        $response = PostResource::collection($posts);
        return response($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StorePost  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStorePost $request)
    {
        $newPost = $this->postReporsitory->storePost($request);

        $response = new PostResource($newPost);
        return response($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = $this->postReporsitory->showPostBySlug($slug, 'slug');

        $response = new PostResource($post);
        return response($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdatePost  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post, RequestUpdatePost $request)
    {
        $this->postReporsitory->updatePost($post, $request);

        $response = new PostResource($post);
        return response($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->comments()->delete();
        $post->delete();

        return response(null, 204);
    }
}
