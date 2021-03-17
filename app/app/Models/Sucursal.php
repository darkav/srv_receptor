<?php

namespace App\app\Models;

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
        return $this->hasMany(\App\app\Models\RiseParameter::class);
    }

    public function riseMasters()
    {
        return $this->hasMany(\App\app\Models\RiseMaster::class);
    }

    public function riseTransactions()
    {
        return $this->hasMany(\App\app\Models\RiseTransaction::class);
    }

    public function riseQueues()
    {
        return $this->hasMany(\App\app\Models\RiseQueue::class);
    }
}
