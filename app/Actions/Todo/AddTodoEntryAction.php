<?php

namespace App\Actions\Todo;

use App\Http\Requests\Todo\CreateTodoEntryRequest;
use App\Models\Category;
use Lorisleiva\Actions\Concerns\AsAction;

class AddTodoEntryAction
{
    use AsAction;

    public function handle(Category $category, CreateTodoEntryRequest $request)
    {
        $category->todos()->create($request->validated());

        return back();
    }

}