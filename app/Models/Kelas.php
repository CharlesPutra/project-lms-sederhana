<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'kelas';
    protected $fillable = ['nama_kelas'];

    //relasi user
    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'kelassiswas',
            'kelas_id',
            'user_id'
        );
    }
}
