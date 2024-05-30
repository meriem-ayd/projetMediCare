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
            'quantite_en_stock' => 'required|integer',
            'prix_unitaire' => 'required|numeric',
            'Montant' => 'required|numeric',
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
            'quantite_en_stock' => 'required|integer',
            'prix_unitaire' => 'required|numeric',
            'Montant' => 'required|numeric',
            'date_peremption' => 'required|date',
        ]);
// Trouvez la DCI par son ID et mettez à jour les données
$dci = Dci::findOrFail($id);
$dci->IDdci = $validatedData['IDdci'];
$dci->dci = $validatedData['dci'];
$dci->forme = $validatedData['forme'];
$dci->dosage = $validatedData['dosage'];
$dci->quantite_en_stock = $validatedData['quantite_en_stock'];
$dci->prix_unitaire = $validatedData['prix_unitaire'];
$dci->Montant = $validatedData['Montant'];
$dci->date_peremption = $validatedData['date_peremption'];
$dci->save();

        // Trouvez la DCI par son ID et mettez à jour les données
        $dci = Dci::findOrFail($id);
        $dci->update($validatedData);

        // Redirigez l'utilisateur vers la page DCI ou toute autre page pertinente
        return redirect()->route('liste_dci')->with('success', 'La DCI a été mise à jour avec succès.');
    }

}
