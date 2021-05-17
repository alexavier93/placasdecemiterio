@extends('layouts.app')

@section('title', '- Monte sua Placa')

@section('content')

    <div class="frames">

        <div class="page-title-content">
            <h1>Monte sua Placa</h1>
            <h5><a href="">Home</a> <span>/</span> Placas</h5>
        </div>

        <div class="container">

            <form id="placaSteps" action="{{ route('placas.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="step-app placaSteps">
                    <ul class="step-steps">
                        <li data-step-target="step1">Escolha o Tamanho</li>
                        <li data-step-target="step2">Escolha o Fundo</li>
                        <li data-step-target="step3">Escolha o Modelo</li>
                        <li data-step-target="step4">Escolha os Detalhes</li>
                        <li data-step-target="step5">Insira as Informações</li>
                    </ul>

                    <div class="step-content">

                        <!-- TAMANHO -->
                        <div class="step-tab-panel" data-step="step1">

                            <section>

                                <div class="sizes">

                                    <div class="row">

                                        @foreach ($placas as $placa)

                                            <div class="col-12 col-lg-4 col-md-6">

                                                <div class="size-item">
                                                    <input type="radio" name="size" id="size-option-{{ $placa->id }}"
                                                        value="{{ $placa->id }}" title="{{ $placa->title }}"
                                                        class="input-hidden radioSize" required />

                                                    <label for="size-option-{{ $placa->id }}" class="sizeOption">
                                                        <img class="img-fluid"
                                                            src="{{ asset('storage/' . $placa->image) }}" />
                                                    </label>
                                                    <span class="price d-block"><b>Preço: R$ {{ number_format($placa->price , 2, ',', ' ') }}</b></span>
                                                </div>

                                            </div>

                                        @endforeach

                                        <div class="col-md-12 mt-5">

                                            <div class="row justify-content-between">

                                                <div class="col-md-5 col-lg-3 order-md-2">
                                                    <span>Calcular Frete</span>
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="cep" class="form-control cep" placeholder="Insira o CEP" aria-describedby="calcFrete">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary" type="button" id="calcFrete">Calcular</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 order-md-1">
                                                    <div id="tabela_correios"></div>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>

                                    </div>

                            </section>

                        </div>

                        <!-- FUNDOS -->
                        <div class="step-tab-panel" data-step="step2">
                            <section>
                                <div class="backgrounds"></div>
                            </section>
                        </div>

                        <!-- MODELOS -->
                        <div class="step-tab-panel" data-step="step3">

                            <section>
                                <div class="models"></div>
                            </section>

                        </div>

                        <!-- DETALHES (Moldura e Fonte) -->
                        <div class="step-tab-panel" data-step="step4">
                            <section>
                                <div class="details"></div>
                            </section>
                        </div>

                        <!-- INFORMAÇÃO -->
                        <div class="step-tab-panel" data-step="step5">

                            <section>

                                <div class="row information">

                                    <div class="col-12 col-lg-12 col-md-12">

                                        <div class="row">

                                            <div class="col-lg-6 col-md-12">

                                                <div class="form-group">
                                                    <label>Nome</label>
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder="João da Silva" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Data de Nascimento</label>
                                                    <input type="text" name="birthdate" class="form-control data"
                                                        placeholder="01/01/1950" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Data de Falecimento</label>
                                                    <input type="text" name="deathdate" class="form-control data"
                                                        placeholder="01/01/1999" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Frase</label>
                                                    <textarea class="form-control" name="phrase" rows="2"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Observações</label>
                                                    <textarea class="form-control" name="observation" rows="2"></textarea>
                                                </div>

                                            </div>

                                            <div class="col-lg-6 col-md-12">

                                                <div class="alert alert-warning" style="display: none;" role="alert"></div>

                                                <div class="imgCrop">
                                                    <img class="imageCropped rounded mx-auto d-block w-50 mb-4">
                                                </div>

                                                <div class="form-group">
                                                    <label>Selecione uma foto</label>
                                                    <input type="file" name="image" class="form-control image">
                                                    <input type="hidden" name="image_crop" class="imageCrop">
                                                </div>

                                                <div class="modal fade" id="modal" tabindex="-1" role="dialog"
                                                    aria-labelledby="modalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalLabel">
                                                                    Selecione uma área para recorte
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="img-container">
                                                                    <img id="image"
                                                                        src="https://avatars0.githubusercontent.com/u/3456749">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Cancelar</button>
                                                                <button type="button" class="btn btn-primary"
                                                                    id="crop">Cortar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                            </section>

                        </div>

                    </div>

                    <div class="step-footer">
                        <button data-step-action="prev" class="step-btn">Anterior</button>
                        <button data-step-action="next" class="step-btn">Próximo</button>
                        <button type="submit" data-step-action="finish" class="step-btn">Finalizar</button>
                    </div>
                </div>
            </form>

        </div>

    </div>

@endsection
