<?php
namespace App\Http\Controllers;

use App\Models\Dci;
use App\Models\Famille;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class DciController extends Controller
{
    public function getDCI()
    {
        $familles = Famille::all();
        return view('dci', compact('familles'));
    }

    public function postDCI(Request $request)
    {
        $validatedData = $request->validate([
            'dci' => [
                'required',
                'string',
                'max:255',
                Rule::unique('dci')->where(function ($query) use ($request) {
                    return $query->where('dci', $request->dci)
                        ->where('forme', $request->forme)
                        ->where('dosage', $request->dosage)
                        ->where('famille_id', $request->famille_id);
                }),
            ],
            'forme' => 'required|string|max:255',
            'dosage' => 'required|string|max:50',
            'quantite_en_stock' => 'nullable|integer',
            'prix_unitaire' => 'nullable|numeric',
            'Montant' => 'nullable|numeric',
            'date_peremption' => 'required|date',
            'numero_lot' => 'required|string|max:255',
            'famille_id' => 'required|exists:famille,id',
        ]);

        $famille = Famille::findOrFail($validatedData['famille_id']);
        $lastDci = $famille->dcis()->orderBy('IDdci', 'desc')->first();
        $lastIDdci = $lastDci ? intval(substr($lastDci->IDdci, -3)) : 0;
        $newIDdci = sprintf('%03d', $lastIDdci);
        $validatedData['IDdci'] = $famille->nom . $newIDdci;

        Dci::create($validatedData);

        return redirect()->route('getDCI')->with('success', 'La DCI a été ajoutée avec succès.');
    }

    public function listeDCI()
    {
        $dcis = Dci::with('famille')->get();
        $familles = Famille::all();
        return view('liste_dci', compact('dcis', 'familles'));
    }

    public function updateDCI(Request $request, $id)
    {
        $validatedData = $request->validate([
           
            'dci' => [
                'required',
                'string',
                'max:255',
                Rule::unique('dci')->where(function ($query) use ($request, $id) {
                    return $query->where('dci', $request->dci)
                        ->where('forme', $request->forme)
                        ->where('dosage', $request->dosage)
                        ->where('famille_id', $request->famille_id)
                        ->where('id', '<>', $id);
                }),
            ],
            'forme' => 'required|string|max:255',
            'dosage' => 'required|string|max:50',
            'quantite_en_stock' => 'nullable|integer',
            'prix_unitaire' => 'nullable|numeric',
            'Montant' => 'nullable|numeric',
            'date_peremption' => 'required|date',
            'numero_lot' => 'required|string|max:255',
            'famille_id' => 'required|exists:famille,id',
        ]);

        $dci = Dci::findOrFail($id);

        if ($dci->famille_id != $validatedData['famille_id']) {
            $newFamille = Famille::findOrFail($validatedData['famille_id']);
            $lastDci = $newFamille->dcis()->orderBy('IDdci', 'desc')->first();
            $lastIDdci = $lastDci ? intval(substr($lastDci->IDdci, -3)) : 0;
            $newIDdci = sprintf('%03d', $lastIDdci);
            $validatedData['IDdci'] = $newFamille->nom . $newIDdci;
        }

        $dci->update($validatedData);

        return redirect()->route('liste_dci')->with('success', 'La DCI a été mise à jour avec succès.');
    }
}
