<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FotosVeiculos extends Model
{
    use HasFactory;

    protected $fillable = [
        'veiculo_id',
        'url'
    ];

    public function getFotoAttribute(){
        return (!empty($this->url) ? (Storage::disk('public')->exists($this->url) ? Storage::url($this->url) : url('sem-foto.png')) : url('sem-foto.png'));
    }
}
