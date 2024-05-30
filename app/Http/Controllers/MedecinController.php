<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BonCommandeService;
use App\Models\LigneBonCommandeService;
use App\Models\NomCommercial;
use App\Models\service;
use App\Models\Pharmacist;
use App\Models\Dci;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
class MedecinController extends Controller
{
    public function bondecommande()
    {
        $dcis = Dci::all();
        $nomsCommerciaux = NomCommercial::all();
        $services = Service::all();
         // Récupérer l'ID du premier pharmacien
         $idPharmacien = Pharmacist::first()->id;
          // Récupérer l'ID du premier médecin associé à l'utilisateur authentifié
        $idMedecin = auth()->user()->doctor->first()->id;
    
      
     $idCommerc = $nomsCommerciaux->first()->id_commerc; // Choisir le premier nom commercial comme valeur par défaut, par exemple

        return view('bondecommande', compact('dcis', 'nomsCommerciaux', 'services', 'idPharmacien', 'idMedecin', 'idCommerc'));
    }
    public function storeBonDeCommande(Request $request)
    {
        $user = auth()->user();
        $validatedData = $request->validate([
            'id_phar' => 'required|integer',
            'id_doc' => 'required|integer',
            'id_service' => 'required|integer',
            'num_bc' => 'required|integer',
            'date' => 'required|date',
            'etat' => 'required|string',
            'lignes' => 'required|array',
            'lignes.*.id_dci' => 'required|integer',
            'lignes.*.id_commerc' => 'required|integer',
            'lignes.*.quantite_demandee' => 'required|integer',
            'lignes.*.quantite_restante' => 'nullable|integer',
        ]);


        // Créer le bon de commande
        $bonCommandeService = BonCommandeService::create($validatedData);

        // Ajouter les lignes de commande
        foreach ($request->lignes as $ligne) {
            $ligne['id_bcs'] = $bonCommandeService->id_bcs;
            LigneBonCommandeService::create($ligne);
        }

        return redirect()->route('bondecommande')->with('success', 'Bon de commande créé avec succès');
    }
    public function listeBonsDeCommandeMedecin()
    {
        // Récupérer l'utilisateur authentifié
        $user = auth()->user();

        // Vérifier si l'utilisateur est un médecin
        if ($user->doctor) {
            // Récupérer l'ID du médecin
            $idMedecin = $user->doctor->first()->id;

            // Récupérer les bons de commande du médecin
            $bonsDeCommande = BonCommandeService::where('id_doc', $idMedecin)->get();

            return view('liste', compact('bonsDeCommande'));
        } else {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page.');
        }
    }

    

}
