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
        

       @include('inc.employe.sidebar')
       @include('inc.employe.nav')
 
      <div class="content">
        <div class="pb-5">
          <div class="row g-5">
            <div class="col-12 col-xxl-6">
              <div class="mb-8">
                <h2 class="mb-2">Statistique</h2>
              </div>
              <div class="row align-items-center g-4">
            
                <div class="col-12 col-md-auto">
                  <div class="d-flex align-items-center"><img src="{{ asset('dashassets/img/icons/4.png')}}" alt="" height="46" width="46">
                    <div class="ms-3">
                      <h4 class="mb-0"> {{ $clientsCount }}Clients</h4>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-auto">
                  <div class="d-flex align-items-center"><img src="{{ asset('dashassets/img/icons/4.png')}}" alt="" height="46" width="46">
                    <div class="ms-3">
                      <h4 class="mb-0"> {{ $demandesCount }} Demandes</h4>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              
             
            </div>
            <div class="col-12 col-xxl-6">
              <div class="row g-3">
                <div class="col-12 col-md-6">
                  <div class="card border border-200 shadow-none h-100">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <div>
                          <h5 class="mb-1">Total des clients</h5>
                         
                        </div>
                        <h4>{{ $clientsCount }}</h4>
                      </div>
                      <div class="d-flex justify-content-center px-4 py-6">
                        <div class="echart-total-orders" style="height:85px;width:115px" data-echarts='{"tooltip":{"show":false},"series":[{"type":"bar","barWidth":"5px","data":[120,200,150,80,70,110,120],"showBackground":true,"symbol":"none","itemStyle":{"borderRadius":10},"backgroundStyle":{"borderRadius":10}}],"grid":{"right":10,"left":10,"bottom":0,"top":0}}'></div>
                      </div>
                      <div class="mt-2">
                        <div class="d-flex align-items-center mb-2">
                          <div class="bullet-item bg-primary me-2"></div>
            
                          <h6 class="text-900 fw-semi-bold mb-0">52%</h6>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="col-12 col-md-6">
                  <div class="card border border-200 shadow-none h-100">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <div>
                          <h5 class="mb-2">Total des demandes</h5>
                        </div>
                        <h4>{{ $demandesCount }}</h4>
                      </div>
                      <div class="pb-4 pt-3">
                        <div class="echart-top-coupons" style="height:115px;width:100%;"></div>
                      </div>
                      <div>
                        <!-- Afficher les pourcentages -->
                        <div class="d-flex align-items-center mb-2">
                          <div class="bullet-item bg-primary me-2"></div>
                          <h6 class="text-900 fw-semi-bold flex-1 mb-0">Demandes en cours</h6>
                          <h6 class="text-900 fw-semi-bold mb-0">{{ number_format($enCoursPercentage, 2) }}%</h6>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                          <div class="bullet-item bg-primary-200 me-2"></div>
                          <h6 class="text-900 fw-semi-bold flex-1 mb-0">Demandes refusées</h6>
                          <h6 class="text-900 fw-semi-bold mb-0">{{ number_format($refuseePercentage, 2) }}%</h6>
                        </div>
                        <div class="d-flex align-items-center">
                          <div class="bullet-item bg-info me-2"></div>
                          <h6 class="text-900 fw-semi-bold flex-1 mb-0">Demandes acceptées</h6>
                          <h6 class="text-900 fw-semi-bold mb-0">{{ number_format($accepteePercentage, 2) }}%</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
             
              </div>
            </div>
          </div>
        </div>
     
      </div>
    </div>
  </main>
    <script src="{{ asset('dashassets/js/phoenix.js')}}"></script>
    <script src="{{ asset('dashassets/js/ecommerce-dashboard.js')}}"></script>
  </body>

</html>