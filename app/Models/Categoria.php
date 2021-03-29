<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Categoria extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'abreviatura',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime:Y-m-d',
        'update_at' => 'datetime:Y-m-d'
    ];


    public function categoriatablas()
    {
        $cate = new CategoriaTabla();
        dd($cate);
        return $this->hasMany(CategoriaTabla::class);
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
