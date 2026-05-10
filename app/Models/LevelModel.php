<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LevelModel extends Model
{
    protected $table = 'm_level'; // Pastikan nama tabel sesuai database
    protected $primaryKey = 'Level_id';

    // Kolom yang boleh diisi secara massal
    protected $fillable = ['level_kode', 'level_nama'];

        /**
        * Mendapatkan user yang memiliki level ini (Relasi One to Many)
        */ 
    public function users()
    {
        return $this->hasMany(UserModel::class, 'level_id', 'level_id');
    }   
}