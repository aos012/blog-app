<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'user_id',
    ];

    //投稿と紐付いたUserを取得
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //投稿がもつCommentとリレーション
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
