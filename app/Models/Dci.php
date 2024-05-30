<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Dci extends Model
{
    protected $table = 'dci';
    protected $fillable = [
      'IDdci', 'dci', 'forme', 'dosage', 
      'quantite_en_stock', 'prix_unitaire', 
      'Montant', 'date_peremption'
  ];
}
