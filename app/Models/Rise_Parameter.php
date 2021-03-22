<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiseParameter extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sucursal_id',
        'tabla',
        'clave',
        'registro',
        'upload_status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'sucursal_id' => 'integer',
        'registro' => 'array',
    ];


    public function sucursal()
    {
        return $this->belongsTo(\App\Models\Sucursal::class);
    }
}
