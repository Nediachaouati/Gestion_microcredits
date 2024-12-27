<?php

namespace App\Http\Controllers;
use App\Mail\EmployeAccountMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Notification;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function dashboard(){
          // Récupérer les employés
    $employees = User::where('role', 'employe')->get();
        return view('admin.dashboard', compact('employees'));
    }
    
    public function stat(){
        $clientsCount =  User::where('role', 'user')->count();
        $employeesCount =  User::where('role', 'employe')->count();
        $demandesCount = Demande::count();

        $enCoursCount = Demande::where('etat', 'en cours')->count();
        $refuseeCount = Demande::where('etat', 'refuser')->count();
        $accepteeCount = Demande::where('etat', 'accepter')->count();
    
        $enCoursPercentage = $demandesCount ? ($enCoursCount / $demandesCount) * 100 : 0;
        $refuseePercentage = $demandesCount ? ($refuseeCount / $demandesCount) * 100 : 0;
        $accepteePercentage = $demandesCount ? ($accepteeCount / $demandesCount) * 100 : 0;
        return view('admin.dashboard', compact('clientsCount', 'employeesCount', 'demandesCount','enCoursPercentage', 'refuseePercentage', 'accepteePercentage'));
    }

    
    //fct qui permet d'afficher le profil admin
    public function profile(){
         return view('admin.profile');
}


     //profile update
     public function updateProfile(Request $request){
  
        $user = Auth::user();

    $user->name = $request->name;
    $user->email = $request->email;

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
       $user->update();
         return redirect('/admin/profile')->with('success','Admin modifié avec succes');
}


    //afficher la liste des clients
    public function getClients(){
        $users = User::where('role', 'user')->get(); 
        $employees = User::where('role', 'employe')->get(); 
    // Récupérer le nombre de notifications non lues
    $unreadCount = Notification::where('user_id', Auth::id())->where('read', false)->count();
        return view('admin.listClient.index', compact('users', 'employees'));
    }



     //supprimer client
     public function destroyClient($id){
      $user=User::find($id);
      if ($user->delete()){
        return redirect()->back();
      }else{
        echo"error";
      }
}

    //afficher la liste des Employe
    public function getEmploye(){
        $users = User::where('role', 'employe')->get();
    $unreadCount = Notification::where('user_id', Auth::id())->where('read', false)->count();
    return view('admin.listEmploye.index')->with('users', $users);
    }


    //fct qui permet d'ajouter un employé
    public function store(Request $request){

        $request->validate([
            'name'=>'required',
            'matricule'=>'required',
            'telephone'=>'required',
            'email'=>'required',
            'password'=>'required',
          
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->matricule = $request->matricule;
        $user->telephone = $request->telephone;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);  
        $user->role = 'employe';  
        $user->save();
   // Envoi de l'email
   Mail::to($user->email)->send(new EmployeAccountMail($user->name, $user->email, $request->password));

   return redirect()->back()->with('success', 'Employé ajouté avec succès et email envoyé !');
}


    //supprimer employé
    public function destroyEmploye($id){

      $user=User::find($id);
      if ($user->delete()){
        return redirect()->back();
      }else{
        echo"error";
      }
}

//recuperer la liste des demandes chez l'admin
public function listDemande(){
  $demandes = Demande::all();
  return view('admin.listDemande', compact('demandes'));
}



public function createRequest(Request $request){
    $demande = Demande::create([
        'client_id' => Auth::id(),
        'details' => $request->details,
    ]);

    // Créer une notification pour l'administrateur
    Notification::create([
        'user_id' => 1, 
        'message' => 'Nouvelle demande reçue de ' . Auth::user()->name,
    ]);

    return redirect()->back()->with('success', 'Votre demande a été envoyée.');
}

public function dash()
{
    $notifications = Notification::where('user_id', Auth::id())
                                  ->orderBy('created_at', 'desc') // Tri décroissant
                                  ->get();
    $unreadCount = Notification::where('user_id', Auth::id())->where('read', false)->count();
    return view('admin.dashboard', compact('notifications', 'unreadCount'));
}

public function markAsRead($id)
{
    $notification = Notification::find($id);

    if ($notification && $notification->user_id == Auth::id()) {
        $notification->update(['read' => true]);
    }
    return back()->with('success', 'Notification marquée comme lue');
}



//supprimer notif
public function delete($id)
    {
        $notification = Notification::find($id);
        if ($notification) {
            $notification->delete();
            return back()->with('success', 'Notification supprimée.');
        }
        return back()->with('error', 'Notification introuvable.');
    }



   
public function assignEmployee(Request $request, $id){
    
    $request->validate([
        'employe_id' => 'required|exists:users,id', 
    ]);

    // Récupérer l'utilisateur (client) à qui affecter un employé
    $client = User::findOrFail($id);

    // Vérifier si l'utilisateur est bien un client
    if ($client->role !== 'user') {
        return redirect()->back()->with('error', 'Ce n\'est pas un client.');
    }

    // Récupérer l'employé choisi par l'admin
    $employe = User::findOrFail($request->employe_id);
    // Assigner l'employé à la demande du client
    $client->employe_id = $employe->id;
    $client->demande_active = true;  // Marquer la demande comme active
    $client->save();

    // Assigner l'employé à la demande dans la table Demandes
    Demande::where('client_id', $client->id)->update(['employe_id' => $employe->id]);

    // Créer une notification pour l'employé
    Notification::create([
        'user_id' => $employe->id,  
        'message' => 'Vous avez été assigné à la demande du client ' . $client->name,
    ]);

    // Créer une notification pour le client
    Notification::create([
        'user_id' => $client->id,  
        'message' => 'Votre demande est maintenant sous le traitement de l\'employé ' . $employe->name . '. Vous pouvez trouver son contact dans votre profil.'
    ]);

    return redirect()->back()->with('success', 'L\'employé a été assigné avec succès.');
}



 
    










}
