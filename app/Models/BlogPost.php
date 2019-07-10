<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    //
    use SoftDeletes;//will show only rows that hasnt deleted_at attribute setted (if gettering data via ::all() function)

    protected $fillable = [
        'title', 'slug', 'category_id', 'excerpt', 'content_raw', 'is_published', 'pulbished_at', 'user_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongTo
     */
    public function category()
    {
        //принадлежит
        return $this->belongsTo(BlogCategory::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Realations\BelongTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
