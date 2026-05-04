<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFile extends Model
{
    protected $fillable = [
        'user_id',
        'original_name',
        'stored_name',
        'path',
        'mime_type',
        'size',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Human-readable file size accessor.
     */
    public function getFormattedSizeAttribute(): string
    {
        if ($this->size >= 1048576) return round($this->size / 1048576, 2) . ' MB';
        if ($this->size >= 1024)    return round($this->size / 1024, 2) . ' KB';
        return $this->size . ' B';
    }
}