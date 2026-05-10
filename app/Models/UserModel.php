<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    protected $fillable = ['level_id', 'username', 'nama', 'password'];

    public function level(): BelongsTo
{
    // Pastikan LevelModel::class merujuk ke file yang dibuat di langkah 1
    return $this->belongsTo(LevelModel::class, 'Level_id', 'Level_id');
}
