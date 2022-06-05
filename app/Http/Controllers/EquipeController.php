<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Equipe;
use Illuminate\Http\Request;
use Session;

class EquipeController extends Controller
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
            $equipe = Equipe::where('nome', 'LIKE', "%$keyword%")
				->orWhere('descricao', 'LIKE', "%$keyword%")
				->orWhere('imagem', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $equipe = Equipe::paginate($perPage);
        }

        return view('equipe.index', compact('equipe'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('equipe.create');
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
            'nome' => 'required',
            'descricao' => 'required'
          ]);
          
        $requestData = $request->all();
        
        if(isset($request['imagem_url']) && $request['imagem_url'] != ''){
            $requestData['imagem'] = $request['imagem_url'];
        }

        Equipe::create($requestData);

        Session::flash('flash_message', 'Equipe added!');

        return redirect('equipe');
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
        $equipe = Equipe::findOrFail($id);

        return view('equipe.show', compact('equipe'));
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
        $equipe = Equipe::findOrFail($id);

        return view('equipe.edit', compact('equipe'));
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
            'nome' => 'required',
            'descricao' => 'required'
          ]);

        $requestData = $request->all();
        
        if(isset($request['imagem_url']) && $request['imagem_url'] != ''){
            $requestData['imagem'] = $request['imagem_url'];
        }
  
        $equipe = Equipe::findOrFail($id);
        $equipe->update($requestData);

        Session::flash('flash_message', 'Equipe updated!');

        return redirect('equipe');
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
        Equipe::destroy($id);

        Session::flash('flash_message', 'Equipe deleted!');

        return redirect('equipe');
    }

    public function uploadImage(Request $request)
    {

        $image = $request->image;

        list($type, $image) = explode(';', $image);

        list(, $image)      = explode(',', $image);

        $image = base64_decode($image);

        $image_name= time().'.png';

        $path = public_path('/uploads/equipe/'.$image_name);

        file_put_contents($path, $image);

        return response()->json(['status'=>true,'url'=>$image_name]);

    }
}
