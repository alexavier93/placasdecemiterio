<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Message;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {

        if (Auth::check()) {

            $customer = Customer::all()->count();
            $order = Order::all()->count();
            $message = Message::all()->count();

            return view('admin.home.index', compact('customer', 'order', 'message'));
        }

        return redirect()->route('admin.login');
    }


    public function orderNotification()
    {

        if (isset($_POST["view"])) {

            if ($_POST["view"] != '') {
                Order::where('status', 0)->update(['status' => 1]);
            }

            $ordersRow = Order::orderBy('id')->limit(3)->count();

            $output = '';

            if ($ordersRow > 0) {

                $orders = Order::orderBy('id','DESC')->limit(3)->get();

                foreach ($orders as $order) {

                    $output .= '<a class="dropdown-item d-flex align-items-center" href="' . route('admin.orders.show', ['order' => $order->id]) . '">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">' . $order->created_at->format('d/m/Y') . '</div>
                                        <span class="font-weight-bold">Novo pedido '.$order->code.' </span>
                                    </div>
                                </a>';
                }

            } else {

                $output .= '
                        <a class="dropdown-item d-flex align-items-center" href="">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <span class="font-weight-bold">Não há novo pedido!</span>
                            </div>
                        </a>
                    ';
            }


            $count = Order::where('status', 0)->count();

            $data = array(
                'notification' => $output,
                'unseen_notification'  => $count
            );

            echo json_encode($data);

        }
    }


    public function messageNotification()
    {

        if (isset($_POST["view"])) {

            if ($_POST["view"] != '') {
                Message::where('status', 0)->update(['status' => 1]);
            }

            $messagesRow = Message::orderBy('id')->limit(5)->count();

            $output = '';

            

            if ($messagesRow > 0) {

                $messages = Message::orderBy('id','DESC')->limit(5)->get();

                foreach ($messages as $message) {

                    $output .= '
                                <a class="dropdown-item d-flex align-items-center" href="'. route('admin.messages.show', ['message' => $message->id]) .'">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">'.$message->description.'</div>
                                        <div class="small text-gray-500">'.$message->name.' · '.$message->created_at->format('d/m/Y').'</div>
                                    </div>
                                </a>';
                }

            } else {

                $output .= '
                        <a class="dropdown-item d-flex align-items-center" href="">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <span class="font-weight-bold">Não há nenhuma mensagem!</span>
                            </div>
                        </a>
                    ';
            }


            $count = Message::where('status', 0)->count();

            $data = array(
                'notification' => $output,
                'unseen_notification'  => $count
            );

            echo json_encode($data);

        }
    }

}
