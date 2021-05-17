@extends('admin.layouts.app')

@section('title', '- Mensagens')

@section('content')

    <!-- Page Heading -->
    <div class="page-header-content py-3">

        <div class="d-sm-flex align-items-center justify-content-between">
            <h1 class="h3 mb-0 text-gray-800">Mensagens</h1>
        </div>

        <ol class="breadcrumb mb-0 mt-4">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.messages.index') }}">Mensagens</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $message->subject }}</li>
        </ol>

    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-xl-12 col-lg-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">

                <div class="card-header">
                    <span class="m-0 font-weight-bold text-primary">Enviado - {{ $message->created_at->format('d/m/Y') }}</span>
                    <a href="javascript:;" data-toggle="modal" data-id='{{ $message->id }}' data-target="#modalDelete" class="btn btn-sm btn-danger float-right">Excluir</a>
                </div>

                <div class="card-body p-5">

                    <div class="col-9">

                        <p class="lead">{{ $message->name }}</p>

                        <div class="font-weight-bold">{{ $message->email }}</div>
                        <div class="font-weight-bold">{{ $message->phone }}</div>

                        <p class="my-2"><em>{{ $message->description }}</em></p>

                    </div>



                </div>


            </div>

        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h5 class="py-3 m-0">Tem certeza que deseja excluir este registro?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fechar</button>
                    <form action="{{ route('admin.messages.delete') }}" method="post" class="float-right">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{ $message->id }}">
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection



