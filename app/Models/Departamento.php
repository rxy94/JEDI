<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departamento extends Model
{
    
    protected $table = 'departamento';
    protected $primaryKey = 'idDep';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        
    ];

    /**
     * Undocumented function
     *
     * @return HasMany
     */
    public function usuarios(): HasMany
    {
        return $this->hasMany(Usuario::class);

    }

    /**
     * Undocumented function
     *
     * @return BelongsToMany
     */
    public function edificios(): BelongsToMany
    {
        return $this->belongsToMany(Edificio::class, 'departamento_edificio', 'idDep', 'idEdi')
                    ->withPivot('despacho');
    }

}
