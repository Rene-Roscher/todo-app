<?php

namespace App\Actions\Todo;

use App\Http\Requests\Todo\CreateTodoEntryRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class AddTodoEntryAction
{
    use AsAction;

    public function handle(CreateTodoEntryRequest $request)
    {
        $todo = user()->todos()->create($request->validated());

        return $todo;
    }

}