<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class CustomerController extends Controller
{

    private $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $customers = $this->customer->paginate(10);

        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($customer)
    {

        $customer = $this->customer->findOrFail($customer);
        $address = $customer->address()->first();
        
        return view('admin.customers.show', compact('customer', 'address'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $this->customer->create($data);

        flash('Cliente criado com sucesso!')->success();
	    return redirect()->route('admin.customers.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($customer)
    {
        $customer = $this->customer->findOrFail($customer);
        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $customer)
    {

        $data = $request->all();

        if ($request->status == null) {
            $data['status'] = '0';
        }

        $customer = $this->customer->find($customer);
	    $customer->update($data);

	    flash('Cliente atualizado com sucesso!')->success();
	    return redirect()->route('admin.customers.index');
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

        $customer = $this->customer->findOrFail($id);

        if ($customer->delete() == TRUE) {
      
            flash('Cliente removido com sucesso!')->success();
            return redirect()->route('admin.customers.index');

        }

        
    }

    public function orderby(Request $request)
    {

        $sort = request()->sort;
        $order = request()->order;

        if($order == 'desc'){
            $customers = $this->customer::orderBy($sort, 'desc')->paginate(10);
        }else{
            $customers = $this->customer::orderBy($sort, 'asc')->paginate(10);
        }

        return view('admin.customers.index', compact('customers'));
    }


    
}
