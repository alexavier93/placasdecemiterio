<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Fonte;
use App\Models\Fundo;
use App\Models\Modelo;
use App\Models\Moldura;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderShipment;
use App\Models\Placa;
use Illuminate\Http\Request;
use MercadoPago\Payment;
use MercadoPago\SDK;

class PaymentController extends Controller
{

    public function mercadopago(Request $request)
    {
        if (session()->has('placa')) {

            if (session()->has('customer')) {

                $frete = $request->session()->get('frete');
                $customer = $request->session()->get('customer');
                $produtos = $request->session()->get('placa');

                $placas = Placa::all();
                $modelos = Modelo::all();
                $molduras = Moldura::all();
                $fundos = Fundo::all();
                $fontes = Fonte::all();

                $price = 0;
                foreach ($produtos as $key => $value) {
                    $price += $value['price'];
                }

                $pedido_total = $price + $frete['valor'];

                return view('payment.mpcreditcard', compact('customer', 'frete', 'produtos', 'placas', 'molduras', 'modelos', 'fundos', 'fontes', 'pedido_total'));
            } else {

                return redirect()->route('checkout.email');
            }
        } else {

            return redirect()->route('placas');
        }
    }


    public function otherpayments(Request $request)
    {
        if (session()->has('placa')) {

            if (session()->has('customer')) {

                $frete = $request->session()->get('frete');
                $customer = $request->session()->get('customer');
                $produtos = $request->session()->get('placa');

                $placas = Placa::all();
                $modelos = Modelo::all();
                $molduras = Moldura::all();
                $fundos = Fundo::all();
                $fontes = Fonte::all();

                $price = 0;
                foreach ($produtos as $key => $value) {
                    $price += $value['price'];
                }

                $pedido_total = $price + $frete['valor'];

                return view('payment.mercadopago', compact('customer', 'frete', 'produtos', 'placas', 'molduras', 'modelos', 'fundos', 'fontes', 'pedido_total'));
            } else {

                return redirect()->route('checkout.email');
            }
        } else {

            return redirect()->route('placas');
        }
    }


