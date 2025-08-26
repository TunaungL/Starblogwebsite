<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostLikes extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','post_id'];

    public function Users() {
       return $this->belongsTo(User::class);
    }

    public function Posts(): BelongsTo {
        return $this->belongsTo(Post::class);
    }
}
