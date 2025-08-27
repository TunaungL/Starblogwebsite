<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Post extends Model
{
    use HasFactory;

    protected $fillable = [ 'title' ,'subtitle', 'content' ,'postphoto', 'user_id' , 'category_id','views'  ];
    public function category() {
       return $this->belongsTo(Category::class);
    }
     public function user() {
       return $this->belongsTo(User::class);
    }
         public function likes()
      {
         return $this->hasMany(PostLikes::class);
      }

      public function comments()
      {
         return $this->hasMany(Comments::class);
      }

}
