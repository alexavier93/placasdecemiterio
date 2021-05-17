@extends('admin.layouts.app')

@section('title', '- Placas')

@section('content')

    <!-- Page Heading -->
    <div class="page-header-content py-3">

        <div class="d-sm-flex align-items-center justify-content-between">
            <h1 class="h3 mb-0 text-gray-800">Placas</h1>
        </div>

        <ol class="breadcrumb mb-0 mt-4">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.placas.index') }}">Placas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Nova Placa</li>
        </ol>

    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-xl-12 col-lg-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">

                <div class="card-header">
                    <span class="m-0 font-weight-bold text-primary">Informações</span>
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.placas.store') }}" method="post" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Título</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                    value="{{ old('title') }}">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Preço</label>
                            <div class="col-sm-10">
                                <input type="text" name="price"
                                    class="form-control money @error('price') is-invalid @enderror"
                                    value="{{ old('price') }}" placeholder="R$ 00,00">
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Altura</label>
                            <div class="col-sm-10">
                                <input type="text" name="height"
                                    class="form-control cm @error('height') is-invalid @enderror" maxlength="6"
                                    value="{{ old('height') }}" placeholder="0 cm">
                                @error('height')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Largura</label>
                            <div class="col-sm-10">
                                <input type="text" name="width" class="form-control cm @error('width') is-invalid @enderror"
                                    maxlength="6" value="{{ old('width') }}" placeholder="0 cm">
                                @error('width')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Comprimento</label>
                            <div class="col-sm-10">
                                <input type="text" name="length"
                                    class="form-control cm @error('length') is-invalid @enderror" maxlength="6"
                                    value="{{ old('length') }}" placeholder="0 cm">
                                @error('length')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Peso</label>
                            <div class="col-sm-10">
                                <input type="text" name="weight" class="form-control @error('weight') is-invalid @enderror"
                                    value="{{ old('weight') }}" placeholder="0.300 g" data-mask="0.000">
                                @error('weight')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                  

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Modelos</label>
                            <div class="col-sm-10">
                                <div class="multiple-checkbox row">
                                    @foreach ($modelos as $modelo)
                                        <div class="col-md-2">
                                            <input class="checkboxArray" type="checkbox" id="modelo-{{ $modelo->id }}" name="modelos[]"
                                                value="{{ $modelo->id }}" />
                                            <label for="modelo-{{ $modelo->id }}">
                                                <img class="img-fluid" src="{{ asset('storage/' . $modelo->image) }}" />
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Molduras</label>
                            <div class="col-sm-10">
                                <div class="multiple-checkbox row">
                                    @foreach ($molduras as $moldura)
                                        <div class="col-md-2">
                                            <input class="checkboxArray" type="checkbox" id="moldura-{{ $moldura->id }}" name="molduras[]"
                                                value="{{ $moldura->id }}" />
                                            <label for="moldura-{{ $moldura->id }}">
                                                <img class="img-fluid" src="{{ asset('storage/' . $moldura->image) }}" />
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Fundos</label>
                            <div class="col-sm-10">
                                <div class="multiple-checkbox row">
                                    @foreach ($fundos as $fundo)
                                        <div class="col-md-2">
                                            <input class="checkboxArray" type="checkbox" id="fundo-{{ $fundo->id }}" name="fundos[]"
                                                value="{{ $fundo->id }}" />
                                            <label for="fundo-{{ $fundo->id }}">
                                                <img class="img-fluid" src="{{ asset('storage/' . $fundo->image) }}" />
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Fontes</label>
                            <div class="col-sm-10">
                                <div class="multiple-checkbox row">
                                    @foreach ($fontes as $fonte)
                                        <div class="col-md-4">
                                            <input class="checkboxArray" type="checkbox" id="fonte-{{ $fonte->id }}" name="fontes[]"
                                                value="{{ $fonte->id }}" />
                                            <label for="fonte-{{ $fonte->id }}">
                                                <img class="img-fluid" src="{{ asset('storage/' . $fonte->image) }}" />
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>



                        <div class="form-group row">
                            <div class="col-sm-2">Imagem</div>
                            <div class="col-sm-10">
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </div>

                    </form>


                </div>

            </div>

        </div>

    </div>


@endsection
