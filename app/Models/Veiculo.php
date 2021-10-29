<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'placa',
        'modelo',
        'uri',
        'cor',
        'tipo',
        'user_id'
    ];

    public function fotos(){
        return $this->hasMany(FotosVeiculos::class);
    }
}
