<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Icon extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
    ];

    /**
     * リレーション - savesテーブル
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function saves(): HasMany
    {
        return $this->hasMany(Save::class);
    }
}
