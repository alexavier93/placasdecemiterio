<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = $this->user->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        $data = $request->all();

        if (isset($request->status)) {
            $data['status'] = 1;
        }

        $data['password'] = Hash::make($request->password);

        $this->user->create($data);

        flash('Usuário criado com sucesso!')->success();
	    return redirect()->route('admin.users.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        $user = $this->user->findOrFail($user);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $user)
    {

        $data = $request->all();

        if (isset($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->status == 1) {
            $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }

	    $user = $this->user->find($user);
	    $user->update($data);

	    flash('Usuário atualizado com Sucesso!')->success();
	    return redirect()->route('admin.users.index');
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

        $user = $this->user->find($id);

        if ($user->delete() == TRUE) {

            flash('Usuário removido com sucesso!')->success();
            return redirect()->route('admin.users.index');

        }
        
    }
}
