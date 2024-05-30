<?php

namespace App\Http\Controllers;

use App\Models\ChiefPharmacist;
use App\Models\Doctor;
use App\Models\Pharmacist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function getUsers()
    {
        $users = User::all();

        return view('users', compact('users'));
    }

    public function getAddUser()
    {
        return view('addUser');
    }

    public function postAddUser(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'type' => 'required',
        ]);

        // Générer un mot de passe aléatoire de 10 caractères avec Str::random()
        $password = Str::random(10);

        // Hasher le mot de passe pour le stocker en toute sécurité
        $hashedPassword = Hash::make($password);

        // Créer un nouvel utilisateur
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = $hashedPassword;
        $user->save();

        if ($validatedData['type'] == 1) {
            $chiefPharmacist = new ChiefPharmacist();
            $chiefPharmacist->user_id = $user->id;
            $chiefPharmacist->save();
        } elseif ($validatedData['type'] == 2) {
            $pharmacist = new Pharmacist();
            $pharmacist->user_id = $user->id;
            $pharmacist->save();
        } elseif ($validatedData['type'] == 3) {
            $doctor = new Doctor();
            $doctor->user_id = $user->id;
            $doctor->save();
        }

        // Envoyer le mot de passe par email avec le message non haché
        $message = "Voici vos paramètres de connexion email: {$user->email} et mot de passe: $password";
        Mail::raw($message, function ($message) use ($user) {
            $message->to($user->email)->subject('Vos informations de connexion');
        });

        // Redirigez ou affichez un message de succès
        return redirect()->route('getAddUser')->with('success', 'Votre ajout a été effectuée avec succès.');
    }
}
