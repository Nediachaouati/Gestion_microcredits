<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\User;
use App\Models\Notification;
use App\Mail\DemandeStatusRefusMail;
use App\Mail\DemandeStatusAcceptMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class DemandeController extends Controller
{
    //afficher page demande
    public function index(){
        // Récupérer uniquement les demandes de l'utilisateur connecté
        $demandes = Demande::where('client_id', Auth::id())->get();
        return view('client.demande.index', compact('demandes'));
    }

    //ajoute une demande
    public function store(Request $request){

        $request->validate([
            'situation_familiale' => 'required',
            'nombre_enfants' => 'required',
            'civilite' => 'required',
            'statut_professionnel' => 'required',
            'revenu_mensuel' => 'required',
            'credit' => 'required',
            'typeProjet' => 'required',
            'besoins' => 'required',
            'adresseProjet' => 'required',
            'montant' => 'required',
            'duree' => 'required',
            'garant' => 'required',
            'montantGarant' => 'required',
           'documents' => 'required|file|mimes:jpg,jpeg,png,pdf'
        ]);

        $demande=new Demande();
        $demande->situation_familiale = $request->situation_familiale;
    $demande->nombre_enfants = $request->nombre_enfants;
    $demande->civilite = $request->civilite;
    $demande->statut_professionnel = $request->statut_professionnel;
    $demande->revenu_mensuel = $request->revenu_mensuel;
    $demande->credit = $request->credit;
    $demande->typeProjet = $request->typeProjet;
    $demande->besoins = $request->besoins;
    $demande->adresseProjet = $request->adresseProjet;
    $demande->montant = $request->montant;
    $demande->duree = $request->duree;
    $demande->garant = $request->garant;
    $demande->montantGarant = $request->montantGarant;
    $demande->client_id = Auth::user()->id;
    $demande->raison = $request->raison ?? '';


    $user = Auth::user(); // Utilisez l'utilisateur connecté
    $user->demande_active = true; // L'utilisateur a une demande active
    $user->save();
    
    
    if ($user->employe_id) {
        $demande->employe_id = $user->employe_id;  // Assigner l'employé à la demande
    }
    
    if ($request->hasFile('documents')) {
        $newname = uniqid() . '.' . $request->file('documents')->getClientOriginalExtension();
        $destinationPath = 'uploads';
        $request->file('documents')->move($destinationPath, $newname);
        $demande->documents = $newname;
    }

        if($demande->save()){
            $admin = User::where('role', 'admin')->first();
            if ($admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'message' => "Nouvelle demande soumise par " . Auth::user()->name,
                ]);
            }

            if ($user->employe_id) {
                $employe = User::find($user->employe_id);
                if ($employe) {
                    Notification::create([
                        'user_id' => $employe->id,
                        'message' => "Nouvelle demande soumise par " . Auth::user()->name,
                    ]);
                }
            }
            return redirect('/client/demande')->with('success','Demande ajoutée avec succes');
        }
        else{
            echo"error";
        }
            

    }

    

      //supprimer demande
      public function destroy($id)
      {
          
          $demande = Demande::find($id);
          if ($demande) {
            
              if ($demande->documents) {
                  $file_path = public_path() . '/uploads/' . $demande->documents;
                  if (file_exists($file_path)) {
                      unlink($file_path); 
                  }
              }
      
              $demande->user->demande_active = 0;  // (aucune demande active)
              $demande->user->save();  

              $demande->delete();
              $employe = $demande->employe; 

              if ($employe) {
                  // Créer une notification pour informer l'employé que la demande est annulée
                  Notification::create([
                      'user_id' => $employe->id, // ID de l'employé affecté
                      'message' => 'La demande du client ' . $demande->user->name . ' a été annulée.',
                  ]);
              }

              return redirect()->back()->with('success', 'Votre demande a été annulée.');
          } else {
            
              return redirect()->back()->with('error', 'Demande non trouvée.');
          }
      }
  
    //modifier demande
    public function update(Request $request){
        
    $demande=Demande::find($request->iddemande);
    $demande->situation_familiale = $request->situation_familiale;
    $demande->nombre_enfants = $request->nombre_enfants;
    $demande->civilite = $request->civilite;
    $demande->statut_professionnel = $request->statut_professionnel;
    $demande->revenu_mensuel = $request->revenu_mensuel;
    $demande->credit = $request->credit;
    $demande->typeProjet = $request->typeProjet;
    $demande->besoins = $request->besoins;
    $demande->adresseProjet = $request->adresseProjet;
    $demande->montant = $request->montant;
    $demande->duree = $request->duree;
    $demande->garant = $request->garant;
    $demande->montantGarant = $request->montantGarant;
        
    $user = Auth::user();
    if ($request->file('documents')) {
        // Supprimer l'ancienne photo
        $file_path = public_path() . '/uploads/' . $demande->documents;
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        $newname = uniqid();
        $image = $request->file('documents');
        $newname .= "." . $image->getClientOriginalExtension();
        $destinationPath = 'uploads';
        $image->move($destinationPath, $newname);
        $demande->documents = $newname;
    }
        if($demande->update()){
            if ($user->employe_id) {
                $employe = User::find($user->employe_id);
                if ($employe) {
                    Notification::create([
                        'user_id' => $employe->id,
                        'message' => 'La demande du client ' . $demande->user->name . ' a été modifiée.',
                    ]);
                }
            }
            return redirect()->back();
        }else{
            echo"error";
        }
    }

    //voir details de demande chez l'employé
    public function details($id){
    $demandes = Demande::with('user')->get();  
    $user = User::where('id', Auth::user()->id);
    return view('employe.listDemande')->with('demandes', $demandes)->with('user', $user);
}


    //refuser demande
    public function refuserDemande($id, Request $request){
    
    $request->validate([
        'raison' => 'required',
    ]);
    $demande = Demande::findOrFail($id);
    $demande->etat = 'refuser';
    $demande->raison = $request->input('raison');
    $demande->save();

    $client = User::find($demande->client_id); 
    Mail::to($client->email)->send(new DemandeStatusRefusMail($client->name, $demande->etat, $demande->raison));

    if ($client) {
        Notification::create([
            'user_id' => $client->id,
            'message' => 'Votre demande a été refusée, pour plus d\'informations, consultez la raison',
        ]);
    }

    $demandes = Demande::all(); 
    return view('employe.listDemande', compact('demandes'))->with('success', 'Demande refusée avec succès');
}


