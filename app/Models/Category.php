<?php

namespace App\Models;

use Kra8\Snowflake\HasShortflakePrimary;

/**
 * @mixin IdeHelperCategory
 */
class Category extends Model
{
    use HasShortflakePrimary;

    protected $fillable = [
        'name', 'user_id', 'color', 'icon_path', 'order',
    ];

}
