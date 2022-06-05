<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Banner;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\ImageManagerStatic as Image;

class BannersController extends Controller
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
            $banners = Banner::where('imagem', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $banners = Banner::paginate($perPage);
        }

        return view('banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('banners.create');
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

          $uploadPath = public_path('/uploads/banners');

          $extension = $file->getClientOriginalExtension();
          $fileName = rand(11111, 99999) . '-' . str_slug($file->getClientOriginalName(), '-');

          $fileName = str_replace($extension,'.'.$extension,$fileName);

          $file->move($uploadPath, $fileName);

            // open an image file
            $img = Image::make($uploadPath.'/'.$fileName)->resize(1440, 838);

            // finally we save the image as a new file
            $img->save($uploadPath.'/r/'.$fileName);

          $requestData['imagem'] = $fileName;

          Banner::create($requestData);

          Session::flash('flash_success', 'Banner cadastrado!');
          return redirect('banners');
        }else{
          Session::flash('flash_danger', 'Nenhuma imagem enviada!');
          return redirect('banners/create');
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
        $banner = Banner::findOrFail($id);

        return view('banners.show', compact('banner'));
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
        $banner = Banner::findOrFail($id);

        return view('banners.edit', compact('banner'));
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

          $uploadPath = public_path('/uploads/banners');

          $extension = $file->getClientOriginalExtension();
          $fileName = rand(11111, 99999) . '-' . str_slug($file->getClientOriginalName(), '-');

          $fileName = str_replace($extension,'.'.$extension,$fileName);

          $file->move($uploadPath, $fileName);

            // open an image file
            $img = Image::make($uploadPath.'/'.$fileName)->resize(1440, 838);

            // finally we save the image as a new file
            $img->save($uploadPath.'/r/'.$fileName);


          $requestData['imagem'] = $fileName;
        }

        $banner = Banner::findOrFail($id);
        $banner->update($requestData);

        Session::flash('flash_success', 'Banner alterado!');

        return redirect('banners');
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
        Banner::destroy($id);

        Session::flash('flash_success', 'Banner removido!');

        return redirect('banners');
    }
}
