<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * リレーション - savesテーブル.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function saves(): HasMany
    {
        return $this->hasMany(Save::class);
    }
}
