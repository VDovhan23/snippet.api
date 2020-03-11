<?php

namespace App\Observers;

use App\Snippet;
use App\Step;
use Illuminate\Support\Str;

class StepObserver
{
    public function creating(Step $step)
    {

      $step->uuid = Str::uuid();

    }
}
