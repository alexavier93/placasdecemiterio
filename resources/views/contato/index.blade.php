@extends('layouts.app')

@section('title', '- Contato')

@section('content')

    <div id="contato">

        <div class="container">

            <div class="page-title-content">
                <h1>Contato</h1>
                <h5><a href="">Home</a> <span>/</span> Contato</h5>
            </div>

            <div class="row">

                <div class="col-xl-8 col-md-12 col-sm-12 form">

                    <h5>Entre em contato conosco preenchendo o formulário abaixo. Enviaremos um retorno em breve.</h4>

                    @include('flash::message')

                    <form action="{{ route('contato.enviaEmail') }}" method="POST" class="my-4">
                        @csrf

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nome">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="E-mail">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="phone" class="form-control telefone @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Telefone">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}" placeholder="Assunto">
                                    @error('subject')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5" placeholder="Mensagem">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>

                        </div>

                    </form>

                </div>

                <div class="col-xl-4 col-md-12 col-sm-12 mt-4 mt-md-0 mb-5 mb-md-0 info">

                    <h5><b>Espal Distribuidora de Vidros, Ferragens e Alumínios EIRELI – EPP</b></h5>


                    <ul>
                        <li>
                            <div class="info">
                                <div class="item-icon"><i class="fas fa-phone-alt"></i></div>
                                <div class="info-meta">+55 (19) 3651-6158</div>
                            </div>
                        </li>

                        <li>
                            <div class="info">
                                <div class="item-icon"><i class="fas fa-mobile-alt"></i></div>
                                <div class="info-meta">+55 (19) 99155-1850</div>
                            </div>
                        </li>

                        <li>
                            <div class="info">

                                <div class="item-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>

                                <div class="info-meta">
                                    <b>Esp. Santo do Pinhal – SP</b><br>
                                    <span>Rua Professora Giacomina de Fellipi, 1905<br>Vila Centenário</span>
                                </div>

                            </div>
                        </li>
                    </ul>

                </div>

            </div>

        </div>

        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2043.5943623327194!2d-46.770224454080804!3d-22.193217917013218!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xcecb9bf1ebbe382d!2sEspal%20Personalizados!5e0!3m2!1spt-BR!2sbr!4v1607213076414!5m2!1spt-BR!2sbr"
                        width="100%" height="350" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>
        </div>

    </div>

@endsection
