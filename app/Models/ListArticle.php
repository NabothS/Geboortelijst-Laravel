<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListArticle extends Model
{
    use HasFactory;
    protected $with = ["article"];

    public function article() {
        return $this->belongsTo(Article::class, "articleId");
    }
}
