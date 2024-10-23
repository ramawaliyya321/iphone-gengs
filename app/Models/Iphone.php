<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Iphone extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $table='iphones';
    protected $primaryKey='id';
    protected $fillable=['id','user_id','seri','imei','jenis','kapasitas','harga','foto'];

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
