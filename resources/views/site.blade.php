<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- favicon -->
    <link rel="shortcut icon" href="site/images/favicon.png">
    <!-- Site Title -->
    <title>Rádio Amizade 98.7 - FM</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700" rel="stylesheet">
    <!-- Fonts for icons -->
    <link href="site/css/fontawesome-all.min.css" rel="stylesheet">
    <!-- bootstrap -->
    <link href="site/css/bootstrap.min.css" rel="stylesheet">
    <!-- Plugins CSS -->
    <link href="site/css/plugins/owl.carousel.min.css" rel="stylesheet">
    <link href="site/css/plugins/magnific-popup.css" rel="stylesheet">
    <link href="site/css/plugins/aos.css" rel="stylesheet">
    <link href="site/css/plugins/spacing-and-height.css" rel="stylesheet">
    <!-- Style CSS -->
    <link href="site/css/theme-modules.css" rel="stylesheet">
</head>

<body style="overflow:auto !important;">
    <div id="main-content">
        <!-- Header -->
        <!-- Navbar -->
        <nav class="navbar header-middle-logo navbar-light">
            <div class="container">
                <div class="row align-items-center no-gutters">
                    <div class="col-2 col-md-5">
                        <button class="navbar-toggler hamburger-menu-btn for-fullscreen" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span>toggle menu</span>
                        </button>

                        <div class="fullscreen-menu-holder">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="/" aria-haspopup="true" aria-expanded="false">Início</a>

                                </li>

                                <li class="nav-item ">
                                    <a class="nav-link" href="/programacao" aria-haspopup="true" aria-expanded="false">PROGRAMAÇÃO</a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/blog">Notícias</a>
                                </li>
                               
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Baixe Nosso App</a>

                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-8 col-md-2">

                        <a class="navbar-brand mx-auto" href="/">
                            <img src="site/images/logo.png" width="250" height="22" alt="Logo">
                        </a>

                    </div>
                    <div class="col-md-5">
                        <div class="navbar-modules d-flex justify-content-center justify-content-md-end mt-15px mt-md-0">

                            <div class="navbar-module">
                                <ul class="list-inline m-0">

                                    <li class="list-inline-item">
                                        @include('ao-vivo')
                                    </li>
                                    <li class="list-inline-item">
                                        Ouça Ao Vivo <br /> Amizade 98.7 FM
                                    </li>

                                </ul>
                            </div>


                        </div>

                    </div>
                </div>

            </div>
        </nav>
        <!-- End Header -->
        <!-- main -->
        <div class="page-container scene-main scene-main--fade_In">
            <!-- Slider -->
            <div id="default-carousel" class="owl-carousel default-owl-carousel">
                @foreach($banners as $item)
                <div class="owl-carousel-item">
                    <a href="{{$item->link or '#'}}">
                        <div class="bg-image">
                            <img style="max-width:100%;" src="/uploads/banners/r/{{$item->imagem}}" alt="Picture">
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <!-- Início Top 10 e Campanha principal -->
            <div class="fluid-container mb-70px">
                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div class="d-flex align-items-center">
                            <div style="margin:0 auto;">
                                <a href="/{{$promo->categoria}}">
                                    <img src="/uploads/promocoes/{{$promo->imagem}}" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Fim do Top 10 e Campanha Principal-->
            <!--Início Banners Gerais-->

            <!-- Banners Promocionais-->
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 align-items-center mb-30px">

                        <div class="et-banner">
                            <figure class="effect-banner">
                                <img src="/uploads/imagens/r/{{$top10}}" alt="image" width="770" height="512">
                            </figure>
                        </div>

                    </div>
                    <div class="col-lg-4 align-items-center mb-30px">
                        <div class="et-banner">
                            <figure class="effect-banner">
                                <a target="_blank" href="https://wa.me/555198163942">
                                    @if(strpos($programacao, '.png') !== false)
                                    <img src="/uploads/imagens/{{$programacao}}" alt="Picture" width="370" height="512">
                                    @else
                                    <img src="/uploads/imagens/r/{{$programacao}}" alt="Picture" width="370" height="512">
                                    @endif
                                </a>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mb-30px">
                <div class="row">
                    <div class="col-lg-4 align-items-center mb-30px">
                        <div class="et-banner">
                            <figure class="effect-banner">
                                <img src="/img/anuncie.jpeg" alt="Video" width="770" height="433">
                                @if(1==2)
                                <figcaption>
                                    <div class="figure_caption_container">
                                        <div class="figure_caption">
                                            <a href="#" target="_blank">
                                                <h2 class="banner-title">Botão para Link</h2>
                                            </a>
                                        </div>
                                    </div>
                                    <a href="#" target="_blank"></a>
                                </figcaption>
                                @endif
                            </figure>
                        </div>
                    </div>
                    <div class="col-lg-8 align-items-center mb-30px">
                        <div class="et-banner">
                            <figure class="effect-banner">
                                <img src="/img/programacao.jpeg" alt="Video" width="770" height="433">
                                @if(1==2)
                                <figcaption>
                                    <div class="figure_caption_container">
                                        <div class="figure_caption">
                                            <a href="#" target="_blank">
                                                <h2 class="banner-title">Botão para Link</h2>
                                            </a>
                                        </div>
                                    </div>
                                    <a href="#" target="_blank"></a>
                                </figcaption>
                                @endif
                            </figure>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mb-90px">
                <div class="row">
                    @foreach($posts as $p)
                    <div class="col-lg-4 align-items-center mb-30px">
                        <div class="et-banner">
                            <figure class="effect-banner">
                                <img src="/uploads/blog/{{$p->imagem}}" width="770" height="433">
                                <figcaption>
                                    <div class="figure_caption_container">
                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                        <div class="card-blog-content">
                            <h5 class="post_title">
                                <a href="/blog/{{$p->id}}" target="_blank">
                                    <p>{{$p->titulo}}</p>
                                </a>
                            </h5>
                            <div class="post_meta_top">
                                <span class="post_meta_date">{{$p->created_at->format('d/m/Y')}}</span>
                            </div>
                            <div class="post_content">
                                <p>{{substr($p->texto, 0, 100)}}
                                </p>
                                <a href="/blog/{{$p->id}}" target="_blank"><button type="button" class="btn m-1 btn-warning btn-sm saiba">Saiba Mais</button></a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

            <!--Fim Banners Gerais-->
            <!-- footer  -->
            <footer class="web-footer footer bg-color-blackflame all-text-content-white">
                <div class="footer-widgets pt-85px pb-55px">
                    <div class="container">
                        <div class="row large-gutters">
                            <div class="col-lg-5 mb-30px">
                                <div class="footer-widget">
                                    <h3>Rádio Amizade 98.7 FM</h3>
                                    <p class="pt-20px pt-lg-155px">© 2019 Rádio Amizade 98.7 FM</p>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-30px">
                                <div class="footer-widget">
                                    <h5 class="widget-title">Baixe nosso Mídia Kit!</h5>
                                    <h6>Exclusivo da Rádio Amizade</h6>
                                    <p><a target="_blank" href="/uploads/arquivos/radio-amizade-fm-midia-kit.pdf">Download do Kit</a></p>
                                    
                                </div>
                            </div>
                            <div class="col-lg-3 mb-30px">
                                <div class="footer-widget">
                                    <h5 class="widget-title">Contato</h5>
                                    <p>Rua Ernesto Dornelles, 693 - Centro - Igrejinha/RS</p>
                                    <p> WhatsApp: 51 9 9877 0145
                                        <br> amizade@amizade.fm.br</p>
                                    <ul class="list-inline m-0">
                                        <li class="list-inline-item">
                                            <a target="_blank" href="https://www.facebook.com/RadioAmizadeFM98.7/">
                                                <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a target="_blank" href="https://www.instagram.com/radioamizade/">
                                                <i class="fab fa-instagram" aria-hidden="true"></i>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>



        </div>





    </div>
    <!-- End main -->


    <!-- ================================================== -->
    <!-- Placed js files at the end of the document so the pages load faster -->
    <script type="text/javascript" src="site/js/jquery.min.js"></script>
    <script type="text/javascript" src="site/js/plugins/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="site/js/plugins/aos.js"></script>
    <script type="text/javascript" src="site/js/plugins/isotope.pkgd.min.js"></script>
    <script type="text/javascript" src="site/js/plugins/jquery.countdown.min.js"></script>
    <script type="text/javascript" src="site/js/plugins/jquery.countTo.js"></script>
    <script type="text/javascript" src="site/js/plugins/jquery.easing.min.js"></script>
    <script type="text/javascript" src="site/js/plugins/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="site/js/plugins/onepage.min.js"></script>
    <script type="text/javascript" src="site/js/plugins/owl.carousel.min.js"></script>
    <script type="text/javascript" src="site/js/plugins/instafeed.min.js"></script>
    <script type="text/javascript" src="site/js/plugins/imagesloaded.pkgd.min.js"></script>
    <script type="text/javascript" src="site/js/plugins/contact-us.min.js"></script>
    <script type="text/javascript" src="site/js/plugins/twitterFetcher_min.js"></script>
    <script type="text/javascript" src="site/js/main.js"></script>
</body>

</html>