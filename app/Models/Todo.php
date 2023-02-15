<?php

namespace App\Models;

use Kra8\Snowflake\HasShortflakePrimary;

/**
 * @mixin IdeHelperTodo
 */
class Todo extends Model
{
    use HasShortflakePrimary;

    protected $fillable = [
        'title', 'user_id', 'text', 'order', 'due_at', 'completed', 'completed_at', 'category_id'
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];

    protected $dates = [
        'completed_at',
        'due_at',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
