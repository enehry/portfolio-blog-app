<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /*
    * Permissions
    */

    const CATEGORY_ACCESS = 'category_access';
    const CATEGORY_CREATE = 'category_create';
    const CATEGORY_EDIT = 'category_edit';
    const CATEGORY_DELETE = 'category_delete';
    const CATEGORY_VIEW = 'category_view';

    protected $fillable = [
        'name',
        'slug',
        'color',
    ];

    public function posts() : HasMany
    {
        return $this->hasMany(Post::class);
    }
}
