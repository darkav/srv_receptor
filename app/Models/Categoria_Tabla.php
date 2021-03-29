<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaTabla extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'categoria_id',
        'tabla',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'categoria_id' => 'integer',
        'created_at' => 'datetime:Y-m-d',
        'update_at' => 'datetime:Y-m-d'
    ];


    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
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
