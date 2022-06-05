<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Promoco;
use App\Ouvinte;
use App\OuvintePromocao;
use Illuminate\Http\Request;
use Session;

class PromocoesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
            $promocoes = Promoco::where('nome', 'LIKE', "%$keyword%")
				->orWhere('status', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $promocoes = Promoco::where('status', '=', "ativo")->orderBy('id','DESC')->paginate($perPage);
        }

        $contagem = array();

        if(isset($promocoes)){
          foreach($promocoes as $p){
            $count = OuvintePromocao::where('promocao', '=', $p['id'])
				        ->count();

            $contagem[$p['id']] = $count;
          }
        }

        return view('promocoes.index', compact('promocoes','contagem'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('promocoes.create');
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
        $this->validate($request, [
          'imagem' => 'max:1024',
        ]);

        $requestData = $request->all();

        if ($request->hasFile('imagem')) {
          $file = $request['imagem'];

          $uploadPath = public_path('/uploads/promocoes');

          $extension = $file->getClientOriginalExtension();
          $fileName = rand(11111, 99999) . '-' . str_slug($file->getClientOriginalName(), '-');

          $fileName = str_replace($extension,'.'.$extension,$fileName);

          $file->move($uploadPath, $fileName);

          $requestData['imagem'] = $fileName;
        }


        Promoco::create($requestData);

        Session::flash('flash_message', 'Promoco added!');

        return redirect('promocoes');
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
        $promoco = Promoco::findOrFail($id);

        return view('promocoes.show', compact('promoco'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $promocao = Promoco::findOrFail($id);

        return view('promocoes.edit', compact('promocao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
          'imagem' => 'max:1024',
        ]);

        $requestData = $request->all();

        if ($request->hasFile('imagem')) {
          $file = $request['imagem'];

          $uploadPath = public_path('/uploads/promocoes');

          $extension = $file->getClientOriginalExtension();
          $fileName = rand(11111, 99999) . '-' . str_slug($file->getClientOriginalName(), '-');

          $fileName = str_replace($extension,'.'.$extension,$fileName);

          $file->move($uploadPath, $fileName);

          $requestData['imagem'] = $fileName;
        }


        $promoco = Promoco::findOrFail($id);
        $promoco->update($requestData);

        Session::flash('flash_message', 'Promoco updated!');

        return redirect('promocoes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Promoco::destroy($id);

        Session::flash('flash_message', 'Promoco deleted!');

        return redirect('promocoes');
    }

    public function relatorio()
    {
      $promocoes = Promoco::where('status', '=', "ativo")->get();
      $cidades = Ouvinte::orderBy('cidade')->groupBy('cidade')->select('cidade')->get();

      return view('promocoes.relatorio', compact('promocoes','cidades'));
    }
    public function resultadoRelatorio(Request $request)
    {
      $promocoes = Promoco::where('status', '=', "ativo")->get();
      $cidades = Ouvinte::orderBy('cidade')->groupBy('cidade')->select('cidade')->get();

      if(isset($request->promocao)){
          //buscar resultados

          if($request->genero === '0'){
            if($request->cidade === '0'){
              //todos os generos, todas as cidades
              $resultados = OuvintePromocao::where('promocao', '=', $request->promocao)
              ->join('ouvintes', 'ouvinte_promocaos.ouvinte', '=', 'ouvintes.id')
              ->orderBy('ouvintes.nome')
              ->get();
            }else{
              //todos os generos, uma cidade
              $resultados = OuvintePromocao::where('promocao', '=', $request->promocao)
              ->where('ouvintes.cidade', '=', $request->cidade)
              ->join('ouvintes', 'ouvinte_promocaos.ouvinte', '=', 'ouvintes.id')
              ->orderBy('ouvintes.nome')
              ->get();
            }
          }else{
            if($request->cidade === '0'){
              //um genero, todas as cidades
              $resultados = OuvintePromocao::where('promocao', '=', $request->promocao)
              ->where('ouvintes.genero', '=', $request->genero)
              ->join('ouvintes', 'ouvinte_promocaos.ouvinte', '=', 'ouvintes.id')
              ->orderBy('ouvintes.nome')
              ->get();              
            }else{
              //um genero, uma cidade
              $resultados = OuvintePromocao::where('promocao', '=', $request->promocao)
              ->where('ouvintes.genero', '=', $request->genero)
              ->where('ouvintes.cidade', '=', $request->cidade)
              ->join('ouvintes', 'ouvinte_promocaos.ouvinte', '=', 'ouvintes.id')
              ->orderBy('ouvintes.nome')
              ->get(); 
            }
          }          
        }else{
          //TODO: exibir erro
        }

        $data = [];

        foreach($resultados as $c){
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

            if ($idade >= $request->idade_min && $idade <= $request->idade_max) {
              $c->idade = $idade;
              $data[$c->ouvinte] = $c;
            }      
        }  
        return view('promocoes.relatorio',compact('data','promocoes','cidades','request'));
    }

    public function pdf(Request $request)
    {
      $promocoes = Promoco::where('status', '=', "ativo")->get();
      $cidades = Ouvinte::orderBy('cidade')->groupBy('cidade')->select('cidade')->get();

      if(isset($request->promocao)){
        //buscar resultados

        if($request->genero === '0'){
          if($request->cidade === '0'){
            //todos os generos, todas as cidades
            $resultados = OuvintePromocao::where('promocao', '=', $request->promocao)
            ->join('ouvintes', 'ouvinte_promocaos.ouvinte', '=', 'ouvintes.id')
            ->orderBy('ouvintes.nome')
            ->get();
          }else{
            //todos os generos, uma cidade
            $resultados = OuvintePromocao::where('promocao', '=', $request->promocao)
            ->where('ouvintes.cidade', '=', $request->cidade)
            ->join('ouvintes', 'ouvinte_promocaos.ouvinte', '=', 'ouvintes.id')
            ->orderBy('ouvintes.nome')
            ->get();
          }
        }else{
          if($request->cidade === '0'){
            //um genero, todas as cidades
            $resultados = OuvintePromocao::where('promocao', '=', $request->promocao)
            ->where('ouvintes.genero', '=', $request->genero)
            ->join('ouvintes', 'ouvinte_promocaos.ouvinte', '=', 'ouvintes.id')
            ->orderBy('ouvintes.nome')
            ->get();              
          }else{
            //um genero, uma cidade
            $resultados = OuvintePromocao::where('promocao', '=', $request->promocao)
            ->where('ouvintes.genero', '=', $request->genero)
            ->where('ouvintes.cidade', '=', $request->cidade)
            ->join('ouvintes', 'ouvinte_promocaos.ouvinte', '=', 'ouvintes.id')
            ->orderBy('ouvintes.nome')
            ->get(); 
          }
        }          
      }else{
        //TODO: exibir erro
      }

        $data = [];

        foreach($resultados as $c){
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

            if ($idade >= $request->idade_min && $idade <= $request->idade_max) {
              $c->idade = $idade;
              $data[$c->ouvinte] = $c;
            }      
        }  

        $promocao = Promoco::find($request->promocao);

        return $promocao->getPdf('stream',$request, $data,$promocoes,$cidades);
    }
}
