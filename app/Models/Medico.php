<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medico extends Model
{
    use HasFactory;

    protected $table = 'medico';
    protected $fillable = [
        'nome',
        'especialidade',
        'cidade_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    public $timestamps = true;

    /**
     * Associação da cidade ao médico.
     */
    public function cidade(): HasMany
    {
        return $this->hasMany(Cidades::class, 'id', 'cidade_id');
    }

    public function paciente(): BelongsToMany
    {
        return $this->belongsToMany(Paciente::class, 'medico_paciente', 'medico_id', 'paciente_id');
    }
}
