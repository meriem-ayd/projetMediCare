<?php
namespace App\Http\Controllers;

use App\Models\Dci;
use App\Models\BonCommandeFournisseur;
use App\Models\LigneBonCommandeFournisseur;
use App\Models\BonCommandeService;
use App\Models\Pharmacist;
use App\Models\ChiefPharmacist;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PharmacienController extends Controller
{
    public function bonCF(){
         $dcis = Dci::all();
         $Pharmacien =auth()->user()->pharmacist;
         $idPhar = $Pharmacien->id;
         $chefpharmaciens = ChiefPharmacist::all();
         $idChefPharmacien = $chefpharmaciens->first()->id; // Choisir le premier nom commercial comme valeur par défaut, par exemple
         //$IDdci= $dcis->id;

         return view('AjouterBCF', compact('dcis','Pharmacien','idPhar','chefpharmaciens','idChefPharmacien'));

         //$idChefPharmacien = auth()->user()->chiefpharmacist;

         //$ChefidPharmacien = ChiefPharmacist->id;

        // Obtenez le pharmacien authentifié
    //$pharmacien = Auth::user();

    // Supposons qu'il n'y a qu'un seul chef pharmacien, obtenez-le
    //$chefPharmacien = User::where('type', 'Chef Pharmacien')->first();
        // Récupérer tous les DCI pour la sélection
        // return view('AjouterBCF', [
        //     'pharmacien' => $pharmacien,
        //     'chefPharmacien' => $chefPharmacien,
        //     'dcis' => DCI::all(), // Si vous avez besoin de la liste des DCI
        // ]);
    }

    // public function boncommandefournisseur(){

    // }

    public function createBonCommandeFournisseur(Request $request)
    {
        $validatedData = $request->validate([
            'num_bcf' => 'required|integer',
            'date' => 'required|date',
            'nom_service_contractant' => 'required|string',
            'nom_fournisseur' => 'required|string',
            'email_fournisseur' => '|email|unique:bon_commande_fournisseurs,email_fournisseur',
            'id_chef_pharmacien' => 'required|integer',
            'id_pharmacien' => 'required|integer',
            'lignesBCF' => 'required|array',
            //'lignesBCF.*.id' => 'required|integer',
            'lignesBCF.*.IDdci' => 'required|integer',
            'lignesBCF.*.quantite_commandee' => 'required|integer',
            'lignesBCF.*.quantite_restante' => 'nullable|integer',
        ]);
        // Créer le bon de commande

        $bonCommande = BonCommandeFournisseur::create([
            'num_bcf' => $validatedData['num_bcf'],
            'date' => $validatedData['date'],
            'nom_service_contractant' => $validatedData['nom_service_contractant'],
            'nom_fournisseur' => $validatedData['nom_fournisseur'],
            'email_fournisseur' => $validatedData['email_fournisseur'],
            'id_chef_pharmacien' => $validatedData['id_chef_pharmacien'],
            'id_pharmacien' => $validatedData['id_pharmacien'],

        ]);


//  // Insérer les lignes du bon de commande
//  foreach ($validatedData['lignesBCF'] as $ligne) {
//     $ligne['id_bcf'] = $bonCommande->id; // Utiliser l'ID du bon de commande créé

//     // Créer la ligne avec toutes les données nécessaires
//     LigneBonCommandeFournisseur::create([
//         'IDdci' => $ligne['IDdci'],
//         'quantite_commandee' => $ligne['quantite_commandee'],
//         'quantite_restante' => $ligne['quantite_restante'],
//         'id_bcf' => $ligne['id_bcf'],
//     ]);
// }
    //     // Insérer les lignes du bon de commande
    // foreach ($validatedData['lignesBCF'] as $ligne) {
    //     $ligne['id_bcf'] = $bonCommande->id; // Utiliser l'ID du bon de commande créé

    //     // Assurer que l'IDdci est bien défini
    //     if (isset($ligne['IDdci'])) {
    //         LigneBonCommandeFournisseur::create($ligne);
    //     } else {
    //         // Gérer le cas où IDdci est manquant
    //         return back()->withErrors(['IDdci' => 'IDdci est manquant pour une ou plusieurs lignes.']);
    //     }
    // }

        //     // Créer les lignes du bon de commande
        // foreach ($validatedData['lignes'] as $ligne) {
        //     LigneBonCommandeFournisseur::create([
        //         'id_bcf' => $bonCommande->id,
        //         'id_dci' => $ligne['id_dci'],
        //         'quantite_commandee' => $ligne['quantite_demandee'],
        //         'quantite_restante' => $ligne['quantite_restante'],
        //     ]);

             // Ajouter les lignes de commande
        //  foreach ($validatedData['lignesBCF'] as $ligne) {

        //     $ligne['id_bcf'] = $bonCommande->id; // Utiliser l'ID du bon de commande créé
        //      LigneBonCommandeFournisseur::create($ligne);
        //  }
 // Ajouter les lignes de commande
//  foreach ($validatedData['lignesBCF'] as $ligne) {
//     $ligne['id_bcf'] = $bonCommande->id; // Utiliser l'ID du bon de commande créé
//     LigneBonCommandeFournisseur::create($ligne);
// }

       // $bonCommande = BonCommandeFournisseur::with('lignesBCF.dci')->get();


            // $ligne['id_bcf'] = $bonCommande->id; // Utiliser l'ID du bon de commande créé
            // LigneBonCommandeFournisseur::create($ligne);
            return redirect()->route('bonCF')->with('success', 'Bon de commande créé avec succès.');

        }


    public function listeBonsDeCommandeFournisseur()
    {
        //$bonCommande = BonCommandeFournisseur::with('lignesBCF')->findOrFail($id);

        $bonsCommande = BonCommandeFournisseur::with('lignesBCF')->get();
        return view('listeBCF', compact('bonsCommande'));
    }

public function details()
{
     return view('DetailsBCF');

}
    ////////////////////////////////////////////////////////////
    public function showBonLivraison()
    {
        return view('bonlivraison');
    }

    public function listeTousBonsDeCommande()
    {
        // Vérifier si l'utilisateur est authentifié
        if (Auth::check()) {
            $user = auth()->user();

            // Vérifier si l'utilisateur est un pharmacien
            if ($user->pharmacist) {
                $bonsDeCommandeMedecins = BonCommandeService::whereNotNull('id_doc')
                    ->with(['lignes.nomCommercial.dci', 'medecin.user']) // Inclure les informations sur le médecin et l'utilisateur associé
                    ->get();

                return view('listeTousBonsDeCommande', compact('bonsDeCommandeMedecins'));
            } else {
                return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour accéder à cette page.');
        }
    }
    public function showBonDeCommande($id)
    {
        $bonDeCommande = BonCommandeService::findOrFail($id);
        return view('show', compact('bonDeCommande'));
    }






}
