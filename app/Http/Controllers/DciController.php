<?php

namespace App\Http\Controllers;

use App\Models\Dci;
use Illuminate\Http\Request;

class DciController extends Controller
{
    public function getDCI()
    {
        return view('dci');
    }

    public function postDCI(Request $request)
    {
        // Validez les données du formulaire
        $validatedData = $request->validate([
            'IDdci' => 'required|integer',
            'dci' => 'required|string|max:255',
            'forme' => 'required|string|max:255',
            'dosage' => 'required|string|max:50',
            'quantite_en_stock' => 'nullable|integer',
            'prix_unitaire' => 'nullable|numeric',
            'Montant' => 'nullable|numeric',
            'date_peremption' => 'required|date',
        ]);

        // Créez une nouvelle instance de DCI avec les données validées
        Dci::create($validatedData);

        // Redirigez l'utilisateur vers la page DCI avec un message de succès
        return redirect()->route('getDCI')->with('success', 'La DCI a été ajoutée avec succès.');
    }

    public function listeDCI()
    {
        $dcis = Dci::all();
        return view('liste_dci', compact('dcis'));
    }

    public function updateDCI(Request $request, $id)
    {
        // Validez les données du formulaire
        $validatedData = $request->validate([
            'IDdci' => 'required|integer',
            'dci' => 'required|string|max:255',
            'forme' => 'required|string|max:255',
            'dosage' => 'required|string|max:50',
            'quantite_en_stock' => 'nullable|integer',
            'prix_unitaire' => 'nullable|numeric',
            'Montant' => 'nullable|numeric',
            'date_peremption' => 'required|date',
        ]);
    
        // Calcul du Montant
        $validatedData['Montant'] = $validatedData['quantite_en_stock'] * $validatedData['prix_unitaire'];
    
        // Trouvez la DCI par son ID et mettez à jour les données
        $dci = Dci::findOrFail($id);
        $dci->update($validatedData);
    
        // Redirigez l'utilisateur vers la page DCI ou toute autre page pertinente
        return redirect()->route('liste_dci')->with('success', 'La DCI a été mise à jour avec succès.');
    }
    
}
