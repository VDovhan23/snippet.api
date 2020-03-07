<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Snippet;

class Step extends Model
{

    protected $fillable = ['order', 'uuid', 'title', 'snippet_id'];

    public function user( ) {
        return $this->belongsTo(Snippet::class);
    }
}

