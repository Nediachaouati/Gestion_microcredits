
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
    
      h5 img {
            width: 24px; 
            height: auto; 
            margin-left: 8px; 
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
                            <li><a href="/">Accueil</a></li>
                          
                            <li class="active"><a href="/contact">Contacts</a></li>
                            <li><a href="/login">Se connecter</a></li>
                            <li><a href="/register">S'inscrire</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
           
        </div>
    </header>
 
    <br>
    <h2 class="text-center" style="color: blue; font-weight: bold; text-decoration: underline;">Où nous trouver</h2>
    <br>
    <div class="map">
        <iframe 
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3192.7094762098454!2d10.195500111522273!3d36.84943337211725!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12fd34c5fdc1366f%3A0x8e6e80bd11a41145!2sNewTech%20IT!5e0!3m2!1sen!2stn!4v1718227805132!5m2!1sen!2stn"
    style="border: 0; width: 100%; height: 500px;" 
    allowfullscreen="" 
    loading="lazy" 
    referrerpolicy="no-referrer-when-downgrade">
</iframe>

    </div>

    <section class="contact spad">
        <h2 class="text-center" style="color: blue; font-weight: bold; text-decoration: underline;">Contactez-nous</h2>
<br><br>
        <div class="container">
           
            <div class="row">
             
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        
                        <ul>
                            <h4><i class="fas fa-map-marker-alt"></i> <strong>Adresse</strong></h4>
                            <br>
                            <li>
                                <h5 >
                                    Tunisie
                                    <img src="{{ asset ('mainassets/img/product/tn.png')}}" alt="">
                                </h5>
                                <p>Ariana centre</p>
                            </li>
                           
                            <h4><i class="fas fa-phone-alt"></i></i> <strong>Numéro Télephone</strong></h4>
                            <li>
                                
                                <p>Tunisie
                                    +216 21 618 110</p>
                            </li>
                            <h4><i class="fas fa-envelope"></i></i> <strong>E-mail</strong></h4>
                            <li>
                                
                                <p>contact@tamouilek.net</p>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        <form action="#">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Nom">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Email">
                                </div>
                                <div class="col-lg-12">
                                    <textarea placeholder="Message"></textarea>
                                    <button type="submit" class="site-btn">Envoyer Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
                            </script>  Tamouilek. All Rights Reserved. <i class="fa fa-heart-o"
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