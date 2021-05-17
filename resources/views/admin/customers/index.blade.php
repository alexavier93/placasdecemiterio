@extends('admin.layouts.app')

@section('title', '- Clientes')

@section('content')

    <!-- Page Heading -->
    <div class="page-header-content py-3">

        <div class="d-sm-flex align-items-center justify-content-between">
            <h1 class="h3 mb-0 text-gray-800">Clientes</h1>
            <a href="{{ route('admin.customers.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus text-white-50"></i> Novo Cliente
            </a>
        </div>

        <ol class="breadcrumb mb-0 mt-4">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Clientes</li>
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
                    <span class="m-0 font-weight-bold text-primary">Clientes</span>

                    <a href="{{ route('admin.customers.create') }}"
                        class="btn btn-sm btn-primary float-right d-block d-sm-none">Novo Cliente</a>
                </div>

                <div class="card-body">

                    <div class="table-customers d-none d-sm-block">

                        <table class="table table-bordered">

                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">
                                        @if (request()->get('sort') == 'firstname')
                                            @if (request()->get('order') == 'desc')
                                                <a href="{{ url('admin/customers/orderby?sort=firstname&order=asc') }}">Nome <i class="fas fa-angle-down"></i></a>
                                            @else
                                                <a href="{{ url('admin/customers/orderby?sort=firstname&order=desc') }}">Nome <i class="fas fa-angle-up"></i></a>
                                            @endif
                                        @else
                                            <a href="{{ url('admin/customers/orderby?sort=firstname&order=desc') }}">Nome</a>
                                        @endif
                                    </th>
                                    <th scope="col">
                                        @if (request()->get('sort') == 'email')
                                            @if (request()->get('order') == 'desc')
                                                <a href="{{ url('admin/customers/orderby?sort=email&order=asc') }}">E-mail <i class="fas fa-angle-down"></i></a>
                                            @else
                                                <a href="{{ url('admin/customers/orderby?sort=email&order=desc') }}">E-mail <i class="fas fa-angle-up"></i></a>
                                            @endif
                                        @else
                                            <a href="{{ url('admin/customers/orderby?sort=email&order=desc') }}">E-mail</a>
                                        @endif
                                    </th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($customers as $customer)

                                    <tr>
                                        <td>{{ $customer->id }}</th>
                                        <td>{{ $customer->firstname .' '. $customer->lastname}}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td width="20%">
                                            <a href="{{ route('admin.customers.show', ['customer' => $customer->id]) }}" class="btn btn-sm btn-info">Ver</a>
                                            <a href="{{ route('admin.customers.edit', ['customer' => $customer->id]) }}" class="btn btn-sm btn-primary">Editar</a>
                                            <a href="javascript:;" data-toggle="modal" data-id='{{ $customer->id }}' data-target="#modalDelete" class="btn btn-sm btn-danger delete">Excluir</a>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                        {{ $customers->links() }}

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
                    <form action="{{ route('admin.customers.delete') }}" method="post" class="float-right">
                        @csrf
                        <input type="hidden" id="id" name="id">
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
