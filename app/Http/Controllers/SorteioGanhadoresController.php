<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SorteioGanhadore;
use Illuminate\Http\Request;
use Session;

class SorteioGanhadoresController extends Controller
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
            $sorteioganhadores = SorteioGanhadore::where('ouvinte_id', 'LIKE', "%$keyword%")
				->orWhere('sorteio_id', 'LIKE', "%$keyword%")
				->orWhere('promocao_id', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $sorteioganhadores = SorteioGanhadore::paginate($perPage);
        }

        return view('sorteio-ganhadores.index', compact('sorteioganhadores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('sorteio-ganhadores.create');
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
        
        SorteioGanhadore::create($requestData);

        Session::flash('flash_message', 'SorteioGanhadore added!');

        return redirect('sorteio-ganhadores');
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
        $sorteioganhadore = SorteioGanhadore::findOrFail($id);

        return view('sorteio-ganhadores.show', compact('sorteioganhadore'));
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
        $sorteioganhadore = SorteioGanhadore::findOrFail($id);

        return view('sorteio-ganhadores.edit', compact('sorteioganhadore'));
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
        
        $requestData = $request->all();
        
        $sorteioganhadore = SorteioGanhadore::findOrFail($id);
        $sorteioganhadore->update($requestData);

        Session::flash('flash_message', 'SorteioGanhadore updated!');

        return redirect('sorteio-ganhadores');
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
        SorteioGanhadore::destroy($id);

        Session::flash('flash_message', 'SorteioGanhadore deleted!');

        return redirect('sorteio-ganhadores');
    }
}
