<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class , 'client_id' , 'id');
    }


    //récupérer l'employé responsable d'une demande
    public function employe(){
    return $this->belongsTo(User::class, 'employe_id', 'id');
}




}
