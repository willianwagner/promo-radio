<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Sorteio;
use App\Promoco;
use App\Ouvinte;
use App\OuvintePromocao;
use App\SorteioGanhadore;
use Illuminate\Http\Request;
use Session;

class SorteiosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $sorteios = Sorteio::where('nome', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $sorteios = Sorteio::paginate($perPage);
        }

        return view('sorteios.index', compact('sorteios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $promocoes = Promoco::pluck('nome', 'id');

        return view('sorteios.create', compact('promocoes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();

        $sorteio = Sorteio::create($requestData);

        //sortear e guardar dados dos sorteados!
        $cadastrados = OuvintePromocao::where('promocao', '=', $sorteio->promocao_id)->join('ouvintes', 'ouvinte_promocaos.ouvinte', '=', 'ouvintes.id')->get();

        $sorteio->num_participantes = count($cadastrados);
        $sorteio->save();

        $data = array();

        foreach ($cadastrados as $c) {
          if($sorteio->somente_maior == '1'){
            // Declara a data! :P
            $data_nasc = implode(preg_match("~\/~", $c['data_nascimento']) == 0 ? "/" : "-", array_reverse(explode(preg_match("~\/~", $c['data_nascimento']) == 0 ? "-" : "/", $c['data_nascimento'])));

            // Separa em dia, mês e ano
            list($dia, $mes, $ano) = explode('/', $data_nasc);

            // Descobre que dia é hoje e retorna a unix timestamp
            $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
            // Descobre a unix timestamp da data de nascimento do fulano
            $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);

            // Depois apenas fazemos o cálculo já citado :)
            $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);

            if ($idade > 17) {
              if($sorteio->somente_igrejinha == '1'){
                if($c['cidade'] == 'Igrejinha'){
                  $data[$c->ouvinte] = $c->ouvinte;
                }
              }else{
                $data[$c->ouvinte] = $c->ouvinte;
              }
            }
          }else{
            if($sorteio->somente_igrejinha == '1'){
              //verifica se cidade é igrejinha
              if($c['cidade'] == 'Igrejinha'){
                $data[$c->ouvinte] = $c->ouvinte;
              }
            }else{
              $data[$c->ouvinte] = $c->ouvinte;
            }
          }
        }

        $sorteados = array_rand($data,$sorteio->num_sorteados);

        if ($sorteio->num_sorteados > 1) {
          foreach ($sorteados as $s) {
            //inserir em tabela, relacionando com promoção e id do sorteio
            $insert = array(
              'ouvinte_id' => $s,
              'sorteio_id' => $sorteio->id,
              'promocao_id' => $sorteio->promocao_id
            );

            SorteioGanhadore::create($insert);
          }
        }else{
          $insert = array(
            'ouvinte_id' => $sorteados,
            'sorteio_id' => $sorteio->id,
            'promocao_id' => $sorteio->promocao_id
          );

          SorteioGanhadore::create($insert);
        }

        Session::flash('flash_message', 'Sorteio added!');

        return redirect('/sorteios/'.$sorteio->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $sorteio = Sorteio::findOrFail($id);

        $dados_ganhadores = SorteioGanhadore::where('sorteio_id', '=', $sorteio->id)
        ->join('ouvintes', 'sorteio_ganhadores.ouvinte_id', '=', 'ouvintes.id')
        ->orderBy('ouvintes.nome')
        ->get();

        return view('sorteios.show', compact('sorteio','dados_ganhadores'));
    }

    public function destroy($id)
    {
        Sorteio::destroy($id);

        Session::flash('flash_message', 'Sorteio excluído!');

        return redirect('sorteios');
    }
}
