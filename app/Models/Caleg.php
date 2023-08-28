<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caleg extends Model
{
    use HasFactory;

    protected $fillable = [
      'foto',
      'nama',
      'ttl',
      'gender',
      'pendidikan_terakhir',
      'partaiId',
      'alamat'
    ];

    public function partais(){
      return $this->belongsTo(Partai::class, 'partaiId');
    }
    
}
