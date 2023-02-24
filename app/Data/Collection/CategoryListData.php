<?php

namespace App\Data\Collection;

use App\Data\TodoData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class CategoryListData extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public string $color,
        public ?string $icon_path,
        public int $order,
        #[DataCollectionOf(TodoData::class)]
        public DataCollection $todos,
    ) {}
}
