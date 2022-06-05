<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Blog;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\ImageManagerStatic as Image;

class BlogController extends Controller
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
            $blog = Blog::where('titulo', 'LIKE', "%$keyword%")
				->orWhere('categoria', 'LIKE', "%$keyword%")
				->orWhere('texto', 'LIKE', "%$keyword%")
				->orWhere('imagem', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $blog = Blog::paginate($perPage);
        }

        return view('blog.index', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('blog.create');
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
            'imagem_interna' => 'max:1024',
        ]);
        
        $requestData = $request->all();
        

        if ($request->hasFile('imagem')) {
            $file = $request['imagem'];
  
            $uploadPath = public_path('/uploads/blog');
  
            $extension = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '-' . str_slug($file->getClientOriginalName(), '-');
  
            $fileName = str_replace($extension,'.'.$extension,$fileName);
  
            $file->move($uploadPath, $fileName);
  
            $requestData['imagem'] = $fileName;
        }

        if ($request->hasFile('imagem_interna')) {
            $file = $request['imagem_interna'];
  
            $uploadPath = public_path('/uploads/blog');
  
            $extension = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '-' . str_slug($file->getClientOriginalName(), '-');
  
            $fileName = str_replace($extension,'.'.$extension,$fileName);
  
            $file->move($uploadPath, $fileName);

            // open an image file
            $img = Image::make($uploadPath.'/'.$fileName)->resize(370, 512);

            // finally we save the image as a new file
            $img->save($uploadPath.'/r/'.$fileName);
            
            $requestData['imagem_interna'] = $fileName;
        }
        
        Blog::create($requestData);

        Session::flash('flash_success', 'Registro inserido!');

        return redirect('/admin/blog');
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
        $blog = Blog::findOrFail($id);

        return view('blog.show', compact('blog'));
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
        $blog = Blog::findOrFail($id);

        return view('blog.edit', compact('blog'));
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
            'imagem_interna' => 'max:1024',
        ]);
  
          $requestData = $request->all();
  
        if ($request->hasFile('imagem')) {
            $file = $request['imagem'];
  
            $uploadPath = public_path('/uploads/blog');
  
            $extension = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '-' . str_slug($file->getClientOriginalName(), '-');
  
            $fileName = str_replace($extension,'.'.$extension,$fileName);
  
            $file->move($uploadPath, $fileName);
  
            $requestData['imagem'] = $fileName;
        }
  
        if ($request->hasFile('imagem_interna')) {
            $file = $request['imagem_interna'];
  
            $uploadPath = public_path('/uploads/blog');
  
            $extension = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '-' . str_slug($file->getClientOriginalName(), '-');
  
            $fileName = str_replace($extension,'.'.$extension,$fileName);
  
            $file->move($uploadPath, $fileName);

            // open an image file
            $img = Image::make($uploadPath.'/'.$fileName)->resize(370, 512);

            // finally we save the image as a new file
            $img->save($uploadPath.'/r/'.$fileName);
  
            $requestData['imagem_interna'] = $fileName;
        }

        $blog = Blog::findOrFail($id);
        $blog->update($requestData);

        Session::flash('flash_success', 'Registro atualizado!');

        return redirect('/admin/blog');
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
        Blog::destroy($id);

        Session::flash('flash_success', 'Registro removido!');

        return redirect('/admin/blog');
    }
}
