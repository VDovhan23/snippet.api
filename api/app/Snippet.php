<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Step;

class Snippet extends Model
{

    protected $fillable = ['uuid', 'title'];


    public function steps(  ) {
        $this->hasMany(Step::class)
             ->orderBy('order', 'asc');
    }
    public function user( ) {
        $this->belongsTo(User::class);
    }
}
