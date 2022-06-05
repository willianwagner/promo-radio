<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Top;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;

class TopController extends Controller
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

        $periodo = new \stdClass();

        if(isset($request->ano) && isset($request->mes)){
            $periodo->ano = $request->ano;
            $periodo->mes = $request->mes;
        }else{
            //se não tiver informado período, redirect para mês atual
            $now = Carbon::now();
            $periodo->ano = $now->year;
            $periodo->mes = $now->month;
            return redirect('top10/'.str_pad($periodo->mes, 2, '0', STR_PAD_LEFT).'/'. $periodo->ano);
        }

        $top = Top::where('mes','=',$periodo->mes)
            ->where('ano','=',$periodo->ano)
            ->get();

        return view('top.index', compact('top','periodo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('top.create');
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
        

        if ($request->hasFile('capa')) {
            foreach($request['capa'] as $file){
                $uploadPath = public_path('/uploads/capa');

                $extension = $file->getClientOriginalExtension();
                $fileName = rand(11111, 99999) . '.' . $extension;

                $file->move($uploadPath, $fileName);
                $requestData['capa'] = $fileName;
            }
        }

        Top::create($requestData);

        Session::flash('flash_message', 'Top added!');

        return redirect('top');
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
        $top = Top::findOrFail($id);

        return view('top.show', compact('top'));
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
        $top = Top::findOrFail($id);

        return view('top.edit', compact('top'));
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
            'artista' => 'required',
            'musica' => 'required',
          ]);

          $requestData = $request->all();

          if ($request->hasFile('capa')) {
            $file = $request['capa'];
  
            $uploadPath = public_path('/uploads/capa');
  
            $extension = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '-' . str_slug($file->getClientOriginalName(), '-');
  
            $fileName = str_replace($extension,'.'.$extension,$fileName);
  
            $file->move($uploadPath, $fileName);
            $requestData['capa'] = $fileName;
          }
  

        $top = Top::findOrFail($id);
        $top->update($requestData);

        Session::flash('flash_message', 'Top updated!');

        return redirect('top');
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
        Top::destroy($id);

        Session::flash('flash_message', 'Top deleted!');

        return redirect('top');
    }

    public function gerar(Request $request)
    {
        $ano = $request->ano;
        $mes = $request->mes;

        //verificar se já existem registros para mes informado
        //só cadastrar se ainda nao tiver
        $existente = Top::where('mes','=',$mes)
            ->where('ano','=',$ano)
            ->count();

        if($existente > 0){
            Session::flash('flash_message', 'Já existem registros para o período!');

            return redirect('top10/'.$mes.'/'.$ano);
        }

        for($i=1;$i<=10;$i++){
            $requestData = array();

            $requestData['mes'] = $mes;
            $requestData['ano'] = $ano;
            $requestData['artista'] = '';
            $requestData['musica'] = '';
            $requestData['capa'] = '';
            $requestData['ativo'] = 'ativo';
            $requestData['posicao'] = $i;

            Top::create($requestData);
        }

        Session::flash('flash_message', 'Top added!');

        return redirect('top10/'.$mes.'/'.$ano);
    }

}
