<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BonCommandeService;
use App\Models\LigneBonCommandeService;
use App\Models\NomCommercial;
use App\Models\service;
use App\Models\Ordonnance;
use App\Models\LigneOrdonnance;
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
        // Récupérer l'ID et le nom du premier médecin associé à l'utilisateur authentifié
        $medecin = auth()->user()->doctor->first();
        $idMedecin = $medecin->id;
        $nomMedecin = auth()->user()->name; // Supposant que le nom de l'utilisateur est stocké dans le champ 'name'

        $idCommerc = $nomsCommerciaux->first()->id_commerc; // Choisir le premier nom commercial comme valeur par défaut, par exemple

        return view('bondecommande', compact('dcis', 'nomsCommerciaux', 'services', 'idPharmacien', 'idMedecin', 'idCommerc', 'nomMedecin'));
    }
    public function storeBonDeCommande(Request $request)
    {
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
        $bonCommandeService = BonCommandeService::create([
            'id_phar' => $validatedData['id_phar'],
            'id_doc' => $validatedData['id_doc'],
            'id_service' => $validatedData['id_service'],
            'num_bc' => $validatedData['num_bc'],
            'date' => $validatedData['date'],
            'etat' => $validatedData['etat'],
        ]);

        // Ajouter les lignes de commande
        foreach ($validatedData['lignes'] as $ligne) {
            $ligne['id_bcs'] = $bonCommandeService->id; // Utiliser l'ID du bon de commande créé
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
            // Récupérer les bons de commande du médecin avec les lignes et les informations des DCI
            $bonsDeCommande = BonCommandeService::where('id_doc', $idMedecin)
                ->with('lignes.nomCommercial.dci','medecin.user')
                ->get();
            return view('liste', compact('bonsDeCommande'));
        } else {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page.');
        }
    }
    // modif

    public function update(Request $request, $id)
    {
        $request->validate([
            'num_bc' => 'required|string|max:255',
            'date' => 'required|date',
            'etat' => 'required|string|max:255',
            'lignes.*.dci' => 'required|string|max:255',
            'lignes.*.forme' => 'required|string|max:255',
            'lignes.*.dosage' => 'required|string|max:255',
            'lignes.*.quantite_demandee' => 'required|integer|min:0',
            'lignes.*.quantite_restante' => 'required|integer|min:0',
        ]);

        $bonDeCommande = BonCommandeService::findOrFail($id);
        $bonDeCommande->num_bc = $request->input('num_bc');
        $bonDeCommande->date = $request->input('date');
        $bonDeCommande->etat = $request->input('etat');
        $bonDeCommande->save();

        foreach ($request->input('lignes') as $ligneId => $ligneData) {
            $ligne = LigneBonCommandeService::findOrFail($ligneId);
            $ligne->nomCommercial->dci->dci = $ligneData['dci'];
            $ligne->nomCommercial->dci->forme = $ligneData['forme'];
            $ligne->nomCommercial->dci->dosage = $ligneData['dosage'];
            $ligne->quantite_demandee = $ligneData['quantite_demandee'];
            $ligne->quantite_restante = $ligneData['quantite_restante'];
            $ligne->save();
        }

        return redirect()->back()->with('success', 'Bon de Commande mis à jour avec succès');
    }
    // ordonnance 
    public function create()
    {
        $services = Service::all();
        $dcis = DCI::all();
        return view('ordonnance', compact('services', 'dcis'));
    }

    // Méthode pour enregistrer une nouvelle ordonnance
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'nom_patient' => 'required|string|max:55',
            'prenom_patient' => 'required|string|max:55',
            'age' => 'required|integer',
            'date' => 'required|date',
            'etat' => 'required|string|max:255',
            'service' => 'required|exists:service,id',
            // Ajoutez d'autres règles de validation selon vos besoins
        ]);

        // Créer une nouvelle ordonnance avec les données du formulaire
        $ordonnance = new Ordonnance([
            'nom_patient' => $request->input('nom_patient'),
            'prenom_patient' => $request->input('prenom_patient'),
            'age' => $request->input('age'),
            'id_bcs' => null,
            'date' => $request->input('date'),
            'etat' => $request->input('etat'),
            'service_id' => $request->input('service'),
            // Ajoutez d'autres attributs de votre modèle Ordonnance
        ]);

        // Sauvegarder l'ordonnance dans la base de données
        $ordonnance->save();

        // Récupérer les données des lignes d'ordonnance du formulaire
        $quantites = $request->input('quantite_demandee');
        $posologies = $request->input('posologie');
        $durees = $request->input('duree');
        $dcis = $request->input('dci');

        // Créer et sauvegarder chaque ligne d'ordonnance associée à l'ordonnance
        for ($i = 0; $i < count($quantites); $i++) {
            $ligneOrdonnance = new LigneOrdonnance([
                'id_ord' => $ordonnance->id,
                'id_commerc' => null, // Si vous ne l'utilisez pas actuellement, laissez-le null
                'quantite_demandee' => $quantites[$i],
                'posologie' => $posologies[$i],
                'duree' => $durees[$i],
                'id_dci' => $dcis[$i],
                // Ajoutez d'autres attributs de votre modèle LigneOrdonnance
            ]);

            $ligneOrdonnance->save();
        }
        return redirect()->route('ordonnance.create')->with('success', 'Ordonnance créée avec succès!');
    }

    // listeordo
    // public function listeOrdonnancesMedecin()
    // {
    //     // Récupérer l'utilisateur authentifié
    //     $user = auth()->user();
    //     if ($user->doctor) {
    //         $idMedecin = $user->doctor->first()->id;

    //         // Récupérer les ordonnances du médecin via les bons de commande
    //         $ordonnances = Ordonnance::whereHas('bonCommandeService', function ($query) use ($idMedecin) {
    //             $query->where('id_doc', $idMedecin);
    //         })
    //         ->with('lignes.nomCommercial.dci')
    //         ->get();

    //         return view('listeordonnance', compact('ordonnances'));
    //     } else {
    //         return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page.');
    //     }
    // }
}
