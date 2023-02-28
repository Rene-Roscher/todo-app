<?php

namespace App\Actions\Todo;

use App\Data\Collection\CategoryListData;
use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class ShowTodoListAction
{
    use AsAction;

    public function handle()
    {
        return Inertia::render('Dashboard', [
            'categories' => CategoryListData::collection(
                user()->categories()->paginate(10)
            ),
        ]);
    }

}