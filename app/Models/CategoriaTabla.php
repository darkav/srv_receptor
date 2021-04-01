<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaTabla extends Model
{
    use HasFactory;

    protected $fillable = [
        'tabla','categoria_id','key'
    ];


    public function categoria()
    {
        $this->belongsTo(Categoria::class);
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
