<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Demande;
use App\Models\User;
use App\Models\Notification;
class EmployeController extends Controller
{
    //
    public function dashboard(){
        return view('employe.dashboard');
    }

    public function stat(){
        // Récupère l'employé actuel connecté
        $employe = auth()->user();
    
        // Récupère le nombre de clients assignés à cet employé
        $clientsCount = User::where('employe_id', $employe->id)->count();
    
        // Récupère le nombre de demandes des clients de cet employé
        $demandesCount = Demande::whereIn('client_id', function($query) use ($employe) {
            $query->select('id')->from('users')->where('employe_id', $employe->id);
        })->count();
    
        // Calcul des pourcentages pour les demandes associées à cet employé
        $enCoursCount = Demande::whereIn('client_id', function($query) use ($employe) {
            $query->select('id')->from('users')->where('employe_id', $employe->id);
        })->where('etat', 'en cours')->count();
    
        $refuseeCount = Demande::whereIn('client_id', function($query) use ($employe) {
            $query->select('id')->from('users')->where('employe_id', $employe->id);
        })->where('etat', 'refuser')->count();
    
        $accepteeCount = Demande::whereIn('client_id', function($query) use ($employe) {
            $query->select('id')->from('users')->where('employe_id', $employe->id);
        })->where('etat', 'accepter')->count();
    
        // Calcul des pourcentages
        $enCoursPercentage = $demandesCount ? ($enCoursCount / $demandesCount) * 100 : 0;
        $refuseePercentage = $demandesCount ? ($refuseeCount / $demandesCount) * 100 : 0;
        $accepteePercentage = $demandesCount ? ($accepteeCount / $demandesCount) * 100 : 0;
    
        // Retourne les données à la vue
        return view('employe.dashboard', compact('clientsCount', 'demandesCount','enCoursPercentage', 'refuseePercentage', 'accepteePercentage'));
    }
    


    public function profile(){
        return view('employe.profile');
    }


    public function updateProfile(Request $request){

    $user = Auth::user();
    $user->name = $request->name;
    $user->telephone = $request->telephone;
    if ($request->password) {
        $user->password = Hash::make($request->password);
    }

    if ($request->hasFile('profile_image')) {
        $request->validate([
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        $image = $request->file('profile_image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/profile'), $imageName);

        $user->profile_image = 'images/profile/' . $imageName;
    }
        Auth::user()->update();
        return redirect('/employe/profile')->with('success','Employé modifié avec succes');
    }



    public function ListDemande(){
    // Récupérer l'employé actuellement connecté
    $employeId = auth()->user()->id;
    $demandes = Demande::where('employe_id', $employeId)->get();
    
    return view('employe.listDemande', compact('demandes'));
}

    
    public function listClient(){
    $employeId = auth()->user()->id;

    // Récupérer tous les clients associés à cet employé
    $clients = User::where('role', 'user') 
                    ->where('employe_id', $employeId) 
                    ->get();

    return view('employe.listClient', compact('clients'));
}



public function dash(){
    $notifications = Notification::where('user_id', Auth::id())
    ->orderBy('created_at', 'desc') // Tri décroissant
    ->get();
    $unreadCount = Notification::where('user_id', Auth::id())->where('read', false)->count();
    return view('employe.dashboard', compact('notifications', 'unreadCount'));
}

public function markAsRead($id){
    $notification = Notification::find($id);

    if ($notification && $notification->user_id == Auth::id()) {
        $notification->update(['read' => true]);
    }

    return back()->with('success', 'Notification marquée comme lue');
}

//supprimer notif
public function delete($id){
        $notification = Notification::find($id);
        if ($notification) {
            $notification->delete();
            return back()->with('success', 'Notification supprimée.');
        }
        return back()->with('error', 'Notification introuvable.');
    }




}
