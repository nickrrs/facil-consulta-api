<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cidades extends Model
{
    use HasFactory;
    protected $table = 'cidades';

    protected $fillable = [
        'nome',
        'estado',
    ];

    public $timestamps = true;

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    /**
     * Associação do médico e cidade.
     */
    public function medico(): BelongsTo
    {
        return $this->belongsTo(Medico::class, 'cidade_id');
    }
}
