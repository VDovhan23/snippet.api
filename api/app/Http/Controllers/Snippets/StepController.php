<?php

namespace App\Http\Controllers\Snippets;

use App\Http\Controllers\Controller;
use App\Snippet;
use App\Step;
use App\Transformers\Snippets\SteptTransformer;
use Illuminate\Http\Request;

class StepController extends Controller {
    /**
     * @param Snippet $snippet
     * @param Step $step
     * @param Request $request
     */
    public function update( Snippet $snippet, Step $step, Request $request ) {

        $this->authorize('update', $step);

        $step->update( $request->only( [ 'title', 'body' ] ) );

    }

    /**
     * @param Snippet $snippet
     * @param Request $request
     *
     * @return array
     */
    public function store( Snippet $snippet, Request $request ) {

        $this->authorize('storeStep', $snippet);

        $step = $snippet->steps()->create(
            array_merge( $request->only( [ 'title', 'body' ] ), [ 'order' => $this->getOrder($request) ] )
        );

        return fractal()
            ->item( $step )
            ->transformWith( new SteptTransformer() )
            ->toArray();
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    protected function getOrder( Request $request ) {

        $result = Step::where( 'uuid', $request->before )
                   ->orWhere('uuid', $request->after )
                   ->first()
                   ->{($request->before ? 'before' : 'after')."Order"}();

        return $result;
    }

    public function destroy(Snippet $snippet, Step $step ) {

        $this->authorize('destroy', $step);

        if ($snippet->steps()->count() === 1){
            return response(["message"=>'Step'. $step['title'] .'can\'t be deleted'],404 );
        }

        $step->delete();

        return response(["message"=>'Step '. $step['title'] .' was deleted'],200 );

    }

}
