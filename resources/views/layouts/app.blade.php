<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <title>Placas Cemitério @yield('title')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery.steps@1.1.1/dist/jquery-steps.min.css">


    <link href="{{ asset('/assets/css/app.css') }}" rel="stylesheet">


</head>

<body>

    <!-- START NAVBAR SECTION -->
    <header id="header">

        <!-- NAVBAR FOR LARGE SCREEN-->
        <div class="header-nav">

            <div class="container">

                <div class="wrap">

                    <div class="logo">
                        @if (route('home'))
                            <a href="{{ route('home') }}" class="logo-main"><img
                                    src="{{ asset('/assets/images/logo-placas-cemiterio.jpg') }}" alt=""></a>
                        @else
                            <a href="{{ route('home') }}" class="logo-main"><img class="img-fluid"
                                    src="{{ asset('/assets/images/logo-placas-cemiterio.jpg') }}" alt=""></a>
                        @endif
                        <a href="{{ route('home') }}" class="logo-fix"><img class="img-fluid"
                                src="{{ asset('/assets/images/logo-placas-cemiterio.jpg') }}" alt=""></a>
                    </div>

                    <div class="menu">

                        <nav class="nav">
                            <ul>
                                <li class="nav-item">
                                    <a class="nav-link @if (\Route::current()->getName() ==
                                        'home') active @endif"
                                        href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn" href="{{ route('placas.index') }}">Monte sua placa</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('frases.index') }}">Frases</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('contato.index') }}">Contato</a>
                                </li>
                            </ul>
                        </nav>

                    </div>

                    <div class="loja">
                        <a href="{{ route('checkout.index') }}" class="cart">
                            <i class="fas fa-shopping-cart" title="Carrinho"></i>
                            <span class="badge badge-pill">
                                @if (session()->has('placa'))
                                    {{ count(session()->get('placa')) }}
                                @else
                                    0
                                @endif
                            </span>
                        </a>
                    </div>

                    <a href="javascript:void(0)" class="sidemenu_btn d-lg-none" id="sidemenu_toggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>

                </div>

            </div>



        </div>

        <!--Side Nav-->
        <div class="side-menu hidden">
            <div class="inner-wrapper">
                <span class="btn-close" id="btn_sideNavClose"><i></i></span>
                <nav class="side-nav w-100">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('placas.index') }}">Monte sua placa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('frases.index') }}">Frases</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contato.index') }}">Contato</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href=""><i class="fas fa-shopping-cart"></i> 2</a>
                        </li>


                    </ul>
                </nav>

            </div>

        </div>
        <a id="close_side_menu" href="javascript:void(0);"></a>
        <!-- End side menu -->

    </header>
    <!-- Header -->

    <main role="main">
        @yield('content')
    </main>

    <footer id="footer" class="py-4">

        <div class="container">

            <div class="row">

                <div class="col-lg-5 col-md-6">

                    <div class="footer-about mb-5 mb-md-3">
                        <a href="">
                            <img class="img-fluid w-50" src="{{ asset('assets/images/logo-espal.png') }}" alt="">
                        </a>

                        <p class="py-3">Lorem ipsum dolor sitamet,cons adipiscing elit, sed do eiusmod te incididunt ut
                            labore et
                            dolore Lorem ipsum dolor sitamet,cons adipiscing dolore Lorem ipsum dolor.</p>

                        <div class="social-media">
                            <ul>
                                <li>
                                    <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-5 mb-md-3">
                    <div class="contact">
                        <h3>Entre em Contato</h3>

                        <ul>
                            <li>
                                <i class="fas fa-phone-alt"></i>
                                <a href="tel:Phone:+822456974">(00) 9232-9323</a>
                            </li>

                            <li>
                                <i class="fas fa-envelope"></i>
                                <a href="mailto:hello@surety.com">contato@placas.com.br</a>
                            </li>

                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                Rua Professora Giacomina de Fellipi, 1905<br>
                                Vila Centenário - Esp. Santo do Pinhal – SP
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-5 mb-md-3">
                    <div class="menu">
                        <h3>Service Links</h3>

                        <ul>
                            <li>
                                <a href="#">
                                    Frases
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Fale Conosco
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    A Empresa
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Política de Privacidade
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Política de Troca e Devolução
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Termos e Condições de Uso
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </footer>

    <div class="copy-right text-center">
        <p>Copyright © {{ now()->year }} Placas de Cemitério</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.steps@1.1.1/dist/jquery-steps.min.js"></script>
    <script src="https://sdk.mercadopago.com/js/v2"></script>

    <script src="{{ asset('/assets/js/app.js') }} "></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        

        $(document).on('click', '#calcFrete', function() {

                var cep = $('#cep').val();
                var placa = $('input[name=size]:checked').val();

                if($('input[name=size]:checked').val()){

                    $('#tabela_correios').empty();
                    $('#tabela_correios').append("<div id='loading' class='text-center'><img style='width: 40px;' src='{{ asset('assets/images/loading.gif') }}' alt='Loading...' /></div>");
                    
                    $.ajax({
                        url: "{{ route('placas.calcFrete') }}",
                        method: "POST",
                        data: {
                            cep: cep,
                            placa: placa,
                        },
                        dataType: "json",
                        cache: false,
                        success: function(response) {
                            setTimeout(function() {
                                $('#tabela_correios').html(response);
                            }, 200);
                            
                        }
                    });

                }else{
                    alert('Por favor, selecione um tamanho!');
                }

        });


        $(".radioSize").change(function() {

            if ($(this).is(":checked")) {
                var placa = $(this).val();
            }

            $.ajax({
                url: "{{ route('placas.getDetails') }}",
                type: 'POST',
                data: 'placa=' + placa,
                dataType: 'text',
                success: function(response) {
                    $(".details").html(response);
                }
            });

        });

        $(".radioSize").change(function() {

            if ($(this).is(":checked")) {
                var placa = $(this).val();
            }

            $.ajax({
                url: "{{ route('placas.getmodelo') }}",
                type: 'POST',
                data: 'placa=' + placa,
                dataType: 'text',
                success: function(response) {
                    $(".models").html(response);
                }
            });

        });

        $(".radioSize").change(function() {

            if ($(this).is(":checked")) {
                var placa = $(this).val();
            }

            $.ajax({
                url: "{{ route('placas.getfundo') }}",
                type: 'POST',
                data: 'placa=' + placa,
                dataType: 'text',
                success: function(response) {
                    $(".backgrounds").html(response);
                }
            });

        });

        $('#cepConsulta').blur(function() {
            var cep = $(this).val();
            consultaCep(cep);
        });

        function consultaCep(cep) {

            $.ajax({
                url: "{{ route('checkout.consultaCep') }}",
                type: 'POST',
                data: 'cep=' + cep,
                dataType: 'json',
                success: function(response) {
                    $('input[name=logradouro]').val(response.logradouro);
                    $('input[name=bairro]').val(response.bairro);
                    $('input[name=cidade]').val(response.cidade);
                    $('input[name=uf]').val(response.uf);
                    $('input[name=numero]').focus();
                }
            });

            return false;

        }

        $(".frete").click(function() {

            var valorFrete = $("input[name=frete]:checked").val();

            $.ajax({
                url: "{{ route('checkout.calcFrete') }}",
                type: 'POST',
                data: 'valorFrete=' + valorFrete,
                dataType: 'json',
                beforeSend: function() {
                    $(".valorFrete").toggle().empty();
                    $(".valorTotal").toggle().empty();
                },
                success: function($data) {
                    $('.valorFrete').toggle().html($data['valorFrete']);
                    $('.valorTotal').toggle().html($data['valorTotal']);
                    $('input[name=valorTotal]').val($data['valorTotal']);
                }

            });

        });


        var $modal = $('#modal');
        var image = document.getElementById('image');
        var cropper;

        $("body").on("change", ".image", function(e) {
            var files = e.target.files;
            var done = function(url) {
                image.src = url;
                $modal.modal('show');
            };
            var reader;
            var file;
            var url;
            if (files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 500 / 625,
                viewMode: 3,
                movable: false,
                zoomable: false,
                rotatable: false,
                scalable: false
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $("#crop").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 500,
                height: 625,
            });
            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('placas.uploadCropImage') }}",
                        data: {
                            'image': base64data
                        },
                        success: function(data) {

                            $modal.modal('hide');

                            $('.imageCrop').val(data['imageCrop']);
                            $('img.imageCropped').attr("src", data['imageCropped']);

                        },
                        error: function() {
                            $('.alert-warning').text(
                                'Ocorreu um erro ao recortar a imagem, tente novamente!'
                            );
                            $('.alert-warning').css("display", "block");
                        }
                    });
                }
            });
        });

    </script>

</body>

</html>
