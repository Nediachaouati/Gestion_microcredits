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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <style>
      body {
        opacity: 0;
      }
      
    </style>
  </head>

  <body>
    <main class="main" id="top">
      <div class="container-fluid px-0">
        
        @include('inc.employe.sidebar')
        @include('inc.employe.nav')


        <div class="content">
          <div class="pb-5">
            <div class="row g-5">
              <div>
                <div class="text-center mb-4">
                  <h2 class="section-title px-5" style="color: rgb(49, 48, 48)"><span class="px-2">Liste des demandes </span></h2></i>
                    <hr/></div>
               
              

                <div class="mt-2">
                  <form action="/employe/searchClients" method="get">
                    @csrf
                    <div class="row">
                      <div class="col-6">
                        <div class="input-group">
                          <span class="input-group-text" id="search-icon"><i class="bi bi-search"></i></span>
                          <input type="text" class="form-control" name="search" placeholder="-- Filtrer par critère --" aria-describedby="search-icon">
                        </div>
                    </div>
                    <div class="col-4">
                      <select class="form-control" name="etat">
                        <option value="">-- Filtrer par état --</option>
                        <option value="accepter" {{ request('etat') == 'accepter' ? 'selected' : '' }}>Accepté</option>
                        <option value="refuser" {{ request('etat') == 'refuser' ? 'selected' : '' }}>Refusé</option>
                        <option value="en cours" {{ request('etat') == 'en cours' ? 'selected' : '' }}>En cours</option>
                    </select>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-success" type="submit">Rechercher</button>
                    </div>
                </div>
            </form>
            </div>
                <div class="mt-3">
                  @if($demandes->isEmpty())
                     <p>Aucune demande trouvée.</p>
                  @else
                 <p> {{ request('etat') }}</p>
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 120px;text-align: center;">Nom et Prénom</th>
                        <th style="width: 120px;text-align: center;">Date de création</th>
                        <th style="width: 130px;text-align: center;">Type de projet</th>
                        <th style="width: 140px;text-align: center;">Adresse de projet </th>
                        <th style="width: 120px;text-align: center;">Montant</th>
                        <th style="width: 120px;text-align: center;">Consulter</th>
                        <th style="width: 100px;text-align: center;">Documents </th>
                        <th style="width: 120px;text-align: center;">Etats </th>
                       
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($demandes as $index=>$d)
                      <tr>
                        <td style="text-align: center;">{{$d->user->name}}</th>
                        <td style="text-align: center;">{{ $d->created_at->format('Y-m-d') }}</td>
                      <td style="text-align: center;">{{$d->typeProjet}}</td>
                      
                      <td style="text-align: center;">{{$d->adresseProjet}}</td>
                      <td style="text-align: center;">{{$d->montant}}</td>

                      <td style="text-align: center;">
                        <a data-bs-toggle="modal" data-bs-target="#detailsDemande{{$d->id}}" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                      </td>
                      
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
                      </tr>

                      
                             <!-- Modal -->
                             <div class="modal fade" id="detailsDemande{{$d->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >

                              <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4  class="modal-title" id="modal-title">Détails de la demande</h4>
                                    <button
                                      type="button"
                                      class="btn-close"
                                      data-bs-dismiss="modal"
                                      aria-label="Close"
                                    ></button>
                                  </div>
                                  <div class="modal-body">
                                  
                                    <div class="container-fluid border p-3">
                                      <div class="row">
                                    
                                        <div class="col-sm-4 text-center">
                                          <hr />
                                          <img src="{{ asset($d->user->profile_image) }}" alt="Image de Profil" style="width: 100px; height: 110px; object-fit: cover; border-radius: 60%;">
                                          <hr />
                                        </div>
                                        <!-- Informations utilisateur -->
                                        <div class="col-sm-6 offset-2">
                                          <h3>{{$d->civilite}} : {{$d->user->name}}</h3><br>
                                          <p >
                                            <i style="color: #007bff"  class="fas fa-envelope"></i> 
                                            {{$d->user->email}}
                                          </p>
                                          <p>
                                            <i style="color: #007bff" class="fas fa-map-marker-alt"></i> 
                                            {{$d->user->adresse}}
                                          </p>
                                          <p>
                                            <i style="color: #007bff" class="fas fa-phone"></i> 
                                            {{$d->user->telephone}}
                                          </p>
                                          <p>
                                            <i style="color: #007bff" class="fas fa-id-card"></i> 
                                            {{$d->user->cin}}
                                          </p>
                                          <p>
                                            <i style="color: #007bff" class="fas fa-users"></i> 
                                            {{$d->nombre_enfants}}
                                          </p>
                                          
                                        </div>
                                      </div>
                                    </div>
                                    <!-- Informations professionnelles -->
                                    <div class="container-fluid mt-4">
                                      <div class="row text-center">
                                        <div class="col-4">
                                          <h5>Informations professionnelles</h5>
                                          <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                              <i class="fa fa-arrow-right text-primary"></i> Statut
                                              professionnel :{{$d->statut_professionnel}}
                                            </li>
                                            <li class="list-group-item">
                                              <i class="fa fa-arrow-right text-primary"></i> Revenu mensuel
                                              (Net) :{{$d->revenu_mensuel}}
                                            </li>
                                            <li class="list-group-item">
                                              <i class="fa fa-arrow-right text-primary"></i> Crédit en cours
                                              :{{$d->credit}}
                                            </li>
                                          </ul>
                                        </div>
                                        <div class="col-5">
                                          <h5>Informations sur le microcrédit demandé</h5>
                                          <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                              <i class="fa fa-arrow-right text-primary"></i> Type de projet :
                                              {{$d->typeProjet}}
                                            </li>
                                            <li class="list-group-item">
                                              <i class="fa fa-arrow-right text-primary"></i> Adresse du
                                              projet :{{$d->adresseProjet}}
                                            </li>
                                            <li class="list-group-item">
                                              <i class="fa fa-arrow-right text-primary"></i> Besoins :
                                              {{$d->besoins}}
                                            </li>
                                            <li class="list-group-item">
                                              <i class="fa fa-arrow-right text-primary"></i> Montant demandé
                                              : {{$d->montant}}
                                            </li>
                                            <li class="list-group-item">
                                              <i class="fa fa-arrow-right text-primary"></i> Durée prévue de
                                              remboursement : {{$d->duree}}
                                            </li>
                                          </ul>
                                        </div>
                                        <div class="col-3">
                                          <h5>Garant</h5>
                                          <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                              <i class="fa fa-arrow-right text-primary"></i> Nom et Prénom :
                                              {{$d->garant}}
                                            </li>
                                            <li class="list-group-item">
                                              <i class="fa fa-arrow-right text-primary"></i> Montant Garant :
                                              {{$d->montantGarant}}
                                            </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  
                                    <div class="text-center mt-4">
                                      <form action="{{ route('demande.accepter', $d->id) }}" method="POST">
                                          @csrf
                                          <button type="submit" class="btn btn-success mx-2">Accepter</button>
                                      </form>
                                      <button type="button" class="btn btn-danger mx-2" data-bs-toggle="collapse" data-bs-target="#formRefuse{{$d->id}}">Refuser</button>
                                  </div>
                                  
                                 
                                  
                                  <div class="collapse" id="formRefuse{{$d->id}}">
                                    <div class="mt-3">
                                      <form action="{{ route('demande.refuser', $d->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                          <label for="raison">Raison du refus</label>
                                          <textarea class="form-control" name="raison" id="raison" required></textarea>
                                        </div>
                                        <div class="text-center mt-3">
                                          <button type="submit" class="btn btn-success">Valider</button>
                                          <button type="button" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#formRefuse{{$d->id}}">Annuler</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>

                                  
                                    
                                    
                                      


                                  </div>
                                  <div class="modal-footer">
                                    <button
                                      type="button"
                                      class="btn btn-secondary"
                                      data-bs-dismiss="modal"
                                    >
                                      Fermer
                                    </button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                    
                      @endforeach
                    </tbody>
                  </table>
                  @endif
                </div>
                 
                
            
            </div>
            </div>
          </div>
          
          
          
         
        </div>
      </div>
    </main>
    
    
                    

                     
                    
    <script src="{{asset ('dashassets/js/phoenix.js')}}"></script>
    <script src="{{asset ('dashassets/js/ecommerce-dashboard.js')}}"></script>
    
    
  </body>

</html>