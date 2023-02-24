<?php

namespace App\Data;

use Carbon\CarbonImmutable;
use Spatie\LaravelData\Data;

class TodoData extends Data
{
    public function __construct(
        public string $title,
        public ?string $text,
        public int $order,
        public ?CarbonImmutable $due_at,
        public bool $completed,
        public ?string $completed_at,
        public string $category_id,
    ) {}
}
