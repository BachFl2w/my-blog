<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'published' => 'boolean',
        'published_at' => 'datetime:Y-m-d H:i',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'unique' => true,
            ]
        ];
    }

    /**
     * Get the meta title.
     *
     * @param  string  $value
     * @return string
     */
    public function getMetaTitleAttribute($value)
    {
        return env('APP_NAME') . ' | ' . $value;
    }

    public function lastest($column = 'id')
    {
        return $this->orderBy($column, 'desc');
    }

    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the comments for the blog post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withPivot('post_id', 'tag_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withPivot('post_id', 'category_id');
    }
}
