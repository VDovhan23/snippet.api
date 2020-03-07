<?php

namespace App\Observers;

use App\Snippet;
use App\Step;
use Illuminate\Support\Str;

class SnippetObserver
{
    /**
     * Handle the \App\Snippet "created" event.
     *
     * @param  \App\Snippet $snippet
     * @return void
     */
    public function created(Snippet $snippet)
    {
        $step = new Step();

        $step->create([
            'snippet_id'=> $snippet->id,
            'uuid'=> Str::uuid(),
            'order'=> 1
        ]);

    }

    /**
     * Handle the =snippet "updated" event.
     *
     * @param  \App\Snippet $snippet
     * @return void
     */
    public function updated(Snippet $snippet)
    {
        //
    }

    /**
     * Handle the =snippet "deleted" event.
     *
     * @param  \App\Snippet $snippet
     * @return void
     */
    public function deleted(Snippet $snippet)
    {
        //
    }

    /**
     * Handle the =snippet "restored" event.
     *
     * @param  \App\Snippet $snippet
     * @return void
     */
    public function restored(Snippet $snippet)
    {
        //
    }

    /**
     * Handle the =snippet "force deleted" event.
     *
     * @param  \App\Snippet $snippet
     * @return void
     */
    public function forceDeleted(Snippet $snippet)
    {
        //
    }
}
