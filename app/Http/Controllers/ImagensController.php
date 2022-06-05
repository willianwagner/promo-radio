<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Imagem;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\ImageManagerStatic as Image;

class ImagensController extends Controller
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
            $imagens = Imagem::where('imagem', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $imagens = Imagem::paginate($perPage);
        }

        return view('imagens.index', compact('imagens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('imagens.create');
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


        if ($request->hasFile('imagem')) {
          $file = $request['imagem'];

          $uploadPath = public_path('/uploads/imagens');

          $extension = $file->getClientOriginalExtension();
          $fileName = rand(11111, 99999) . '-' . str_slug($file->getClientOriginalName(), '-');

          $fileName = str_replace($extension,'.'.$extension,$fileName);

          $file->move($uploadPath, $fileName);

            // open an image file
            $img = Image::make($uploadPath.'/'.$fileName)->resize(1440, 838);

            // finally we save the image as a new file
            $img->save($uploadPath.'/r/'.$fileName);

          $requestData['imagem'] = $fileName;

          Imagem::create($requestData);

          Session::flash('flash_success', 'Imagem cadastrada!');
          return redirect('imagens');
        }else{
          Session::flash('flash_danger', 'Nenhuma imagem enviada!');
          return redirect('imagens/create');
        }


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
        $imagem = Imagem::findOrFail($id);

        return view('imagens.show', compact('imagem'));
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
        $imagem = Imagem::findOrFail($id);
        switch($imagem->link){
          case 'top-10':
            $tamanho = '770x512';
            break;
          case 'programacao-radio':
            $tamanho = '370x512';
            break;
          default:
            $tamanho = '';
            break;
        }

        return view('imagens.edit', compact('imagem','tamanho'));
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


        if ($request->hasFile('imagem')) {
          $file = $request['imagem'];

          $uploadPath = public_path('/uploads/imagens');

          $extension = $file->getClientOriginalExtension();
          $fileName = rand(11111, 99999) . '-' . str_slug($file->getClientOriginalName(), '-');

          $fileName = str_replace($extension,'.'.$extension,$fileName);

          $file->move($uploadPath, $fileName);

            // open an image file
            switch($requestData['link']){
              case 'top-10':
                $lar = '770';
                $alt = '512';
                break;
              case 'programacao-radio':
                $lar = '370';
                $alt = '512';
                break;
              default:
                $lar = 1;
                $alt = 1;
                break;
            }
    
            $img = Image::make($uploadPath.'/'.$fileName)->resize($lar, $alt);

            // finally we save the image as a new file
            $img->save($uploadPath.'/r/'.$fileName);


          $requestData['imagem'] = $fileName;
        }

        $imagem = Imagem::findOrFail($id);
        $imagem->update($requestData);

        Session::flash('flash_success', 'Imagem alterada!');

        return redirect('imagens');
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
        Imagem::destroy($id);

        Session::flash('flash_success', 'Imagem removido!');

        return redirect('imagens');
    }
}