    public function createOrder(Request $request)
    {

        exit;

        // Gera numero do Pedido
        $codigo_pedido = rand(100000000, 999999999);

        // Verificando se código já existe
        if (Order::where('code', '=', $codigo_pedido)->exists()) {
            $codigo_pedido = rand(100000000, 999999999);
        }

        $frete = $request->session()->get('frete');

        $customer = $request->session()->get('customer');
        $customer = Customer::find($customer->id);
        $address = $customer->address()->first();

        $produtos = $request->session()->get('placa');

        $price = 0;
        foreach ($produtos as $key => $value) {
            $price += $value['price'];
        }

        $total = $price + $frete['valor'];


        // Verificando se o método é cartão de crédito ou boleto/pix
        if (isset($request->MPHiddenInputPaymentMethod)) {
            $PaymentMethod = $request->MPHiddenInputPaymentMethod;
        } elseif (isset($request->paymentMethod)) {
            $PaymentMethod = $request->paymentMethod;
        }

        // Passando os dados necessários para o pagamento
        $mpData = array(
            'transactionAmount' => $request->MPHiddenInputAmount,
            'token' => $request->MPHiddenInputToken,
            'installments' => $request->installments,
            'paymentMethod' => $PaymentMethod,
            'customer' => $customer,
            'identificationType' => $request->identificationType,
            'identificationNumber' => $request->identificationNumber,
        );

        // Chamando a função de pagamento
        $payment = $this->makePayment($mpData);

        if ($payment->error == "") {

            // Recebendo o status 
            $status_detail = $payment->status_detail;

            // Recebendo os dados do pagamento
            $transaction_details = $payment->transaction_details;

            // Verificando se o status for o certo para dar a continuidade com o pedido
            if ($payment->status_detail == 'accredited' || $payment->status_detail == 'pending_waiting_payment' || $payment->status_detail == 'pending_waiting_transfer') {

                // Dados para inserção do pedido 
                $dataOrder = array(
                    'customer_id'   => $customer->id,
                    'address_id'    => $address->id,
                    'code'          => $codigo_pedido,
                    'total'         => $total,
                    'status'         => 0,
                );

                //Inserindo Pedido
                $order = $customer->orders()->create($dataOrder);

                // Fazendo looping nos produtos e inserindo no BD
                foreach ($produtos as $produto) {

                    $order_product  = array(
                        'order_id'      => $order->id,
                        'placa_id'      => $produto['size'],
                        'modelo_id'     => $produto['model'],
                        'moldura_id'    => $produto['design'],
                        'fundo_id'      => $produto['background'],
                        'fonte_id'      => $produto['fonte'],
                        'name'          => $produto['name'],
                        'birthdate'     => $produto['birthdate'],
                        'deathdate'     => $produto['deathdate'],
                        'phrase'        => $produto['phrase'],
                        'image'         => $produto['image'],
                        'image_crop'    => $produto['image_crop'],
                        'price'         => $produto['price'],
                    );

                    $order_product = $order->order_product()->create($order_product);
                }


                //Inserindo informações do envio
                $order_shipment = array(
                    'order_id'  => $order->id,
                    'tipo'      => $frete['tipo'],
                    'prazo'     => $frete['prazo'],
                    'valor'     => $frete['valor'],
                );

                $order->order_shipment()->create($order_shipment);

                // Inserindo o método de pagamento
                $paymentMethod = array(
                    'payment_id'        => $payment->id,
                    'payment_type'      => $payment->payment_type_id,
                    'payment_method'    => $payment->payment_method_id,
                );

                $order_payment = $order->order_payment()->create($paymentMethod);

                // Pegando o método de pagamento e adicionando os detalhes do pagamento
                if ($payment->payment_type_id == 'credit_card') {

                    $paymentCreditCard = array(
                        'installments'          => $payment->installments,
                        'installment_amount'    => $transaction_details->installment_amount,
                        'total_paid_amount'     => $transaction_details->total_paid_amount
                    );

                    $order_payment->payment_creditcard()->create($paymentCreditCard);
                } elseif ($payment->payment_type_id == 'ticket') {

                    $paymentBoleto = array(
                        'payment_method_reference_id'   => $transaction_details->payment_method_reference_id,
                        'verification_code'             => $transaction_details->verification_code,
                        'total_paid_amount'             => $transaction_details->total_paid_amount,
                        'external_resource_url'         => $transaction_details->external_resource_url,
                    );

                    $order_payment->payment_boleto()->create($paymentBoleto);
                } elseif ($payment->payment_type_id == 'bank_transfer') {

                    $point_of_interaction = $payment->point_of_interaction;
                    $transaction_data = $point_of_interaction->transaction_data;

                    $paymentPix = array(
                        'total_paid_amount'     => $transaction_details->total_paid_amount,
                        'qr_code'               => $transaction_data->qr_code,
                        'qr_code_base64'        => $transaction_data->qr_code_base64,
                    );

                    $order_payment->payment_pix()->create($paymentPix);
                }

                //Inserindo informações do envio
                $order_status = array(
                    'order_id'  => $order->id,
                    'title'      => 'Em Análise',
                );

                $order->order_status()->create($order_status);

                // Mata a sessão
                $request->session()->forget('cart');

                if ($payment->status_detail == 'pending_waiting_payment' || $payment->status_detail == 'pending_waiting_transfer') {
                    flash('Estamos processando o pagamento. Em até 2 dias úteis informaremos por e-mail se foi aprovado ou se precisamos de mais informações.')->warning();
                }

                return redirect()->route('payment.order', ['code' => $codigo_pedido]);
            } else {

                $status = $this->getStatus($status_detail, null);
                flash($status)->warning();
                return redirect()->route('payment.mercadopago');
            }
        } else {

            $errors = $payment->error->causes[0]->code;
            $errors = $this->getErrors($errors);

            flash($errors)->warning();
            return redirect()->route('payment.mercadopago');
        }
    }


    public function order($code)
    {

        $order = Order::where('code', $code)->firstOrFail();

        $placas = Placa::all();
        $modelos = Modelo::all();
        $molduras = Moldura::all();
        $fundos = Fundo::all();
        $fontes = Fonte::all();

        $order->customer_id;

        $customer = Customer::find($order->customer_id);
        $address = $customer->address()->first();

        $produtos = OrderProduct::where('order_id', $order->id)->get();

        $envio = OrderShipment::where('order_id', $order->id)->first();

        return view('payment.order', compact('order', 'customer', 'address', 'produtos', 'envio', 'placas', 'molduras', 'modelos', 'fundos', 'fontes'));
    }


