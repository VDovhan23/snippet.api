<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Snippet;

class Step extends Model
{

    public function getRouteKeyName (  ) {
        return 'uuid';
    }


    protected $fillable = ['order', 'uuid', 'title', 'snippet_id', 'body'];

    public function snippet( ) {
        return $this->belongsTo(Snippet::class);
    }


}

