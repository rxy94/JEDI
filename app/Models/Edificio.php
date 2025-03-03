<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Edificio extends Model
{
    
    use HasFactory;

    protected $table = 'edificio';
    protected $primaryKey = 'idEdi';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'calle',
        'numero',
    ];

    /**
     * Undocumented function
     *
     * @return BelongsToMany
     */
    public function departamentos(): BelongsToMany
    {
        return $this->belongsToMany(Departamento::class, 'departamento_edificio', 'idEdi', 'idDep');
    }

}
