<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Fonte;
use App\Models\Fundo;
use App\Models\Modelo;
use App\Models\Moldura;
use App\Models\Placa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cagartner\CorreiosConsulta\CorreiosConsulta;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //dd($request->session()->get('placa'));

        $placas = $request->session()->get('placa');

        if (session()->get('placa') == null) {

            return redirect()->route('placas.index');
        } elseif (session()->has('placa')) {

            $produtos = $request->session()->get('placa');

            $placas = Placa::all();
            $modelos = Modelo::all();
            $molduras = Moldura::all();
            $fundos = Fundo::all();
            $fontes = Fonte::all();

            return view('checkout.index', compact('produtos', 'placas', 'molduras', 'modelos', 'fundos', 'fontes'));
        } else {

            return redirect()->route('placas.index');
        }
    }


    public function removePlaca(Request $request, $id)
    {

        $placas = $request->session()->get('placa');

        foreach ($placas as $placa => $key) {

            if ($key['id'] == $id) {

                $image = $key['image'];

                //Excluindo imagem
                if (Storage::exists($image)) {
                    Storage::delete($image);
                }

                // Excluindo a chave e salvando em seguida
                $request->session()->forget('placa.' . $placa);
                session()->save();
            }
        }

        flash('Placa removida com sucesso!')->success();
        return redirect()->route('checkout.index');
    }

    /**
     * 
     * Página para realizar a autenticação
     * 
     */
    public function auth()
    {

        if (session()->has('placa')) {

            if (session()->has('customer')) {
                return redirect()->route('checkout.shipment');
            } else {
                return view('checkout.auth');
            }
        } else {
            return redirect()->route('placas.index');
        }
    }

    /**
     * 
     * Função de autenticação com email, caso não haja, será redirecionado para o cadastro
     * 
     */
    public function doAuth(Request $request)
    {

        $this->validate($request, [
            'email'     => 'required|email',
        ]);

        $customer = DB::table('customers')
            ->where('email', $request->email)
            ->first();

        if ($customer == true) {

            if ($customer->status == 0) {

                flash('Olá, seu acesso está bloqueado, por favor entrar em contato conosco!')->warning();
                return redirect()->route('checkout.auth');
            } else {

                session()->put('customer', $customer);
                return redirect()->route('checkout.shipment')->withErrors('ERROS');
            }
        } else {

            return redirect()->route('checkout.customer');
        }
    }

    /**
     * 
     * Página com dados do comprador
     * 
     */
    public function customer(Request $request)
    {

        if (session()->has('placa')) {

            $produtos = $request->session()->get('placa');

            $placas = Placa::all();
            $modelos = Modelo::all();
            $molduras = Moldura::all();
            $fundos = Fundo::all();
            $fontes = Fonte::all();

            return view('checkout.customer', compact('produtos', 'placas', 'molduras', 'modelos', 'fundos', 'fontes'));
        } else {
            return redirect()->route('placas.index');
        }
    }

    /**
     * 
     * Função para salvar dados do comprador
     * 
     */
    public function createCustomer(Request $request)
    {

        $customer = array(
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'birthdate' => $request->birthdate,
            'cpf' => limpaCPF_CNPJ($request->cpf),
            'email' => $request->email,
            'phone' => $request->phone,
            'type' => 1,
            'status' => 1,
        );

        $returnCustomer = Customer::create($customer);

        if ($returnCustomer == true) {

            $customer = DB::table('customers')->where('email', $request->email)->first();

            session()->put('customer', $customer);

            flash('Cadastro salvo com sucesso!')->success();
            return redirect()->route('checkout.address');
        } else {

            flash('Ocorreu um erro!')->success();
            return redirect()->route('checkout.customer');
        }
    }


    public function address(Request $request)
    {

        if (session()->has('placa')) {

            if (session()->has('customer')) {

                $customer = $request->session()->get('customer');
                $produtos = $request->session()->get('placa');

                $placas = Placa::all();
                $modelos = Modelo::all();
                $molduras = Moldura::all();
                $fundos = Fundo::all();
                $fontes = Fonte::all();

                return view('checkout.address', compact('produtos', 'customer', 'placas', 'molduras', 'modelos', 'fundos', 'fontes'));
            } else {
                return redirect()->route('checkout.auth');
            }
        } else {
            return redirect()->route('placas.index');
        }
    }

    public function createAddress(Request $request)
    {

        $session = $request->session()->get('customer');

        $customer = DB::table('customers')->where('id', $session->id)->first();

        $customerAddress = array(
            'customer_id' => $customer->id,
            'cep' => str_replace("-", "", $request->cep),
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'uf' => $request->uf,
        );

        $returnAddress = Address::create($customerAddress);

        if ($returnAddress == true) {
            flash('Endereço salvo com sucesso!')->success();
            return redirect()->route('checkout.shipment');
        } else {
            flash('Ocorreu um erro!')->success();
            return redirect()->route('checkout.address');
        }
    }



    /**
     * 
     * Página para editar os dados do comprador
     * 
     */
    public function edit(Request $request)
    {

        if (session()->has('placa')) {

            if (session()->has('customer')) {

                $customer_session = $request->session()->get('customer');
                $customer = Customer::find($customer_session->id);
                $address = $customer->address()->first();

                return view('checkout.edit_customer', compact('customer', 'address'));
            } else {
                return redirect()->route('checkout.auth');
            }
        } else {
            return redirect()->route('placas.index');
        }
    }

    /**
     * 
     * Função para atualizar os dados do comprador
     * 
     */
    public function updateCustomer(Request $request, $id)
    {

        $updateCustomer = Customer::findOrFail($id);
        $updateAddress = Address::where('customer_id', $id)->first();

        $customer = array(
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'birthdate' => $request->birthdate,
            'cpf' => limpaCPF_CNPJ($request->cpf),
            'email' => $request->email,
            'phone' => $request->phone,
        );

        $customerAddress = array(
            'cep' => str_replace("-", "", $request->cep),
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'uf' => $request->uf,
        );

        $returnCustomer = $updateCustomer->update($customer);

        if ($updateAddress->isEmpty()) {
            $updateCustomer->address()->create($customerAddress);
        } else {
            $updateCustomer->address()->update($customerAddress);
        }


        if ($returnCustomer == true) {

            $customer = DB::table('customers')->where('email', $request->email)->first();

            flash('Cadastro salvo com sucesso!')->success();
            return redirect()->route('checkout.edit');
        } else {

            flash('Ocorreu um erro!')->success();
            return redirect()->route('checkout.customer');
        }
    }

    public function logout()
    {
        session()->forget('customer');
        return redirect()->route('checkout.auth');
    }

    /**
     * 
     * Página para escolher a forma de envio
     * 
     */
    public function shipment(Request $request)
    {

        if (session()->has('placa')) {

            if (session()->has('customer')) {

                $produtos = $request->session()->get('placa');

                $placas = Placa::all();
                $modelos = Modelo::all();
                $molduras = Moldura::all();
                $fundos = Fundo::all();
                $fontes = Fonte::all();

                $customer_session = $request->session()->get('customer');
                $customer = Customer::find($customer_session->id);
                $address = $customer->address()->first();

                if ($address == null) {

                    return redirect()->route('checkout.address');
                } else {

                    $total_peso = 0;
                    $total_cm_cubico = 0;

                    foreach ($produtos as $produto) {

                        $placa_id = $produto['size'];

                        $placa = Placa::find($placa_id);

                        $row_peso = $placa->weight * 1;
                        $row_cm = ($placa->height * $placa->width * $placa->length) * 1;

                        $total_peso += $row_peso;
                        $total_cm_cubico += $row_cm;
                    }

                    // Calculando a Raiz Cubica dos produtos
                    $raiz_cubica = round(pow($total_cm_cubico, 1 / 3), 2);

                    // Os valores 16, 2, 11 e 0.3 são os valores mínimos determinados pelo serviço dos Correios
                    $comprimento =  $raiz_cubica < 16 ? 16 : $raiz_cubica;
                    $altura = $raiz_cubica < 2 ? 2 : $raiz_cubica;
                    $largura = $raiz_cubica < 11 ? 11 : $raiz_cubica;
                    $peso = $total_peso < 0.3 ? 0.3 : $total_peso;
                    $diametro = hypot($comprimento, $largura); // Calculando a hipotenusa pois minhas encomendas são retangulares

                    $dados = [
                        'tipo'              => 'sedex,pac', // Separar opções por vírgula (,) caso queira consultar mais de um (1) serviço. > Opções: `sedex`, `sedex_a_cobrar`, `sedex_10`, `sedex_hoje`, `pac`, 'pac_contrato', 'sedex_contrato' , 'esedex'
                        'formato'           => 'caixa', // opções: `caixa`, `rolo`, `envelope`
                        'cep_destino'       => $address->cep, // Obrigatório
                        'cep_origem'        => '89062086', // Obrigatorio
                        //'empresa'         => '', // Código da empresa junto aos correios, não obrigatório.
                        //'senha'           => '', // Senha da empresa junto aos correios, não obrigatório.
                        'peso'              => $peso, // Peso em kilos
                        'comprimento'       => $comprimento, // Em centímetros
                        'altura'            => $altura, // Em centímetros
                        'largura'           => $largura, // Em centímetros
                        'diametro'          => $diametro, // Em centímetros, no caso de rolo
                        // 'mao_propria'       => '1', // Náo obrigatórios
                        // 'valor_declarado'   => '1', // Náo obrigatórios
                        // 'aviso_recebimento' => '1', // Náo obrigatórios
                    ];

                    $correios = new CorreiosConsulta();
                    $envio = $correios->frete($dados);
                }

                return view('checkout.shipment', compact('customer', 'address', 'envio', 'produtos', 'placas', 'molduras', 'modelos', 'fundos', 'fontes'));
            } else {
                return redirect()->route('checkout.auth');
            }
        } else {
            return redirect()->route('placas.index');
        }
    }

    /**
     * 
     * Função para inserir os valores retornados do frete, inserir um total na session placa
     * 
     */
    function frete(Request $request)
    {

        $request->validate([
            'frete' => 'required',
        ]);

        $frete = $request->except(['valorTotal', '_token']);

        $freteArray  = explode(', ', implode($frete));

        $frete = array(
            'tipo' => $freteArray['0'],
            'prazo' => $freteArray['1'],
            'valor' => $freteArray['2'],
        );

        $customer = $request->session()->get('customer');

        session()->put('frete', $frete);

        if ($customer->type == 1) {
            return redirect()->route('payment.mercadopago');
        } else {

            echo 'revendendor';
        }
    }


    /**
     * 
     * Função para calcular o frete e o valor total
     * 
     */
    function calcFrete(Request $request)
    {

        $valorFrete = $request->valorFrete;

        $produtos = $request->session()->get('placa');

        $price = 0;
        foreach ($produtos as $key => $value) {
            $price += $value['price'];
        }

        $pedido = number_format($price);

        $freteArray  = explode(',', $valorFrete);
        $frete = $freteArray['2'];

        $total_pedido = $frete + $pedido;

        $valorFrete = str_replace('.', ',', number_format($frete, 2));
        $valorTotal = str_replace('.', ',', number_format($total_pedido, 2));

        $result = array(
            'valorFrete' => $valorFrete,
            'valorTotal' => $valorTotal,
        );

        echo json_encode($result);
    }


    /**
     * 
     * Função para consultar o CEP
     * 
     */
    function consultaCep(Request $request)
    {

        $cep = $request->cep;

        $consulta = str_replace("-", "", $cep);

        $result = simplexml_load_file("http://viacep.com.br/ws/" . $consulta . "/xml/");

        $dados = array(
            'logradouro' => (string) $result->logradouro,
            'bairro' => (string) $result->bairro,
            'cidade' => (string) $result->localidade,
            'uf' => (string) $result->uf
        );

        echo json_encode($dados);
    }
}
