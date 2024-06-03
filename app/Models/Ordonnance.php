<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    use HasFactory;

    protected $table = 'ordonnance';

    protected $fillable = [
        'id_bcs',
        'nom_patient',
        'prenom_patient',
        'age',
        'date',
        'etat',
    ];

    public function lignes()
    {
        return $this->hasMany(LigneOrdonnance::class, 'id_ord');
    }
    public function bonCommandeService()
    {
        return $this->belongsTo(BonCommandeService::class, 'id_bcs');
    }
   
}
