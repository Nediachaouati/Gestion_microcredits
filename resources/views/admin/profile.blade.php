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
              <div>
               @include('inc.flash-message')
               <div class="text-center mb-4">
                <i> <h2 class="section-title px-5" style="color: rgb(49, 48, 48)"><span class="px-2">Modifier Profil </span></h2></i>
                   <hr/></div><br>  
                <form action="/admin/profile/update" method="POST" class="p-5 rounded-lg shadow bg-white" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-md-4 d-flex justify-content-center align-items-center">
                          <div class="profile-image-container" style="position: relative;  text-align: center;">
                            <label for="profile_image" class="camera-icon" >
                            <i class="fas fa-camera"></i>
                          </label>
                              @if(auth()->user()->profile_image)
                              <img id="profile-img" src="{{ asset(auth()->user()->profile_image) }}" alt="Photo de Profil" class="img-fluid profile-img" style="height: 380px; width: 400px; object-fit: cover; border-radius: 10px; "/>
                              @else
                                  <img id="profile-img" src="{{ asset('path/to/default/avatar.png') }}" alt="Photo de Profil" class="img-fluid profile-img" />
                              @endif
                              <input type="file" name="profile_image" id="profile_image" class="d-none" onchange="previewImage(event)">
                          </div>
                      </div>
                      <div class="col-md-8">
                        <div class="row">
                            
                  <div class="form-group mb-4">
                    <label for="">Nom Et Prénom</label>
                    <input type="text" value="{{ auth()->user()->name }}" class="form-control" name="name">
                  </div>

                  <div class="form-group mb-4">
                    <label for="">Adresse Email</label>
                    <input type="email" value="{{ auth()->user()->email }}" class="form-control" name="email" readonly>
                  </div>

                  <div class="form-group mb-4" >
                    <label for="">Mot de passe</label>
                    <input type="password" class="form-control" name="password" placeholder="nouveau mot de passe">
                  </div>

                  <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                  </div>
                        </div>
                      </div>
                  
                </form>
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