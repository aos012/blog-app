<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'body',
        'post_id',
        'user_id',
    ];
    //このコメントが属するPostを取得
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    //コメントと紐付いたUserを取得
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
