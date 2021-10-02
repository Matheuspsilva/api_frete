<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frete extends Model
{
    use HasFactory;

    protected $fillable = ['data_inicio', 'data_fim', 'status', 'veiculo_id', 'valor'];

    public function veiculo(){
        return $this->hasOne(Veiculo::class);
    }
}
