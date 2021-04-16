<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'live',
        'push_event',
        'tiempo_rastreo',
        'timeout_rastreo',
        'tiempo_ping',
        'timeout_ping',
        'enviar_correo',
        'correos',
        'estado'
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone(env('TIEMPO_LOCAL'))->format('Y-m-d H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone(env('TIEMPO_LOCAL'))->format('Y-m-d H:i:s');
    }


}
