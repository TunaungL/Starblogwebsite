<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comments extends Model
{
    use HasFactory;
    protected $fillable = [ 'post_id','user_id','comment'

    ];

    public function Post() {
      return  $this->belongsTo(Post::class);
    }

    public function User() {
        return $this->belongsTo(User::class);
    }
}
