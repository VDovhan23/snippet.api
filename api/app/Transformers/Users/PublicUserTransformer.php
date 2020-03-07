<?php

namespace App\Transformers\Users;

use League\Fractal\TransformerAbstract;
use App\User;

class PublicUserTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
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
    public function transform(User $user)
    {
        return [
            'id'=> $user->id,
            'name' => $user->name,
            'joined'=> $user->created_at->toDateTimeString()
        ];
    }
}
