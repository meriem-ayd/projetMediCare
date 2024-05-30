<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomCommercial extends Model
{
    protected $table = 'nom_commercial';
    protected $primaryKey = 'id_commerc';

    protected $fillable = ['nom_commercial', 'id_dci'];

    public function dci()
    {
        return $this->belongsTo(Dci::class, 'id_dci');
    }
}
