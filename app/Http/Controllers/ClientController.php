<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Message;
use App\Models\Notification;
class ClientController extends Controller
{

    //
  


    public function profile(){
        $user = auth()->user();
        $employe = $user->employe; 
        return view('client.profile', compact('user', 'employe'));
    }

    

    public function updateProfile(Request $request){

    $user = Auth::user();
    $user->name = $request->name;
    $user->cin = $request->cin;
    $user->adresse = $request->adresse;
    $user->telephone = $request->telephone;
    $user->date_naissance = $request->date_naissance;


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

        return redirect('/client/profile')->with('success','Client modifié avec succes');
    }

    public function dash(){
        $notifications = Notification::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')->get();
        $unreadCount = Notification::where('user_id', Auth::id())->where('read', false)->count();
    return view('client.dashboard', compact('notifications', 'unreadCount'));
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
