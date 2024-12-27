<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->string('situation_familiale');
            $table->integer('montant'); 
            $table->string('typeProjet');
            $table->string('adresseProjet');
            $table->string('garant');
            $table->integer('montantGarant'); 
            $table->string('besoins');
            $table->string('duree');
            $table->integer('nombre_enfants');
            $table->string('civilite');
            $table->string('statut_professionnel');
            $table->integer('revenu_mensuel'); 
            $table->string('credit');
            $table->enum('etat', ['en cours', 'refuser', 'accepter'])->default('en cours');
            $table->string('documents');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('employe_id')->nullable();
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('employe_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('raison')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demandes');
    }
}
