@extends('admin.layouts.app')

@section('title', '- Pedidos')

@section('content')

    <!-- Page Heading -->
    <div class="page-header-content py-3">

        <div class="d-sm-flex align-items-center justify-content-between">
            <h1 class="h3 mb-0 text-gray-800">Pedidos</h1>
        </div>

        <ol class="breadcrumb mb-0 mt-4">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pedidos</li>
        </ol>

    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">


            <!-- Project Card Example -->
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <span class="m-0 font-weight-bold text-primary">Pedidos</span>
                </div>

                <div class="card-body">

                    <div class="table-orders d-none d-sm-block">

                        <table class="table table-bordered">

                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">
                                        @if (request()->get('sort') == 'created_at')
                                            @if (request()->get('order') == 'desc')
                                                <a href="{{ url('admin/orders/orderby?sort=created_at&order=asc') }}">Data <i class="fas fa-angle-down"></i></a>
                                            @else
                                                <a href="{{ url('admin/orders/orderby?sort=created_at&order=desc') }}">Data <i class="fas fa-angle-up"></i></a>
                                            @endif
                                        @else
                                            <a href="{{ url('admin/orders/orderby?sort=created_at&order=desc') }}">Data</a>
                                        @endif
                                    </th>
                                    <th scope="col">
                                        @if (request()->get('sort') == 'firstname')
                                            @if (request()->get('order') == 'desc')
                                                <a href="{{ url('admin/orders/orderby?sort=firstname&order=asc') }}">Nome <i class="fas fa-angle-down"></i></a>
                                            @else
                                                <a href="{{ url('admin/orders/orderby?sort=firstname&order=desc') }}">Nome <i class="fas fa-angle-up"></i></a>
                                            @endif
                                        @else
                                            <a href="{{ url('admin/orders/orderby?sort=firstname&order=desc') }}">Nome</a>
                                        @endif
                                    </th>
                                    <th scope="col">
                                        @if (request()->get('sort') == 'total')
                                            @if (request()->get('order') == 'desc')
                                                <a href="{{ url('admin/orders/orderby?sort=total&order=asc') }}">Valor <i class="fas fa-angle-down"></i></a>
                                            @else
                                                <a href="{{ url('admin/orders/orderby?sort=total&order=desc') }}">Valor <i class="fas fa-angle-up"></i></a>
                                            @endif
                                        @else
                                            <a href="{{ url('admin/orders/orderby?sort=total&order=desc') }}">Valor</a>
                                        @endif
                                    </th>
                                    
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($orders as $order)

                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $order->customer->firstname .' '. $order->customer->lastname }}</td>
                                        <td>{{ number_format($order->total, 2, ',', ' ')  }}</td>
                                        <td width="15%">
                                            <a href="{{ route('admin.orders.show', ['order' => $order->id]) }}" class="btn btn-sm btn-primary">Ver</a>
                                            <a href="javascript:;" data-toggle="modal" data-id='{{ $order->id }}' data-target="#modalDelete" class="btn btn-sm btn-danger delete">Excluir</a>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

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
                    <form action="{{ route('admin.orders.delete') }}" method="post" class="float-right">
                        @csrf
                        <input type="hidden" id="id" name="id">
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
