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
        
        <!--include-->
        @include('inc.employe.sidebar')
        @include('inc.employe.nav')

        
        <div class="content">
          <div class="pb-5">
            <div class="row g-5">
            <div> 
              <div class="text-center mb-4">
                <h2 class="section-title px-5" style="color: rgb(49, 48, 48)"><span class="px-2">Liste des Clients </span></h2></i>
                  <hr/></div>
                <div class="mt-3"> 
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th style="width: 50px;text-align: center;">ID</th>
                            <th style="width: 120px;text-align: center;">Image</th>
                            <th style="width: 160px;text-align: center;">Nom et Prénom</th>
                            <th style="width: 120px;text-align: center;">Email</th>
                            <th style="width: 120px;text-align: center;">Adresse</th>
                            <th style="width: 120px;text-align: center;">Téléphone</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($clients as $index => $client)
                          <tr>
                            <th scope="row" style="text-align: center;">{{$index + 1}}</th>
                            <td style="text-align: center;"><img src="{{ asset($client->profile_image) }}" alt="Image de Profil" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;"></td>
                            <td style="text-align: center;">{{$client->name}}</td>
                            <td style="text-align: center;">{{$client->email}}</td>
                            <td style="text-align: center;">{{$client->adresse}}</td>
                            <td style="text-align: center;">{{$client->telephone}}</td>
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

    
                    
    <script src="{{ asset('dashassets/js/phoenix.js')}}"></script>
    <script src="{{ asset('dashassets/js/ecommerce-dashboard.js')}}"></script>
  </body>

</html>