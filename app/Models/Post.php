<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'published',
        'published_at',
        'thumbnail',
        'thumbnail_caption',
        'thumbnail_alt',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'post_category',
            'post_id',
            'category_id',
        );
    }
}
