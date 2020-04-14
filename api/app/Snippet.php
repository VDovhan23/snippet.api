<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Step;
use Laravel\Scout\Searchable;

class Snippet extends Model
{
    use Searchable;

    protected $fillable = ['uuid', 'title', 'is_public'];


    public function getRouteKeyName (  ) {
        return 'uuid';
    }

    public function scopePublic(Builder $builder ) {
        return $builder->where('is_public', true);
    }

    /**
     *
     */
    public function steps(  ) {
        return $this->hasMany(Step::class)
             ->orderBy('order', 'asc');
    }

    public function isPublic() {
        return $this->is_public;
    }

    /**
     *
     */
    public function user( ) {
        return $this->belongsTo(User::class);
    }
}
