<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partai extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo_partai',
        'nama_partai',
        'pimpinan',
        'vmisi',
        'periode'
    ];

    public function caleg(){
        return $this->hasMany(Partai::class);
    }
}