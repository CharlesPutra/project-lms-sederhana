<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'materis';
    protected $fillable = [
        'mapel_id',
        'guru_id',
        'judul',
        'file',
        'deskripsi'
    ];


    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
}
