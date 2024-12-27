
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tamouilek</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset ('mainassets/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset ('mainassets/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset ('mainassets/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset ('mainassets/css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset ('mainassets/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset ('mainassets/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset ('mainassets/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset ('mainassets/css/style.css')}}" type="text/css">
  <style>
      .section-header h3 {
        font-size: 32px;
        color: #111;
        text-transform: uppercase;
        text-align: center;
        font-weight: 700;
        position: relative;
        padding-bottom: 15px;
      }
      
      .section-header h3::before {
        content: "";
        position: absolute;
        display: block;
        width: 120px;
        height: 1px;
        background: #ddd;
        bottom: 1px;
        left: calc(50% - 60px);
      }
      
      .section-header h3::after {
        content: "";
        position: absolute;
        display: block;
        width: 40px;
        height: 3px;
        background: #0b73ba;
        bottom: 0;
        left: calc(50% - 20px);
      }
      
      .section-header p {
        text-align: center;
        padding-bottom: 30px;
        color: #333;
      }
    
      
  </style>


</head>

<body>

    <div id="preloder">
        <div class="loader"></div>
    </div>

    
    <header class="header">
        
        <div class="container">
            <div class="row">
                <div class="col-md-6"> 
                    <div class="header__logo">
                        <a href="/"><img src="{{ asset('dashassets/img/icons/logoMicro.png')}}" height="70px" width="110px" alt=""></a>
                        <span class="business"><span style="color:#04A1DE;">TAMOUILEK</span></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="/">Accueil</a></li>
                          
                            <li><a href="/contact">Contacts</a></li>
                            <li><a href="/login">Se connecter</a></li>
                            <li><a href="/register">S'inscrire</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
           
        </div>
    </header>

    <section class="hero">
        <div class="hero__slider owl-carousel">
            <div class="hero__items set-bg" data-setbg="{{ asset('mainassets/img/home/img1.jpg') }}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                               
                                    <h2 style=" color:rgb(12, 87, 131)">Crédits agricole</h2>
                                    <p style="font-size: 30px; font-weight: bold; color: rgb(10, 10, 10);">Un prêt adapté pour vos projets agricoles</p>

                               
                               
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
        
        
            <div class="hero__items set-bg" data-setbg="{{ asset('mainassets/img/home/acc1.png')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                               
                                <h2 style="color:rgb(12, 87, 131)"></h2>
                                <h2 style="color: rgb(12, 87, 131);">Financer vos projets</h2>
                                <p style="font-size: 30px; font-weight: bold; color: rgb(10, 10, 10);">Un prêt adapté pour tout type de projet</p>
                                
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
    </section>
   
    <section class="categories spad">
        <div class="container">
            <header class="section-header">
                <h3>À propos</h3>
                <br>
                <p style="color:rgb(48, 46, 46); font-size: 17px;"><strong>Tamouilek </strong>  
                     est une application innovante de gestion des microcrédits conçue pour soutenir les entrepreneurs et les personnes souvent exclues du système bancaire traditionnel. Notre mission est de faciliter l'accès au financement pour ceux qui souhaitent réaliser leurs projets, mais qui n'ont pas les moyens de le faire par les canaux classiques. Grâce à une approche personnalisée, Tamouilek offre des prêts adaptés aux besoins spécifiques de chaque utilisateur, favorisant ainsi l'inclusion financière et l'autonomisation des communautés. Nous croyons fermement que chaque idée mérite d'être concrétisée et que chacun, peu importe sa situation financière, devrait avoir la chance de réussir.</p>
                  
                
                </header>
        </div>
 

<br><br>



<br><br>

<div class="container">
    <header class="section-header">
        <h3>Nos Services</h3>
        <br>
        <div class="row ">
            <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{ asset('mainassets/img/product/agricole.jpg')}}">
                        
                    </div>
                    <div class="product__item__text">
                        <h6>MicroCrédit Agricole</h6>
                      
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{ asset('mainassets/img/product/etudiant.png')}}">
                        
                    </div>
                    <div class="product__item__text">
                        <h6>MicroCrédit Etudiant</h6>
                    
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{ asset('mainassets/img/product/artisant.png')}}"> 
                        
                    </div>
                    <div class="product__item__text">
                        <h6>MicroCrédit Artisanat</h6>
                    
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{ asset('mainassets/img/product/commerce.jpg')}}"> 
                        
                    </div>
                    <div class="product__item__text">
                        <h6>MicroCrédit Commerce</h6>
                     
                    </div>
                </div>
            </div>
        </div>
    </header>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="{{ asset ('dashassets/img/icons/logoMicro.png')}}" height="90px" width="130px" alt=""></a>
                        </div>
                       
                    </div>
                </div>
                
                
           
                <div class="col-lg-12 text-center">
                    <div class="footer__copyright__text">
    
                        <p>Copyright ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>   Tamouilek. All Rights Reserved. <i class="fa fa-heart-o"
                            aria-hidden="true"></i>  <a href="https://colorlib.com" target="_blank"></a>
                           
                                <a href="#"><i class="fa fa-facebook" style="color:rgb(7, 7, 136)"></i></a>
                                <a href="#"><i class="fa fa-twitter" style="color:rgb(7, 7, 136)"></i></a>
                                <a href="#"><i class="fa fa-pinterest" style="color:rgb(7, 7, 136)"></i></a>
                                <a href="#"><i class="fa fa-instagram" style="color:rgb(7, 7, 136)"></i></a>
                            
                        </p>
                  
                    </div>
                    
                </div>
            
        </div>
    </footer>
   
    <script src="{{ asset ('mainassets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset ('mainassets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset ('mainassets/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{ asset ('mainassets/js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{ asset ('mainassets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset ('mainassets/js/jquery.countdown.min.js')}}"></script>
    <script src="{{ asset ('mainassets/js/jquery.slicknav.js')}}"></script>
    <script src="{{ asset ('mainassets/js/mixitup.min.js')}}"></script>
    <script src="{{ asset ('mainassets/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset ('mainassets/js/main.js')}}"></script>
</body>

</html>