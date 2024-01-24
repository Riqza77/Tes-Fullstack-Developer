<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use App\Models\Pegawai;

class Berkas extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id', 'pegawai_id');
    }
}
