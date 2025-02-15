<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'matricule',
        'telephone',
        'cin',
        'adresse',
        'date_naissance',
        'role',
        'demande_active',
        'profile_image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function demandes(){
        return $this->hasMany(Demande::class , 'client_id' , 'id');
    }


    //récupérer toutes les demandes assignées à un employé 
    public function demandesAttribuees(){
    return $this->hasMany(Demande::class, 'employe_id', 'id');
}



    // Relation entre le client et l'employé
    public function employe()
    {
        return $this->belongsTo(User::class, 'employe_id');
    }

    // Définir la relation inverse si vous souhaitez savoir quels clients sont assignés à un employé
    public function clients()
    {
        return $this->hasMany(User::class, 'employe_id');
    }


   

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
    
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
    





 

}
