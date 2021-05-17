<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Placa;
use Cagartner\CorreiosConsulta\CorreiosConsulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PlacaController extends Controller
{

    private $placa;

    public function __construct(Placa $placa)
    {
        $this->placa = $placa;
    }


    public function index(Request $request)
    {

        //$request->session()->flush();

        $placas = $this->placa->all();

        return view('placas.index', compact('placas'));
    }

    public function create(Request $request)
    {

        $data = $request->all();


        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $image = $request->file('image')->store('tmp_placas', 'public');
            $nameImg = $image;
            $image = Image::make(public_path("storage/{$image}"));
            $image->save();

            if (!$image) {
                flash('Problema no envio da imagem')->danger();
                return redirect()->route('placas');
            }
        }


        $placa_id = $data['size'];
        $placa = Placa::find($placa_id);

        $data['id'] = rand(100000000, 999999999);
        $data['image'] = $nameImg;
        $data['price'] = $placa->price;

        session()->push('placa', $data);

        return redirect()->route('checkout.index');
    }


    public function getDetails(Request $request)
    {

        $id_placa = $request->placa;

        $molduras = Placa::find($id_placa)->molduras()->where('placa_id', $id_placa)->get()->toArray();
        $fontes = Placa::find($id_placa)->fontes()->where('placa_id', $id_placa)->get()->toArray();

        $view = view('placas.detalhes', compact('molduras', 'fontes'))->render();
        return $view;
    }

    public function getmodelo(Request $request)
    {

        $id_placa = $request->placa;

        $modelos = Placa::find($id_placa)->modelos()->where('placa_id', $id_placa)->get()->toArray();

        $view = view('placas.modelos', compact('modelos'))->render();
        return $view;
    }

    public function getfundo(Request $request)
    {

        $id_placa = $request->placa;

        $fundos = Placa::find($id_placa)->fundos()->where('placa_id', $id_placa)->get()->toArray();

        $view = view('placas.fundos', compact('fundos'))->render();
        return $view;
    }

    public function calcFrete(Request $request)
    {


        $placa = Placa::find($request->placa);


        $total_peso = 0;
        $total_cm_cubico = 0;

        $row_peso = $placa->weight * 1;
        $row_cm = ($placa->height * $placa->width * $placa->length) * 1;

        $total_peso += $row_peso;
        $total_cm_cubico += $row_cm;

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
            'cep_destino'       => $request->cep, // Obrigatório
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
        $correios = $correios->frete($dados);

        $html = '';

        $html .= '
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">Frete</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Prazo</th>
                    </tr>
                </thead>
                <tbody>
        
        ';

        foreach ($correios as $correio) {

            $html .= '
                <tr>
                    <th scope="row">'. $correio['tipo'] .'</th>
                    <td> R$ '. str_replace('.', ',', number_format($correio['valor'], 2)) .'</td>
                    <td>'. (5 + $correio['prazo']) .' dias</td>
                </tr>
            ';
            
        }

        $html .= '
                </tbody>
            </table>
        
        ';

        echo json_encode($html);
    }

    public function uploadCropImage(Request $request)
    {

        $folderPath = public_path('storage/tmp_placas/');

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $hash = str_replace('.', '', str_replace('/', '', Hash::make('&U%v3#tBcpeA%0Rs')));

        $imageName =  $hash . '.' . $image_type;

        $imageFullPath = $folderPath . $imageName;

        file_put_contents($imageFullPath, $image_base64);

        $imageCrop = 'tmp_placas/' . $imageName;
        $imageCropped = asset('storage/' . $imageCrop);

        return response()->json(['msgSuccess' => 'Imagem recortada com sucesso!', 'imageCrop' => $imageCrop, 'imageCropped' => $imageCropped]);
    }
}
