<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonCommandeService extends Model
{
    protected $table = 'bon_commande_service';

    protected $primaryKey = 'id';

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
        return $this->belongsTo(Pharmacist::class, 'id');
    }

    public function medecin()
    {
        return $this->belongsTo(Doctor::class, 'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'id');
    }

    public function lignes()
    {
        return $this->hasMany(LigneBonCommandeService::class, 'id_bcs');
    }
}
