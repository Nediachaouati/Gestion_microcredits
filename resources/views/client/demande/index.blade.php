<!doctype html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Tamouilek</title>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
    <link href="{{asset ('dashassets/css/phoenix.min.css')}}" rel="stylesheet" id="style-default">
    <link href="{{asset ('dashassets/css/user.min.css')}}" rel="stylesheet" id="user-style-default">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
      body {
        opacity: 0;
      }
      .custom-modal-size {
    max-width: 38%; 
}   
    </style>
  </head>

  <body>
    <main class="main" id="top">
      <div class="container-fluid px-0">
        
        @include('inc.client.sidebar')
        @include('inc.client.nav')


        <div class="content">
          <div class="pb-5">
            <div class="row g-5">
              <div>
                <div class="text-center mb-4">
                  <h2 class="section-title px-5" style="color: rgb(49, 48, 48)"><span class="px-2">Liste des demandes </span></h2></i>
                    <hr/></div>

                    <button type="button" class="btn btn-primary mt-3" 
        id="addDemandeBtn" 
        @if($demandes->where('etat', 'en cours')->count() > 0) 
            disabled 
        @endif 
        data-bs-toggle="modal" 
        data-bs-target="#exampleModal">
    Ajouter Demandes
</button>
              

                
                <div class="mt-3">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 50px;text-align: center;">ID</th>
                        <th style="width: 160px;text-align: center;">Type de projet</th>
                      
                        <th style="width: 120px;text-align: center;">Adresse de projet </th>
                        <th style="width: 120px;text-align: center;">Montant</th>
                        <th style="width: 120px;text-align: center;">Documents </th>
                        <th style="width: 120px;text-align: center;">Etats </th>
                        <th style="width: 120px;text-align: center;">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($demandes as $index=>$d)
                        <tr>
                          <th scope="row" style="text-align: center;">{{$index + 1}}</th>
                          <td style="text-align: center;">{{$d->typeProjet}}</td>
                          <td style="text-align: center;">{{$d->adresseProjet}}</td>
                          <td style="text-align: center;">{{$d->montant}}</td>
                          <td style="text-align: center;">
                              <a href="{{ asset('uploads/' . $d->documents) }}" target="_blank">
                                  <i class="bi bi-filetype-pdf" style="font-size:24px; color:red;"></i>
                              </a>
                          </td>
                      
                          <td style="text-align: center;">
                              @if($d->etat == "en cours")
                                  <span style="font-size: 16px; color: orange;">
                                      <i class="fas fa-clock"></i> {{ $d->etat }}
                                  </span>
                              @elseif($d->etat == "accepter")
                                  <span style="font-size: 16px; color: green;">
                                      <i class="fas fa-check-circle"></i> {{ $d->etat }}
                                  </span>
                              @elseif($d->etat == "refuser")
                                  <span style="font-size: 16px; color: red;">
                                      <i class="fas fa-times-circle"></i> {{ $d->etat }}
                                  </span>
                              @else
                                  <span style="font-size: 16px; color: gray;">
                                      <i class="fas fa-question-circle"></i> {{ $d->etat }}
                                  </span>
                              @endif
                          </td>
                      
                          <td style="text-align: center;">
                              @if($d->etat == "refuser")

                                  <button class="btn btn-info mt-2" data-bs-toggle="modal" data-bs-target="#raisonModal{{$d->id}}">
                                      Voir la raison
                                  </button>
                                  @elseif($d->etat == "accepter")
                                  <span >Demande acceptée</span>
                              @else
                                  <a data-bs-toggle="modal" data-bs-target="#editDemande{{$d->id}}" class="btn btn-success">
                                      <i class="bi bi-pencil-fill"></i>
                                  </a>
                                  <a onclick="return confirm('Voulez-vous vraiment annuler cette demande? ')" href="/client/demande/{{$d->id}}/delete" class="btn btn-danger">
                                      <i class="bi bi-x-circle-fill"></i>
                                  </a>
                              @endif
                          </td>
                      </tr>
                      
                      
                      <div class="modal fade" id="raisonModal{{$d->id}}" tabindex="-1" aria-labelledby="raisonModalLabel{{$d->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered custom-modal-size">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="raisonModalLabel{{$d->id}}">Votre demande a été refusée pour la raison suivante:</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  
                                    <p>{{ $d->raison ?? 'Aucune raison spécifiée' }}</p>
                                </div>
                                <div class="modal-footer">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                      @endforeach
                    </tbody>
                  </table>
                </div> 
            </div>
            </div>
          </div>  
        </div>
      </div>
    </main>
    
    
                      
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                      <div class="modal-dialog" style="max-width: 80%; width: 60%; ">
                          <div class="modal-content" style="padding: 20px;">
                            <div class="modal-header">
                             
                              <h5 class="modal-title" id="exampleModalLabel" >Ajout Demandes</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><svg class="svg-inline--fa fa-times fa-w-11 fs--1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" data-fa-i2svg=""><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg><!-- <span class="fas fa-times fs--1"></span> Font Awesome fontawesome.com --></button>
                            </div>
                          <div class="modal-body">
                            <form action="/client/demande/store" method="POST" enctype="multipart/form-data">
                                @csrf
                                <br>
                                <h4 >INFORMATIONS PERSONNELLES:</h4><br>
                                <div class="form-group row">
                                  <div class="col-md-4">
                                    <label>Situation familiale<span class="text-danger">*</span></label>
                                    <select class="form-select" name="situation_familiale">
                                      <option></option>
                                      <option value="Célibataire">Célibataire</option>
                                      <option value="Marié">Marié</option>
                                      <option value="Divorcé">Divorcé</option>
                                      <option value="Veuf">Veuf</option>
                                    </select>
          
                                    @error('situation_familiale')
                                      <div class="alert alert-danger" >
                                        {{ $message }} 
                                      </div>
                                    @enderror
          
                                  </div>
                                
                                  <div class="col-md-4">
                                    <label>Nombre d'enfants en charge <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="nombre_enfants" placeholder="Entrez votre nombre d'enfants">
                                  
                                    @error('nombre_enfants')
                                      <div class="alert alert-danger" >
                                        {{ $message }} 
                                      </div>
                                    @enderror
                                  
                                  </div>

                                  <div class="col-md-4">
                                    <label>Civilité <span class="text-danger">*</span></label>
                                    <select class="form-select" name="civilite">
                                        <option></option>
                                        <option value="Monsieur">Monsieur</option>
                                        <option value="Madame ">Madame </option>
                                        <option value="Mademoiselle  ">Mademoiselle </option>
                                    </select>
              
                                    @error('civilite')
                                          <div class="alert alert-danger" >
                                            {{ $message }} 
                                          </div>
                                        @enderror
                                  </div>
                              </div>
                                
          
                              <br> <br>
                              
                               <h4>INFORMATIONS PROFESSIONNELLES:</h4>
                              <br>
                              <div class="form-group row">
                                  <div class="col-md-4">
                                    <label>Statut professionnel<span class="text-danger">*</span></label>
                                    <select class="form-select" name="statut_professionnel">
                                      <option></option>
                                    <option value="Agricole">Agricole</option>
                                    <option value="Etudiant">Etudiant</option>
                                    <option value="Commercant">Commercant</option>
                                    <option value="Profession libérale ">
                                      Profession libérale{" "}
                                    </option>
                                    <option value="Artisan,independant">
                                      Artisan,independant
                                    </option>
                                  </select>
          
                                  @error('statut_professionnel')
                                      <div class="alert alert-danger" >
                                        {{ $message }} 
                                      </div>
                                    @enderror
                                  </div>
                                
                                  <div class="col-md-4">
                                    <label>Revenu mensuel (Net)<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="revenu_mensuel" placeholder="Entrez votre revenu mensuel">
                                  
                                    @error('revenu_mensuel')
                                      <div class="alert alert-danger" >
                                        {{ $message }} 
                                      </div>
                                    @enderror
                                  </div>
          
                                  <div class="col-md-4">
                                      <label>Crédits en cours<span class="text-danger">*</span></label>
                                      <select class="form-select" name="credit">
                                          <option></option>
                                        <option value="Oui">Oui</option>
                                        <option value="Non">Non</option>
                                        
                                      </select>
          
                                      @error('credit')
                                      <div class="alert alert-danger" >
                                        {{ $message }} 
                                      </div>
                                    @enderror
                                  </div>
                                </div>
                                <br><br>
                             
                              <h4>TYPE DE MICROCRÉDIT DEMANDÉ:</h4><br>
                              <div class="form-group row">
                               <div class="col-md-4">
                                <label >Type de projet<span class="text-danger">*</span></label>
                                <select class="form-select" name="typeProjet">
                                <option defaultChecked selected value=""></option>
                                    <option value="Agriculture">Agriculture</option>
                                    <option value="Artisanat">Artisanat</option>
                                    <option value="Commerce">Commerce</option>
                                    <option value="Production">Production</option>
                                    <option value="Autre projet">Autre projet</option>
                                  </select>
          
                                  @error('typeProjet')
                                      <div class="alert alert-danger" >
                                        {{ $message }} 
                                      </div>
                                    @enderror
                               </div>
          
          
                              <div class="col-md-4">
                                  <label >Besoins<span class="text-danger">*</span></label>
                                  <select class="form-select" name="besoins">
                                      <option></option>
                                      <option value="Equipement">Equipement</option>
                                      <option value="Stock">Stock</option>
                                      <option value="Fonds de roulement">
                                        Fonds de roulement
                                      </option>
                                      <option value="Aménagement">Aménagement</option>
                                      <option value="Financement des études">
                                        Financement des études
                                      </option>
                                      <option value="Autres besoins">Autres besoins</option>
                                    </select>
          
                                    @error('besoins')
                                      <div class="alert alert-danger" >
                                        {{ $message }} 
                                      </div>
                                    @enderror
                              </div>
                              <div class="col-md-4">
                                <label>Adresse du projet<span class="text-danger">*</span></label>
                                <select class="form-select" name="adresseProjet">
                                  <option></option>
                                  <option value="Ariana">Ariana</option>
                                  <option value="Tunis">Tunis</option>
                                  <option value="Béja">
                                    Béja
                                  </option>
                                  <option value="Bizert">Bizert</option>
                                  <option value="Sfax">
                                   Sfax
                                  </option>
                                  <option value="Sousse">Sousse</option>
                                </select>
          
                                @error('adresseProjet')
                                      <div class="alert alert-danger" >
                                        {{ $message }} 
                                      </div>
                                    @enderror
                              </div> 
                          </div>
                      
                      
          
          
                          <div class="form-group row">
                              
                              <div class="col-md-6">
                                  <label >Montant de microcrédit demandé<span class="text-danger">*</span></label>
                                  <input type="number" class="form-control" name="montant" placeholder="Entrez votre montant">
                                
                                  @error('montant')
                                  <div class="alert alert-danger" >
                                    {{ $message }} 
                                  </div>
                                @enderror
                                </div> 

                                <div class="col-md-6 ">
                                  <label>Durée de remboursement demandé<span class="text-danger">*</span></label>
                                  <input type="text" class="form-control" name="duree" placeholder="Entrez votre duree de remboursement">
                                
                                  @error('duree')
                                          <div class="alert alert-danger" >
                                            {{ $message }} 
                                          </div>
                                        @enderror
                                
                                </div>
                          
                          </div>
                          <br><br>
          
                            <h4> INFORMATIONS GARANT :</h4><br>
                            <div class="form-group row">
                              <div class="col-md-6">
                                <label >Nom et prénom<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="garant" placeholder="Entrez le nom du garant">
                              
                                @error('garant')
                                      <div class="alert alert-danger" >
                                        {{ $message }} 
                                      </div>
                                    @enderror
                              
                              </div>
          
          
                              <div class="col-md-6">
                                  <label >Montant garant<span class="text-danger">*</span></label>
                                  <input type="number" class="form-control" name="montantGarant" placeholder=" Entrez le montant du garant">
                              
                                  @error('montantGarant')
                                  <div class="alert alert-danger" >
                                    {{ $message }} 
                                  </div>
                                @enderror
                                </div>
                             </div>
                            <br>
                              <h4>DOCUMENT:</h4><br>
                              <div class="mb-0">
                                <label class="form-label" for="exampleTextarea">Documents</label>
                                <input name="documents" class="form-control" id="exampleFormControlInput1" type="file" placeholder="Choisir documents">
                              
                                @error('documents')
                                <div class="alert alert-danger">
                                  {{ $message }}
                              
                              </div>
                              @enderror

                              </div>
                            
                                <br>
                              
                              <button type="submit" class="btn btn-success">Envoyer</button>
                       
                          </form>
                        </div>
                        </div>
                      </div>
                    </div>


                      @foreach ($demandes as $index=>$d)
                      <!--Model Modifier -->  
                      <div class="modal fade" id="editDemande{{$d->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog" style="max-width: 80%; width: 60%; ">
                          <div class="modal-content" style="padding: 20px;">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Modifier demande:<span class="text-primary"> {{$d->civilite}} </span></h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><svg class="svg-inline--fa fa-times fa-w-11 fs--1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" data-fa-i2svg=""><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg><!-- <span class="fas fa-times fs--1"></span> Font Awesome fontawesome.com --></button>
                            </div>
                            <form  action="/client/demande/update" method="post" enctype="multipart/form-data">
                              @csrf
                              <!-- Étape 1 -->
                              <br><br>
                              <h4>INFORMATIONS PERSONNELLES:</h4>
                              <br>
                              <div class="form-group row">
                                <input type="hidden" name="iddemande" value="{{ $d->id }}">
                                <img src="{{asset ('uploads')}}/{{$d->documents}}" width="100" alt="">
                                  <div class="col-md-4">
                                    <label>Situation familiale<span class="text-danger">*</span></label>
                                    <select class="form-select" name="situation_familiale" >
                                      <option></option>
                                      <option value="Célibataire" {{ $d->situation_familiale == 'Célibataire' ? 'selected' : '' }}>Célibataire</option>
                                      <option value="Marié" {{ $d->situation_familiale == 'Marié' ? 'selected' : '' }}>Marié</option>
                                      <option value="Divorcé" {{ $d->situation_familiale == 'Divorcé' ? 'selected' : '' }}>Divorcé</option>
                                      <option value="Veuf" {{ $d->situation_familiale == 'Veuf' ? 'selected' : '' }}>Veuf</option>
                                    </select>
                        
                                    @error('situation_familiale')
                                      <div class="alert alert-danger" >
                                        {{ $message }} 
                                      </div>
                                    @enderror
                        
                                  </div>
                                
                                  <div class="col-md-4">
                                    <label>Nombre d'enfants en charge<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="nombre_enfants" placeholder="Entrez votre nombre d'enfants" value="{{ $d->nombre_enfants}}">
                                  
                                    @error('nombre_enfants')
                                      <div class="alert alert-danger" >
                                        {{ $message }} 
                                      </div>
                                    @enderror
                                  
                                  </div>
                                  <div class="col-md-4">
                                    <label>Civilité<span class="text-danger">*</span></label>
                                    <select class="form-select" name="civilite" value="{{ $d->civilite}}">
                                        <option></option>
                                        <option value="Monsieur" {{ $d->civilite == 'Monsieur' ? 'selected' : '' }}>Monsieur</option>
                                        <option value="Madame" {{ $d->civilite == 'Madame' ? 'selected' : '' }}>Madame </option>
                                        <option value="Mademoiselle" {{ $d->civilite == 'Mademoiselle' ? 'selected' : '' }}>Mademoiselle </option>
                                    </select>
                            
                                    @error('civilite')
                                          <div class="alert alert-danger" >
                                            {{ $message }} 
                                          </div>
                                        @enderror
                                  </div>
                              </div>
                                
                        
                              <br><br>
                              
                               <h4>INFORMATIONS PROFESSIONNELLES:</h4>
                              <br>
                              <div class="form-group row">
                                  <div class="col-md-4">
                                    <label>Statut professionnel<span class="text-danger">*</span></label>
                                    <select class="form-select" name="statut_professionnel" value="{{ $d->statut_professionnel}}">
                                      <option></option>
                                    <option value="Agricole" {{ $d->statut_professionnel== 'Agricole' ? 'selected' : '' }}>Agricole</option>
                                    <option value="Etudiant" {{ $d->statut_professionnel == 'Etudiant' ? 'selected' : '' }}>Etudiant</option>
                                    <option value="Commercant" {{ $d->statut_professionnel == 'Commercant' ? 'selected' : '' }}>Commercant</option>
                                    <option value="Profession libérale" {{ $d->statut_professionnel == 'Profession libérale' ? 'selected' : '' }}>
                                      Profession libérale{" "}
                                    </option>
                                    <option value="Artisan,independant" {{ $d->statut_professionnel == 'Artisan,independant' ? 'selected' : '' }}>
                                      Artisan,independant
                                    </option>
                                  </select>
                        
                                  @error('statut_professionnel')
                                      <div class="alert alert-danger" >
                                        {{ $message }} 
                                      </div>
                                    @enderror
                                  </div>
                                
                                  <div class="col-md-4">
                                    <label>Revenu mensuel (Net)<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="revenu_mensuel" placeholder="Entrez votre revenu mensuel" value="{{ $d->revenu_mensuel}}">
                                  
                                    @error('revenu_mensuel')
                                      <div class="alert alert-danger" >
                                        {{ $message }} 
                                      </div>
                                    @enderror
                                  </div>
                        
                                  <div class="col-md-4">
                                      <label>Crédits en cours<span class="text-danger">*</span></label>
                                      <select class="form-select" name="credit" value="{{ $d->credit}}">
                                          <option></option>
                                        <option value="Oui" {{ $d->credit== 'Oui' ? 'selected' : '' }}>Oui</option>
                                        <option value="Non" {{ $d->credit== 'Non' ? 'selected' : '' }}>Non</option>
                                        
                                      </select>
                        
                                      @error('credit')
                                      <div class="alert alert-danger" >
                                        {{ $message }} 
                                      </div>
                                    @enderror
                                  </div>
                                </div>
                                <br><br>
                             
                           
                        
                            
                              <h4>TYPE DE MICROCRÉDIT DEMANDÉ:</h4><br>
                              <div class="form-group row">
                               <div class="col-md-4">
                                <label >Type de projet<span class="text-danger">*</span></label>
                                <select class="form-select" name="typeProjet" value="{{ $d->typeProjet}}">
                                <option defaultChecked selected value=""></option>
                                    <option value="Agriculture" {{ $d->typeProjet== 'Agriculture' ? 'selected' : '' }}>Agriculture</option>
                                    <option value="Artisanat" {{ $d->typeProjet== 'Artisanat' ? 'selected' : '' }}>Artisanat</option>
                                    <option value="Commerce" {{ $d->typeProjet== 'Commerce' ? 'selected' : '' }}>Commerce</option>
                                    <option value="Production" {{ $d->typeProjet== 'Production' ? 'selected' : '' }}>Production</option>
                                    <option value="Autre projet" {{ $d->typeProjet== 'Autre projet' ? 'selected' : '' }}>Autre projet</option>
                                  </select>
                        
                                  @error('typeProjet')
                                      <div class="alert alert-danger" >
                                        {{ $message }} 
                                      </div>
                                    @enderror
                               </div>
                        
                        
                              <div class="col-md-4">
                                  <label >Besoins<span class="text-danger">*</span></label>
                                  <select class="form-select" name="besoins" value="{{ $d->besoins}}">
                                      <option></option>
                                      <option value="Equipement" {{ $d->besoins== 'Equipement' ? 'selected' : '' }}>Equipement</option>
                                      <option value="Stock" {{ $d->besoins== 'Stock' ? 'selected' : '' }}>Stock</option>
                                      <option value="Fonds de roulement" {{ $d->besoins== 'Fonds de roulement' ? 'selected' : '' }}>
                                        Fonds de roulement
                                      </option>
                                      <option value="Aménagement" {{ $d->besoins== 'Aménagement' ? 'selected' : '' }}>Aménagement</option>
                                      <option value="Financement des études" {{ $d->besoins== 'Financement des études' ? 'selected' : '' }}>
                                        Financement des études
                                      </option>
                                      <option value="Autres besoins" {{ $d->besoins== 'Autres besoins' ? 'selected' : '' }}>Autres besoins</option>
                                    </select>
                        
                                    @error('besoins')
                                      <div class="alert alert-danger" >
                                        {{ $message }} 
                                      </div>
                                    @enderror
                              </div>
                              <div class="col-md-4">
                                <label>Adresse du projet<span class="text-danger">*</span></label>
                                <select class="form-select" name="adresseProjet" value="{{ $d->adresseProjet}}">
                                  <option></option>
                                  <option value="Ariana" {{ $d->adresseProjet== 'Ariana' ? 'selected' : '' }}>Ariana</option>
                                  <option value="Tunis" {{ $d->adresseProjet== 'Tunis' ? 'selected' : '' }}>Tunis</option>
                                  <option value="Béja" {{ $d->adresseProjet== 'Béja' ? 'selected' : '' }}>
                                    Béja
                                  </option>
                                  <option value="Bizert" {{ $d->adresseProjet== 'Bizert' ? 'selected' : '' }}>Bizert</option>
                                  <option value="Sfax" {{ $d->adresseProjet== 'Sfax' ? 'selected' : '' }}>
                                   Sfax
                                  </option>
                                  <option value="Sousse" {{ $d->adresseProjet== 'Sousse' ? 'selected' : '' }}>Sousse</option>
                                </select>
                        
                                @error('adresseProjet')
                                      <div class="alert alert-danger" >
                                        {{ $message }} 
                                      </div>
                                    @enderror
                              </div> 
                          </div>
                        
                        
                        
                          <div class="form-group row">
                              
                              <div class="col-md-6">
                                  <label >Montant de microcrédit demandé <span class="text-danger">*</span></label>
                                  <input type="number" class="form-control" name="montant" placeholder="Entrez votre montant" value="{{ $d->montant}}">
                                
                                  @error('montant')
                                  <div class="alert alert-danger" >
                                    {{ $message }} 
                                  </div>
                                @enderror
                                </div> 
                                <div class="col-md-6">
                                  <label>Durée de remboursement demandé <span class="text-danger">*</span></label>
                                  <input type="text" class="form-control" name="duree" placeholder="Entrez la duree de remboursement" value="{{ $d->duree}}">
                                
                                  @error('duree')
                                          <div class="alert alert-danger" >
                                            {{ $message }} 
                                          </div>
                                        @enderror
                                
                                </div>
                          </div>
                          <br><br>
                        
                            <h4> INFORMATIONS GARANT :</h4><br>
                            <div class="form-group row">
                              <div class="col-md-6">
                                <label >Nom et prénom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="garant" placeholder="garant" value="{{ $d->garant}}">
                              
                                @error('garant')
                                      <div class="alert alert-danger" >
                                        {{ $message }} 
                                      </div>
                                    @enderror
                              
                              </div>
                        
                        
                              <div class="col-md-6">
                                  <label >Montant garant <span class="text-danger">*</span></label>
                                  <input type="number" class="form-control" name="montantGarant" placeholder="montantgarant" value="{{ $d->montantGarant}}">
                              
                                  @error('montantGarant')
                                  <div class="alert alert-danger" >
                                    {{ $message }} 
                                  </div>
                                @enderror
                                </div>
                             </div><br><br>
                        
                            
                        
                            
                              <h4>DOCUMENT:</h4><br>
                              <div class="mb-0">
                                <label class="form-label" for="exampleTextarea">Document</label>
                                <input name="documents" class="form-control" id="exampleFormControlInput1" type="file" placeholder="Choisir Logo">
                              
                                @error('documents')
                                <div class="alert alert-danger">
                                  {{ $message }}
                              
                              </div>
                              @enderror

                              </div>
                           

                                <br>
                              
                              <button type="submit" class="btn btn-success">Modifier</button>
                        
                          </form>
                        </div>
                        </div>
                      </div>
                      @endforeach
                    

                      
    <script src="{{asset ('dashassets/js/phoenix.js')}}"></script>
    <script src="{{asset ('dashassets/js/ecommerce-dashboard.js')}}"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
      const addDemandeBtn = document.getElementById('addDemandeBtn');
      if (addDemandeBtn) {
        console.log('Button found');
        addDemandeBtn.addEventListener('click', function(e) {
   
        console.log('Button state:', this.disabled);
      if (this.disabled) {
        console.log('Button is disabled');
        e.preventDefault();  
        alert("Une demande est déjà en cours. Vous ne pouvez pas ajouter de nouvelle demande.");
      }
    });
  } else {
    console.log('Button not found');
  }
});

    </script>
    
  </body>

</html>