<?php

namespace App\Http\Controllers\Snippets;

use App\Http\Controllers\Controller;
use App\Http\Requests\SnippetUpdateRequest;
use App\Snippet;
use App\Transformers\Snippets\SnippetTransformer;
use App\Transformers\Snippets\StepTransformer;
use App\Transformers\Users\PublicUserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SnippetController extends Controller {

    /**
     * SnippetController constructor.
     */
    public function __construct() {
        $this->middleware( [ 'auth:api' ] )
             ->only( 'store', 'update' );
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function index( Request $request ) {
        return fractal()
            ->collection(
                Snippet::take( $request->get( 'limit', 10 ) )->latest()->public()->get()
            )->transformWith( new SnippetTransformer() )
            ->toArray();
    }

    /**
     * @param Request $request
     */
    public function store( Request $request ) {

        $snippet = $request->user()->snippets()->create( [
            'uuid' => Str::uuid()
        ] );

        return fractal()
            ->item( $snippet )
            ->transformWith( new SnippetTransformer() )
            ->parseIncludes( [ 'steps' ] )
            ->toArray();

    }


    /**
     * @param Snippet $snippet
     */
    public function show( Snippet $snippet ) {

        $this->authorize( 'show', $snippet );

        return fractal()
            ->item( $snippet )
            ->transformWith( new SnippetTransformer() )
            ->parseIncludes( [ 'steps', 'author', 'user' ] )
            ->toArray();
    }

    public function update( SnippetUpdateRequest $request, Snippet $snippet ) {

        $this->authorize( 'update', $snippet );

        $snippet->update( $request->all() );

        return $snippet;
    }


}
