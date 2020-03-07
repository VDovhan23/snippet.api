<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Step;

class Snippet extends Model
{

    protected $fillable = ['uuid', 'title'];


    public function getRouteKeyName (  ) {
        return 'uuid';
    }

    /**
     *
     */
    public function steps(  ) {
        return $this->hasMany(Step::class)
             ->orderBy('order', 'asc');
    }

    /**
     *
     */
    public function user( ) {
        return $this->belongsTo(User::class);
    }
}
