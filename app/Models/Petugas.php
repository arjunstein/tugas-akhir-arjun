<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function usera()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}