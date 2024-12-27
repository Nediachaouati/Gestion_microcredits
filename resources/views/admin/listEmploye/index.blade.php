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
    <link href="{{ asset('dashassets/css/phoenix.min.css')}}" rel="stylesheet" id="style-default">
    <link href="{{ asset('dashassets/css/user.min.css')}}" rel="stylesheet" id="user-style-default">
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
        
        @include('inc.admin.sidebar')
        @include('inc.admin.nav')

        
        <div class="content">
          <div class="pb-5">
            <div class="row g-5">
              <div >
                <div class="text-center mb-4">
                <h2 class="section-title px-5" style="color: rgb(49, 48, 48)"><span class="px-2">Liste des Employés </span></h2></i>
                  <hr/></div>
                <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary  mt-3"><i class="bi bi-person-add"></i> Ajouter Employé</a>
                <!--Tableau de list des employés-->
               <br> 
                <div class="mt-3"> 
                  <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 50px;text-align: center;">ID</th>
                      <th style="width: 120px;text-align: center;">Image</th>
                      <th style="width: 160px;text-align: center;">Nom et Prénom</th>
                      <th style="width: 120px;text-align: center;">Matricule</th>
                      <th style="width: 120px;text-align: center;">Email</th>
                      <th style="width: 120px;text-align: center;">Téléphone</th>
                      <th style="width: 120px;text-align: center;">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $index =>$u)
                    <tr>
                      <th scope="row" style="text-align: center;">{{$index +1}}</th>
                      <td style="text-align: center;"><img src="{{ asset($u->profile_image) }}" alt="Image de Profil" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;"></td>
                      <td style="text-align: center;">{{$u->name}}</td>
                      <td style="text-align: center;">{{$u->matricule}}</td>
                      <td style="text-align: center;">{{$u->email}}</td>
                      <td style="text-align: center;">{{$u->telephone}}</td>
                      <td style="text-align: center;">
                          <a onclick="return confirm('Voulez-vous vraiment supprimer cet employé ? ')" href="/admin/listEmploye/{{$u->id}}/delete" class="btn btn-danger" title="Supprimer"><i class="fas fa-trash-alt"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table></div>
               
            </div>
              
            </div>
          </div>
         <footer class="footer">
            <div class="row g-0 justify-content-between align-items-center h-100 mb-3"> 
            </div>
          </footer>
        </div>
      </div>
    </main>

    <!--Modal AjoutEmployé Form -->
   
                      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Ajouter Employé</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><svg class="svg-inline--fa fa-times fa-w-11 fs--1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" data-fa-i2svg=""><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg><!-- <span class="fas fa-times fs--1"></span> Font Awesome fontawesome.com --></button>
                            </div>
                            <!--chemin vers la liste employé-->
                            <form action="/admin/listEmploye/store" method="post">
                              @csrf
                            <div class="modal-body">

                      <div class="mb-3"><label class="form-label" for="exampleFormControlInput1">Nom et Prénom</label> <input name="name" class="form-control" id="exampleFormControlInput1" type="text" placeholder="Nom et Prénom">
                      <!--en cas d'erreur au niveau des champs-->
                        @error('name') 
                        <div class="alert alert-danger">
                          {{ $message }}
                        </div>
                        @enderror
                        </div>
                      
                        

                      <div class="mb-3"><label class="form-label" for="exampleFormControlInput1">Matricule</label> <input name="matricule" class="form-control" id="exampleFormControlInput1" type="number" placeholder="Matricule">
                        @error('matricule') 
                        <div class="alert alert-danger">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>

                      <div class="mb-3"><label class="form-label" for="exampleFormControlInput1">Téléphone</label> <input name="telephone" class="form-control" id="exampleFormControlInput1" type="number" placeholder="Téléphone">
                        @error('telephone') 
                        <div class="alert alert-danger">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>


                      <div class="mb-3"><label class="form-label" for="exampleFormControlInput1">Email</label> <input name="email" class="form-control" id="exampleFormControlInput1" type="text" placeholder="name@example.com">
                      
                        @error('email') 
                        <div class="alert alert-danger">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>

                      <div class="mb-3"><label class="form-label" for="exampleFormControlInput1">Mot de passe</label> <input name="password" class="form-control" id="exampleFormControlInput1" type="password" placeholder="Mot de passe">
                        @error('password') 
                        <div class="alert alert-danger">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    
                            </div>
                            <div class="modal-footer"><button class="btn btn-primary" type="submit">Ajouter</button>
                              <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Annuler</button></div>
                            </form>
                          </div>
                        </div>
                      </div>
                    
    <script src="{{ asset('dashassets/js/phoenix.js')}}"></script>
    <script src="{{ asset('dashassets/js/ecommerce-dashboard.js')}}"></script>
  </body>

</html>