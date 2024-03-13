<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class cooperadosModel extends Model
{
    use HasFactory;

    // Nome da tabela associada à model
    protected $table = 'cooperados';

    protected $fillable = [
        'nome',
        'cpfcnpj',
        'datafundacao',
        'rendafaturamento',
        'telefone',
        'email',
    ];
    
    // Se você estiver usando timestamps no banco de dados
    public $timestamps = true;
}
