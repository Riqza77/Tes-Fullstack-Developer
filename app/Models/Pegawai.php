<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use App\Models\Berkas;

class Pegawai extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function berkas()
    {
        return $this->hasMany(Berkas::class, 'pegawai_id', 'id');
    }
}
