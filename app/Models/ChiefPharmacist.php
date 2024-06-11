<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiefPharmacist extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bonCommandeFournisseur(){
        return $this->hasMany(BonCommandeFournisseur::class, 'id_chef_pharmacien');


    }
}
