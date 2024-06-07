<?php
namespace App\Http\Controllers;

use App\Models\BonCommandeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PharmacienController extends Controller
{
    public function bonCF(){
        return view('AjouterBCF');
    }

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
