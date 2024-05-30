<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonCommandeService extends Model
{
    protected $table = 'bon_commande_service';

    protected $primaryKey = 'id_bcs';

    protected $fillable = [
        'id_phar',
        'id_doc',
        'id_service',
        'num_bc',
        'date',
        'etat',
    ];

    public function pharmacien()
    {
        return $this->belongsTo('App\Pharmacist', 'id');
    }

    public function medecin()
    {
        return $this->belongsTo('App\Doctor', 'id');
    }

    public function service()
    {
        return $this->belongsTo('App\Service', 'id');
    }

    public function lignes()
    {
        return $this->hasMany('App\LigneBonCommandeService', 'id_bcs');
    }
}
