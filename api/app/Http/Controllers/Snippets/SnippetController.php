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

class SnippetController extends Controller
{

    /**
     * SnippetController constructor.
     */
    public function __construct() {
        $this->middleware(['auth:api'])
             ->only('store', 'update');
    }

    /**
     * @param Request $request
     */
    public function store(Request $request ) {

        $snippet = $request->user()->snippets()->create([
           'uuid'=> Str::uuid()
        ]);

        return fractal()
            ->item($snippet)
            ->transformWith(new SnippetTransformer())
            ->parseIncludes(['steps'])
            ->toArray();

    }


    /**
     * @param Snippet $snippet
     */
    public function show( Snippet $snippet) {
        return fractal()
            ->item($snippet)
            ->transformWith(new SnippetTransformer())
            ->parseIncludes(['steps', 'author', 'user'])
            ->toArray();
    }

    public function update(SnippetUpdateRequest $request, Snippet $snippet) {


        $snippet->update( $request->all('title', 'is_public'));

        return $snippet;
    }


}
