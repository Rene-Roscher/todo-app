<?php

namespace App\Models;

use App\Traits\HasMedia;
use Illuminate\Http\UploadedFile;
use Kra8\Snowflake\HasShortflakePrimary;

/**
 * @mixin IdeHelperCategory
 */
class Category extends Model
{
    use HasShortflakePrimary;
    use HasMedia;

    protected $fillable = [
        'name', 'user_id', 'color', 'icon_path', 'order',
    ];

    protected $appends = [
        'media_icon_url',
    ];

    public function mediaIconStore(UploadedFile $file)
    {
        $this->updateMedia($file, 'icon_path', 'categories');
    }

    public function mediaIconDelete()
    {
        $this->deleteMedia('icon_path');
    }

    public function getMediaIconUrlAttribute(): string
    {
        return $this->getMediaUrl(
            path: 'icon_path',
            defaultUrl: 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF'
        );
    }

    public function todos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Todo::class);
    }

}
