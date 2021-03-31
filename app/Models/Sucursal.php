<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bd',
        'nombre',
        'ip',
        'usuario',
        'clave'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];


    public function riseParameters()
    {
        return $this->hasMany(\App\Models\RiseParameter::class);
    }

    public function riseMasters()
    {
        return $this->hasMany(\App\Models\RiseMaster::class);
    }

    public function riseTransactions()
    {
        return $this->hasMany(\App\Models\RiseTransaction::class);
    }

    public function riseQueues()
    {
        return $this->hasMany(\App\Models\RiseQueue::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone(env('TIEMPO_LOCAL'))->format('Y-m-d H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone(env('TIEMPO_LOCAL'))->format('Y-m-d H:i:s');
    }
}
