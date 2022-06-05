<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ouvinte;

class OuvintesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $ouvintes = Ouvinte::where('nome', 'LIKE', "%$keyword%")
				->orWhere('cpf', 'LIKE', "%$keyword%")
				->orWhere('cidade', 'LIKE', "%$keyword%")
				->orWhere('data_nascimento', 'LIKE', "%$keyword%")
				->orWhere('email', 'LIKE', "%$keyword%")
				->orWhere('telefone', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $ouvintes = Ouvinte::paginate($perPage);
        }

        $count_ouvintes = Ouvinte::count();

        return view('ouvintes.index', compact('ouvintes','count_ouvintes'));
    }

    public function relatorio(Request $request)
    {
        $ouvintes = Ouvinte::where('email', 'LIKE', "%@%")->pluck('email')->toArray();

        foreach($ouvintes as $o){
            echo $o . '<br/>';
        }
    }
}
