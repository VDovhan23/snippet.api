<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Snippet;

class Step extends Model {

    public function getRouteKeyName() {
        return 'uuid';
    }


    protected $fillable = [ 'order', 'uuid', 'title', 'snippet_id', 'body' ];

    public function snippet() {
        return $this->belongsTo( Snippet::class );
    }


    /**
     * @return float|int
     */
    public function afterOrder() {

        $add = self::where( 'order', '>', $this->order )
                   ->orderBy( 'order', 'asc' )
                   ->first();

        if ( ! $add ) {
            return self::orderBy('order', 'decs')->first()->order + 1;
        }

        return ( $this->order + $add->order ) / 2;
    }


    public function beforeOrder() {
        $add = self::where( 'order', '<', $this->order )
                   ->orderBy( 'order', 'desc' )
                   ->first();

        if ( ! $add ) {
            return self::orderBy('order', 'asc')->first()->order - 1;
        }

        return ( $this->order + $add->order ) / 2;
    }

}

