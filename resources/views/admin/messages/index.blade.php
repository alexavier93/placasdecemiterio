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
            <li class="breadcrumb-item active" aria-current="page">Mensagens</li>
        </ol>

    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            @include('flash::message')

            <!-- Project Card Example -->
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <span class="m-0 font-weight-bold text-primary">Mensagens</span>
                </div>

                <div class="card-body">

                    <div class="table-messages d-none d-sm-block">

                        <table class="table table-bordered">

                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Assunto</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($messages as $message)

                                    <tr>
                                        <td>{{ $message->id }}</th>
                                        <td>{{ $message->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $message->name }}</td>
                                        <td>{{ $message->email }}</td>
                                        <td>{{ $message->subject }}</td>

                                        <td width="15%">
                                            <a href="{{ route('admin.messages.show', ['message' => $message->id]) }}" class="btn btn-sm btn-primary">Ver</a>
                                            <a href="javascript:;" data-toggle="modal" data-id='{{ $message->id }}' data-target="#modalDelete" class="btn btn-sm btn-danger delete">Excluir</a>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                        {{ $messages->links() }}
                        
                    </div>

                    <div class="list-messages">

                        <ul class="list-group d-block d-sm-none">

                            <li class="list-group-item">

                                <div class="row">

                                    <div class="col-xs-12 col-sm-6">
                                        <h6>José Maria <span class="badge badge-success">Ativo</span></h6>
                                        <small class="text-muted">email@email.com</small>
                                        <small class="text-muted"></small>
                                    </div>

                                    <div class="col-xs-12 col-sm-6">

                                        <div class="btn-group mt-3" role="group">
                                            <a href="#" class="btn btn-sm btn-primary">Editar</a>
                                            <a href="#" class="btn btn-sm btn-danger">Excluir</a>
                                        </div>

                                    </div>
                                </div>

                            </li>

                            <li class="list-group-item">

                                <div class="row">

                                    <div class="col-xs-12 col-sm-6">
                                        <h6>Alexandre Xavier <span class="badge badge-success">Ativo</span></h6>
                                        <small class="text-muted">email@email.com</small>
                                        <small class="text-muted"></small>
                                    </div>

                                    <div class="col-xs-12 col-sm-6">

                                        <div class="btn-group mt-3" role="group">
                                            <a href="#" class="btn btn-sm btn-primary">Editar</a>
                                            <a href="#" class="btn btn-sm btn-danger">Excluir</a>
                                        </div>

                                    </div>
                                </div>

                            </li>

                        </ul>

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
                        <input type="hidden" id="id" name="id">
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
