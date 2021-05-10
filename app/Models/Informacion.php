<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Informacion extends Model {
    use HasFactory;

    protected $fillable = [
        "nombres",
		"apellidos",
		"direcion",
		"fecha_nac",
		"sexo",
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}