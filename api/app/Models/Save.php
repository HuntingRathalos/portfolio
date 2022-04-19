<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Save extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'tag_id',
        'icon_id',
        'coin',
        'memo',
        'click_date',
    ];

    /**
     * リレーション - usersテーブル
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * リレーション - iconsテーブル
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function icon(): BelongsTo
    {
        return $this->hasMany(Icon::class);
    }

    /**
     * リレーション - tagsテーブル
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
