<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    //
    use SoftDeletes;//will show only rows that hasnt deleted_at attribute setted (if gettering data via ::all() function)
}
