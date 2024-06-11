<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacist extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'pharmacists';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bonCommandeFournisseur(){
        return $this->hasMany(BonCommandeFournisseur::class, 'id_pharmacien');


    }
}
