<?php

namespace App\Transformers\Snippets;

use App\Snippet;
use App\Transformers\Users\PublicUserTransformer;

use League\Fractal\TransformerAbstract;
class SnippetTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'steps', 'author', 'user'
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Snippet $snippet)
    {
        return [
            'uuid' =>$snippet->uuid,
            'title'=> $snippet->title?: '',
            'steps_count' => $snippet->steps->count()

        ];
    }

    public function includeSteps(Snippet $snippet ) {
        return $this->collection($snippet->steps, new SteptTransformer());
    }
    public function includeAuthor(Snippet $snippet ) {
        return $this->item($snippet->user, new PublicUserTransformer());
    }
    public function includeUser(Snippet $snippet ) {

        return $this->primitive('user', function () use ($snippet){
            return [
                'data'=> [
                    'owner'=> $snippet->user_id === optional( auth()->user())->id
                ]
            ];
        });
    }
}
