<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pengguna()
    {
        return $this->hasOne(Pengguna::class);
    }
}
