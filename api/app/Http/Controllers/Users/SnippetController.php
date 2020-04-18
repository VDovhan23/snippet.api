<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Snippet;
use App\Transformers\Snippets\SnippetTransformer;
use App\User;
use Illuminate\Http\Request;

class SnippetController extends Controller
{
    /**
     * @param User $user
     * @param Request $request
     *
     * @return array
     */
    public function index(User $user, Request $request ) {
        return fractal()
            ->collection(
                $user->snippets()->public()->get()
            )->transformWith( new SnippetTransformer() )
            ->toArray();
    }
}
