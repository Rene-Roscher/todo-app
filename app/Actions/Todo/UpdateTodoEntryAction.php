<?php

namespace App\Actions\Todo;

use App\Http\Requests\Todo\UpdateTodoEntryRequest;
use App\Models\Category;
use App\Models\Todo;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateTodoEntryAction
{
    use AsAction;

    public function handle(Todo $todo, UpdateTodoEntryRequest $request)
    {
        $todo->update($request->validated());
        return back();
    }

}