//accepter demande
public function accepterDemande($id, Request $request){
 
    $demande = Demande::findOrFail($id);
    $demande->etat = 'accepter';
    $demande->save();

    $client = User::find($demande->client_id); 
    Mail::to($client->email)->send(new DemandeStatusAcceptMail($client->name, $demande->etat));

    if ($client) {
        Notification::create([
            'user_id' => $client->id,
            'message' => 'Votre demande a reçu une acceptation préliminaire',  
        ]);
    }
    $demandes = Demande::all(); 

    return view('employe.listDemande', compact('demandes'))->with('success', 'Demande acceptée avec succès');
}









                                  /********coté admin ************/
//recupere la liste des demande chez l'admin
public function ListDemandeA(){
    $demandes=Demande::all();
    return view('admin.traitementDemande')->with('demandes',$demandes);
}

 //voir details de demande chez l'admin
 public function detailsA($id){
    $demandes = Demande::with('user')->get();  
    $user = User::where('id', Auth::user()->id);
    return view('admin.traitementDemande')->with('demandes', $demandes)->with('user', $user);
}


    //refuser demande
    public function refuserDemandeA($id, Request $request){
    
    $request->validate([
        'raison' => 'required',
    ]);
    $demande = Demande::findOrFail($id);
    $demande->etat = 'refuser';
    $demande->raison = $request->input('raison');
    $demande->save();
    $demandes = Demande::all(); 
    return view('admin.traitementDemande', compact('demandes'))->with('success', 'Demande refusée avec succès');
}



public function search(Request $request)
{
    $demandes = Demande::query()
        ->when($request->search, function ($query) use ($request) {
            $query->where('typeProjet', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('adresseProjet', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('montant', 'LIKE', '%' . $request->search . '%');
        })
        ->when($request->etat, function ($query) use ($request) {
            $query->where('etat', $request->etat);
        })
        ->get();

    return view('admin.listDemande', ['demandes' => $demandes]);
}

public function searchClients(Request $request)
{
    $employe = auth()->user();
    if ($employe->role !== 'employe') {
        return abort(403, 'Accès non autorisé');
    }

    $demandes = Demande::query()
        ->where('employe_id', $employe->id)
        ->when($request->search, function ($query) use ($request) {
            $query->where('typeProjet', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('adresseProjet', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('montant', 'LIKE', '%' . $request->search . '%');
        })
        
        ->when($request->etat, function ($query) use ($request) {
            $query->where('etat', $request->etat);
        })
        ->get();

    return view('employe.listDemande', ['demandes' => $demandes]);
}



}