    public function makePayment($mpData)
    {     
        
        SDK::setAccessToken("TEST-366944516002669-111921-16d2f32a9e97f0bf5d535aaadebd2670-142390206");

        $customer = $mpData['customer'];
        $address = $customer->address()->first();

        $payment = new Payment();

        $payment->transaction_amount = (float)$mpData['transactionAmount'];
        $payment->token = $mpData['token'];
        $payment->installments = (int)$mpData['installments'];
        $payment->payment_method_id = $mpData['paymentMethod'];
        $payment->payer = array(
            "email" => $customer->email,
            "first_name" => $customer->firstname,
            "last_name" => $customer->lastname,
            "identification" => array(
                "type" => $mpData['identificationType'],
                "number" => $mpData['identificationNumber']
            ),
            "address" =>  array(
                "zip_code" => $address->cep,
                "street_name" => $address->logradouro,
                "street_number" => $address->numero,
                "neighborhood" => $address->bairro,
                "city" => $address->cidade,
                "federal_unit" => $address->uf
            )
        );

        $payment->save();

        return $payment;
    }




    #Get Status
    public function getStatus($status_detail, $statement_descriptor)
    {
        $status = [
            'accredited' => 'Pronto, seu pagamento foi aprovado! Você verá o nome ' . $statement_descriptor . ' na sua fatura de cartão de crédito. Entraremos em contato com você!',
            'pending_contingency' => 'Estamos processando o pagamento. Em até 2 dias úteis informaremos por e-mail o resultado.',
            'pending_review_manual' => 'Estamos processando o pagamento. Em até 2 dias úteis informaremos por e-mail se foi aprovado ou se precisamos de mais informações.',
            'cc_rejected_bad_filled_card_number' => 'Confira o número do cartão.',
            'cc_rejected_bad_filled_date' => 'Confira a data de validade.',
            'cc_rejected_bad_filled_other' => 'Confira os dados.',
            'cc_rejected_bad_filled_security_code' => 'Confira o código de segurança.',
            'cc_rejected_blacklist' => 'Não conseguimos processar seu pagamento.',
            'cc_rejected_call_for_authorize' => 'Você deve autorizar o pagamento do valor ao Mercado Pago.',
            'cc_rejected_card_error' => 'Não conseguimos processar seu pagamento.',
            'cc_rejected_duplicated_payment' => 'Você já efetuou um pagamento com esse valor. Caso precise pagar novamente, utilize outro cartão ou outra forma de pagamento.',
            'cc_rejected_high_risk' => 'Seu pagamento foi recusado. Escolha outra forma de pagamento. Recomendamos meios de pagamento em dinheiro.',
            'cc_rejected_insufficient_amount' => 'O cartão possui saldo insuficiente.',
            'cc_rejected_invalid_installments' => 'O cartão não processa pagamentos parcelados.',
            'cc_rejected_max_attempts' => 'Você atingiu o limite de tentativas permitido. Escolha outro cartão ou outra forma de pagamento.',
            'cc_rejected_other_reason' => 'O cartão não processou seu pagamento'
        ];

        if (array_key_exists($status_detail, $status)) {
            return $status[$status_detail];
        } else {
            return "Houve um problema na sua requisição. Tente novamente!";
        }
    }

    #Get Error
    public function getErrors($errors)
    {
        $error = [
            '205' => 'Digite o número do seu cartão.',
            '208' => 'Escolha um mês.',
            '209' => 'Escolha um ano.',
            '212' => 'Informe seu documento.',
            '213' => 'Informe seu documento.',
            '214' => 'Informe seu documento.',
            '220' => 'Informe seu banco emissor.',
            '221' => 'Informe seu sobrenome.',
            '224' => 'Digite o código de segurança.',
            'E301' => 'Há algo de errado com esse número. Digite novamente.',
            'E302' => 'Confira o código de segurança.',
            '316' => 'Por favor, digite um nome válido.',
            '322' => 'Confira seu documento.',
            '323' => 'Confira seu documento.',
            '324' => 'Confira seu documento.',
            '325' => 'Confira a data.',
            '326' => 'Confira a data.',
            '2067' => 'O CPF não é válido.'


        ];

        if (array_key_exists($errors, $error)) {
            return $error[$errors];
        } else {
            return "Houve um problema na sua requisição. Tente novamente!";
        }
    }
}
