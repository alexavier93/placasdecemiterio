<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    
    private $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = $this->message->orderBy('id', 'DESC')->paginate(10);

        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($message)
    {
        $message = $this->message->findOrFail($message);
        return view('admin.messages.show', compact('message'));
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

        $message = $this->message->findOrFail($id);
	    $message->delete();

	    flash('Mensagem excluída com sucesso!')->success();
	    return redirect()->route('admin.messages.index');
    }
}
