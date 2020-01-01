<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostMeta extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the post that owns the post meta.
     */
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
