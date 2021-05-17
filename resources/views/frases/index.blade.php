@extends('layouts.app')

@section('title', '- Frases')

@section('content')

    <div id="frases">

        <div class="container">

            <div class="page-title-content">
                <h1>Frases</h1>
                <h5><a href="">Home</a> <span>/</span> Frases</h5>
            </div>

            <div class="row">

                <div class="col-md-12">
                    @include('flash::message')
                </div>

                <div class="col-md-12 col-sm-12">

                    @foreach ($frases as $frase)

                    <div class="card my-3">
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <p>{!! $frase->text !!}</p>
                                <footer class="blockquote-footer">{{ $frase->author }}</footer>
                            </blockquote>
                        </div>
                    </div>

                    @endforeach

                </div>


            </div>

        </div>

    </div>

@endsection
