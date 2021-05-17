<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Modelo;
use App\Models\Moldura;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderShipment;
use App\Models\Placa;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $orders = $this->order->orderBy('id', 'DESC')->paginate(10);
        $orders = $orders->load('customer');
        

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($order)
    {

        $order = $this->order->findOrFail($order);
        $order->customer_id;

        $placas = Placa::all();
        $molduras = Moldura::all();
        $modelos = Modelo::all();

        $customer = Customer::find($order->customer_id);
        $address = $customer->address()->first();

        $produtos = OrderProduct::where('order_id', $order->id)->get();

        $envio = OrderShipment::where('order_id', $order->id)->first();

        return view('admin.orders.show', compact('order', 'customer', 'address', 'produtos', 'envio', 'placas', 'molduras', 'modelos'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete(Request $request)
    {

        $id = $request->id;

        $order = $this->order->find($id);

        if ($order->delete() == TRUE) {

            /*
            if (Storage::exists($modelo->image)) {
                Storage::delete($modelo->image);
            }
            */

            flash('Modelo removido com sucesso!')->success();
            return redirect()->route('admin.orders.index');
        }

    }


    public function orderby(Request $request)
    {

        $sort = request()->sort;
        $order = request()->order;

        if($order == 'desc'){
            $orders = $this->order::orderBy($sort, 'desc')->paginate(10);
            $orders = $orders->load('customer');
        }else{
            $orders = $this->order::orderBy($sort, 'asc')->paginate(10);
            $orders = $orders->load('customer');
        }

        return view('admin.orders.index', compact('orders'));
    }

}
