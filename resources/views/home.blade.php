@extends('layouts.app')

@section('content')

    <div id="home">

        <!-- Banner Section -->
        <section class="banner-section">

            <div class="banner-carousel owl-carousel owl-theme">

                @foreach ($banners as $banner)
                    @if ($banner->status == 1)
                        <!-- Slide Item -->
                        <div class="slide-item" style="background-image: url('{{ asset('storage/' . $banner->image) }}');"></div>
                    @endif
                @endforeach

            </div>

        </section>

        <!-- Section About Us  -->
        <section class="about-us py-3">

            <div class="container">

                <div class="row align-items-center">

                    <div class="col-lg-6 col-md-6">
                        <div class="about-img-3 mb-4 mb-md-3" data-wow-delay=".2s">
                            <img class="rounded img-fluid" src="{{ asset('assets/images/tipos-vidros.png') }}" alt="Image">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">

                        <div class="about-content">

                            <div class="title-section">
                                <span></span>
                                <h2>Quem Somos</h2>
                            </div>

                            <p>Somos a empresa pioneira na tecnologia de Impressão em Vidro no Brasil. A SPAL é a marca final de uma caminhada de mais de 30 anos no ramo da Vidraçaria. A impressão em vidro sempre foi um sonho um pouco distante... Sonhamos, pesquisamos, buscamos e é com muito orgulho que hoje podemos dizer que conquistamos este sonho! Hoje somos a empresa que traz para o Brasil um produto exclusivo, de qualidade ímpar e capaz de perdurar sua homenagem por várias gerações.   </p>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- Section How To Do  -->
        <section class="how-todo py-3">

            <div class="container">

                <div class="title-section title-section-center">
                    <span></span>
                    <h2>Como Funciona?</h2>
                </div>

                <div class="video-section col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 text-center">
                    <img src="https://cdn.dribbble.com/users/1677309/screenshots/4078509/daily-ui-challenge-086-progress-bar.png"
                        alt="" class="img-fluid">
                    <a href="https://www.youtube.com/watch?v=hzyMh6fMeHk" class="youtube video-box-button-holder">
                        <div class="absolute-middle-center">
                            <img class="icon-play" src="{{ asset('assets/images/icon-play.png') }}" alt="">
                        </div>
                    </a>
                </div>

            </div>

        </section>

        <!-- Section Steps  -->
        <section class="steps py-4 my-4">

            <div class="container">

                <div class="info">

                    <div class="row">

                        <div class="col-md-2 item text-center offset-md-1">
                            <img src="{{ asset('assets/images/size.png') }}" alt="">
                            <h5>Defina o tamanho</h5>
                        </div>

                        <div class="col-md-2 item text-center">
                            <img src="{{ asset('assets/images/models.png') }}" alt="">
                            <h5>Escolha o modelo</h5>
                        </div>

                        <div class="col-md-2 item text-center">
                            <img src="{{ asset('assets/images/frame.png') }}" alt="">
                            <h5>Moldura e Cor</h5>
                        </div>

                        <div class="col-md-2 item text-center">
                            <img src="{{ asset('assets/images/info.png') }}" alt="">
                            <h5>Insira as informações</h5>
                        </div>

                        <div class="col-md-2 item text-center">
                            <img src="{{ asset('assets/images/order.png') }}" alt="">
                            <h5>Conclua o pedido</h5>
                        </div>

                        <div class="col-md-12 text-center mt-3">
                            <a href="{{ route('placas.index') }}" class="btn btn-default btn-more">Criar Placa</a>
                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- Section About Us  -->
        <section class="personalizados py-4">

            <div class="container">

                <div class="row align-items-center">

                    <div class="col-lg-6 col-md-6">


                        <div class="about-content">

                            <div class="title-section">
                                <span>Placas personalizadas</span>
                                <h2>Lorem ipsum dolor sit amet consectetur</h2>
                            </div>

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Quis</p>


                        </div>

                    </div>

                    <div class="col-lg-6 col-md-6">

                        <div class="wpp text-center wow fadeInRight" data-wow-delay=".2s"
                            style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInRight;">

                            <a href="" class="btn btn-default btn-whatsapp">WhatsApp <i class="fab fa-whatsapp"></i></a>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>


@endsection
