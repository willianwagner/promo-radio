<?php

namespace App\Http\Controllers;

use App\Aceite;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Cidade;
use App\Estado;
use App\Ouvinte;
use App\Banner;
use App\Imagem;
use App\Promoco;
use App\OuvintePromocao;
use App\Top;
use App\Equipe;
use App\Blog;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Mail\Contato;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    //$this->middleware('auth');
  }

  public function cidadesEstado(Request $request)
  {
    $dados = $request;

    $cidades = Cidade::where('cod_estado', '=', $dados['id'])->get();

    return response()->json($cidades);
  }

  public function index()
  {
    $banners = Banner::first();
    $promocoes = Promoco::where('status', '=', 'ativo')->where('categoria', '=', 'camarim')->get();

    if (isset($banners->imagem)) {
      $banner = $banners->imagem;
    } else {
      $banner = '';
    }

    return view('home', compact('banner', 'promocoes'));
  }

  public function deliveryEntreAmigos()
  {
    $banners = Banner::first();
    $promocoes = Promoco::where('status', '=', 'ativo')->where('categoria', '=', 'delivery-entre-amigos')->get();
    $estados = Estado::pluck('nom_estado', 'cod_estado');

    if (isset($banners->imagem)) {
      $banner = $banners->imagem;
    } else {
      $banner = '';
    }

    return view('delivery-entre-amigos', compact('banner', 'promocoes', 'estados'));
  }

  public function natalCheioDeCoisasBoas()
  {
    $banners = Banner::first();
    $promocoes = Promoco::where('status', '=', 'ativo')->where('categoria', '=', 'natal-cheio-de-coisas-boas')->get();
    $estados = Estado::pluck('nom_estado', 'cod_estado');

    if (isset($banners->imagem)) {
      $banner = $banners->imagem;
    } else {
      $banner = '';
    }

    return view('natal-cheio-de-coisas-boas', compact('banner', 'promocoes', 'estados'));
  }

  public function diaDosNamorados()
  {
    $banners = Banner::first();
    $promocoes = Promoco::where('status', '=', 'ativo')->where('categoria', '=', 'dia-dos-namorados')->get();
    $estados = Estado::pluck('nom_estado', 'cod_estado');

    if (isset($banners->imagem)) {
      $banner = $banners->imagem;
    } else {
      $banner = '';
    }

    return view('dia-dos-namorados', compact('banner', 'promocoes', 'estados'));
  }

  public function bolsaDeMae()
  {
    $banners = Banner::first();
    $promocoes = Promoco::where('status', '=', 'ativo')->where('categoria', '=', 'bolsa-de-mae')->get();
    $estados = Estado::pluck('nom_estado', 'cod_estado');

    if (isset($banners->imagem)) {
      $banner = $banners->imagem;
    } else {
      $banner = '';
    }

    return view('bolsa-de-mae', compact('banner', 'promocoes', 'estados'));
  }


 


  public function existente(Request $request)
  {
   

    $tipo = $request->get('tipo');

    $this->validate($request, [
      'cpf' => 'cpf',
    ]);

    
  
    //verificar se cliente ja esta cadastrado
    $requestData = $request->all();

    if (isset($requestData['promocao'])) {
      $promocoes = $requestData['promocao'];
      unset($requestData['promocao']);
    }

    $ouvinte = Ouvinte::where('cpf', $requestData['cpf'])->first();
  
    $erro = 0;
    if (isset($ouvinte->cpf)) {
      //verificar se cliente ja esta participando da promocao
      if (isset($promocoes)) {
        foreach ($promocoes as $promo) {
          $cadastrado = 0;
     
          if ($tipo == 'amigo-secreto') {
            $promocoes = Promoco::where('status', '=', 'ativo')->where('categoria', '=', 'amigo-secreto')->get();

            //amigo secreto é exclusivo, se estiver cadastrado em 2 nao pode em outra
            foreach ($promocoes as $pp) {
              $ouvinte_old = OuvintePromocao::where('ouvinte', $ouvinte->id)->where('promocao', $pp->id)->first();
              if (isset($ouvinte_old->ouvinte)) {
                $cadastrado++;
              }
            }
          } else {
            $ouvinte_old = OuvintePromocao::where('ouvinte', $ouvinte->id)->where('promocao', $promo)->first();
          }
          if (!isset($ouvinte_old->ouvinte) && $cadastrado < 2) {
            $dados = array('ouvinte' => $ouvinte->id, 'promocao' => $promo);
            $dadosAceite = array(
              'ip' => $requestData['ip'], 
              'nome_promocao' => $tipo, 
              'ouvinte_id' => $ouvinte->id,
            );

            $aceite = Aceite::create($dadosAceite);
            $inserido = OuvintePromocao::create($dados);
          } else {
            if ($cadastrado >= 2) {
              Session::flash('flash_danger', 'Você só pode se cadastrar para dois presentes dessa promoção!');
              $erro = 1;
            } else {
              if ($erro == 0) {
                Session::flash('flash_success', 'Cadastro efetuado!');
                $erro = 1;
              }
            }
          }
        }
      }

      //exibir mensagem de sucesso
      if ($erro == 0) {
        if ($tipo == 'amigo-secreto') {
          Session::flash('flash_success', 'Cadastro efetuado, selecione até 2 presentes!');
        } else {
          Session::flash('flash_success', 'Cadastro efetuado!');
        }
      }
      switch ($tipo) {
        case 'camarim-anitta':
          return redirect('/camarim-anitta');
          break;
        case 'sorteio-farroupilha':
          return redirect('/sorteio-farroupilha');
          break;
        case 'pai-ninja':
          return redirect('/pai-ninja');
          break;
        case 'rodada-da-amizade':
          return redirect('/rodada-da-amizade');
          break;
        case 'arraial-da-amizade':
          return redirect('/arraial-da-amizade');
          break;
        case 'o-amor-esta-na-moda':
          return redirect('/o-amor-esta-na-moda');
          break;
        case 'humberto-e-ronaldo':
          return redirect('/humberto-e-ronaldo');
          break;
        case 'wesley-safadao':
          return redirect('/wesley-safadao');
          break;
        case 'dia-das-maes':
          return redirect('/dia-das-maes');
          break;
        case 'gaudencio':
          return redirect('/gaudencio');
          break;
        case 'leitte':
          return redirect('/claudia-leitte');
          break;
        case 'dia-da-mulher':
          return redirect('/dia-da-mulher');
          break;
        case 'natal-de-amor-e-amizade':
          return redirect('/natal-de-amor-e-amizade');
          break;
        case 'lima':
          return redirect('/gusttavo-lima');
          break;
        case 'mioto':
          return redirect('/gustavo-mioto');
          break;
        case 'camarim':
          return redirect('/camarim');
          break;
        case 'camarote':
          return redirect('/camarote');
          break;
        case 'camiseta':
          return redirect('/camiseta');
          break;
        case 'pascoa':
          return redirect('/pascoa');
          break;
        case 'coracoes':
          return redirect('/coracoes');
          break;
        case 'churras':
          return redirect('/churras');
          break;
        case 'paizao':
          return redirect('/paizao');
          break;
        case 'dia-das-criancas':
          return redirect('/dia-das-criancas');
          break;
        case 'amigo-secreto':
          return redirect()->route('amigo-secreto')->with(['cpf' => $requestData['cpf']]);
          break;
        default:
          return redirect('/' . $tipo);
          break;
      }
    } else {
      Session::flash('flash_info', 'CPF não cadastrado! Preencha seus dados no formulário abaixo para cadastrar');
      if (isset($promocoes)) {
        switch ($tipo) {
          case 'camarim-anitta':
            return redirect()->route('camarim-anitta')->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
          case 'sorteio-farroupilha':
            return redirect()->route('sorteio-farroupilha')->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
          case 'pai-ninja':
            return redirect()->route('pai-ninja')->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
          case 'rodada-da-amizade':
            return redirect()->route('rodada-da-amizade')->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
          case 'arraial-da-amizade':
            return redirect()->route('arraial-da-amizade')->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
          case 'o-amor-esta-na-moda':
            return redirect()->route('o-amor-esta-na-moda')->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
          case 'humberto-e-ronaldo':
            return redirect()->route('humberto-e-ronaldo')->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
          case 'wesley-safadao':
            return redirect()->route('wesley-safadao')->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
          case 'dia-das-maes':
            return redirect()->route('dia-das-maes')->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
          case 'gaudencio':
            return redirect()->route('gaudencio')->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
          case 'leitte':
            return redirect()->route('claudia-leitte')->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
          case 'dia-da-mulher':
            return redirect()->route('dia-da-mulher')->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
          case 'natal-de-amor-e-amizade':
            return redirect()->route('natal-de-amor-e-amizade')->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
          case 'lima':
            return redirect()->route('gusttavo-lima')->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
          case 'mioto':
            return redirect()->route('gustavo-mioto')->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
          case 'camarim':
            return redirect()->route('camarim')->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
          case 'camarote':
            return redirect()->route('camarote')->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
          case 'camiseta':
            return redirect()->route('camiseta')->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
          case 'pascoa':
            return redirect()->route('pascoa')->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
          case 'coracoes':
            return redirect()->route('coracoes')->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
          case 'churras':
            return redirect()->route('churras')->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
          case 'paizao':
            return redirect()->route('paizao')->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
          case 'dia-das-criancas':
            return redirect()->route('dia-das-criancas')->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
          case 'amigo-secreto':
            return redirect()->route('amigo-secreto')->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
          default:
            return redirect()->route($tipo)->with(['cpf' => $requestData['cpf'], 'promocoes' => $promocoes]);
            break;
        }
      } else {
        switch ($tipo) {
          case 'camarim-anitta':
            return redirect()->route('camarim-anitta')->with(['cpf' => $requestData['cpf']]);
            break;
          case 'sorteio-farroupilha':
            return redirect()->route('sorteio-farroupilha')->with(['cpf' => $requestData['cpf']]);
            break;
          case 'pai-ninja':
            return redirect()->route('pai-ninja')->with(['cpf' => $requestData['cpf']]);
            break;
          case 'rodada-da-amizade':
            return redirect()->route('rodada-da-amizade')->with(['cpf' => $requestData['cpf']]);
            break;
          case 'arraial-da-amizade':
            return redirect()->route('arraial-da-amizade')->with(['cpf' => $requestData['cpf']]);
            break;
          case 'o-amor-esta-na-moda':
            return redirect()->route('o-amor-esta-na-moda')->with(['cpf' => $requestData['cpf']]);
            break;
          case 'humberto-e-ronaldo':
            return redirect()->route('humberto-e-ronaldo')->with(['cpf' => $requestData['cpf']]);
            break;
          case 'wesley-safadao':
            return redirect()->route('wesley-safadao')->with(['cpf' => $requestData['cpf']]);
            break;
          case 'dia-das-maes':
            return redirect()->route('dia-das-maes')->with(['cpf' => $requestData['cpf']]);
            break;
          case 'gaudencio':
            return redirect()->route('gaudencio')->with(['cpf' => $requestData['cpf']]);
            break;
          case 'dia-da-mulher':
            return redirect()->route('dia-da-mulher')->with(['cpf' => $requestData['cpf']]);
            break;
          case 'natal-de-amor-e-amizade':
            return redirect()->route('natal-de-amor-e-amizade')->with(['cpf' => $requestData['cpf']]);
            break;
          case 'leitte':
            return redirect()->route('claudia-leitte')->with(['cpf' => $requestData['cpf']]);
            break;
          case 'lima':
            return redirect()->route('gusttavo-lima')->with(['cpf' => $requestData['cpf']]);
            break;
          case 'mioto':
            return redirect()->route('gustavo-mioto')->with(['cpf' => $requestData['cpf']]);
            break;
          case 'camarim':
            return redirect()->route('camarim')->with(['cpf' => $requestData['cpf']]);
            break;
          case 'camiseta':
            return redirect()->route('camiseta')->with(['cpf' => $requestData['cpf']]);
            break;
          case 'pascoa':
            return redirect()->route('pascoa')->with(['cpf' => $requestData['cpf']]);
            break;
          case 'coracoes':
            return redirect()->route('coracoes')->with(['cpf' => $requestData['cpf']]);
            break;
          case 'camarote':
            return redirect()->route('camarote')->with(['cpf' => $requestData['cpf']]);
            break;
          case 'churras':
            return redirect()->route('churras')->with(['cpf' => $requestData['cpf']]);
            break;
          case 'paizao':
            return redirect()->route('paizao')->with(['cpf' => $requestData['cpf']]);
            break;
          case 'dia-das-criancas':
            return redirect()->route('dia-das-criancas')->with(['cpf' => $requestData['cpf']]);
            break;
          case 'amigo-secreto':
            return redirect()->route('amigo-secreto')->with(['cpf' => $requestData['cpf']]);
            break;
          default:
            return redirect()->route($tipo)->with(['cpf' => $requestData['cpf']]);
            break;
        }
      }
    }
  }

  public function cadastrar(Request $request)
  {
    $tipo = $request->get('tipo');

    Session::flash('pagina', 'cadastrar');

    $this->validate($request, [
      'nome' => 'required',
      'cidade' => 'required',
      'data_nascimento' => 'required',
      'email' => 'required',
      'telefone' => 'required',
      'cpf' => 'cpf',
      'genero' => 'required',
    ]);

    //cadastrar ouvinte
    $requestData = $request->all();

    $requestData['data_nascimento'] = implode(preg_match("~\/~", $requestData['data_nascimento']) == 0 ? "/" : "-", array_reverse(explode(preg_match("~\/~", $requestData['data_nascimento']) == 0 ? "-" : "/", $requestData['data_nascimento'])));

    if (isset($requestData['promocao'])) {
      $promocoes = $requestData['promocao'];
      unset($requestData['promocao']);
    } else {
      Session::flash('flash_danger', 'Você deve selecionar pelo menos uma promoção para participar!');
      return Redirect::back()->withInput(Input::all());
    }

    $ouvinte = Ouvinte::where('cpf', $requestData['cpf'])->first();

    if (isset($ouvinte->cpf)) {
      //mensagem de erro - cpf ja cadastrado
      Session::flash('flash_danger', 'CPF já cadastrado!');
      switch ($tipo) {
        case 'camarim-anitta':
          return redirect('/camarim-anitta');
          break;
        case 'sorteio-farroupilha':
          return redirect('/sorteio-farroupilha');
          break;
        case 'pai-ninja':
          return redirect('/pai-ninja');
          break;
        case 'rodada-da-amizade':
          return redirect('/rodada-da-amizade');
          break;
        case 'arraial-da-amizade':
          return redirect('/arraial-da-amizade');
          break;
        case 'o-amor-esta-na-moda':
          return redirect('/o-amor-esta-na-moda');
          break;
        case 'humberto-e-ronaldo':
          return redirect('/humberto-e-ronaldo');
          break;
        case 'wesley-safadao':
          return redirect('/wesley-safadao');
          break;
        case 'dia-das-maes':
          return redirect('/dia-das-maes');
          break;
        case 'gaudencio':
          return redirect('/gaudencio');
          break;
        case 'leitte':
          return redirect('/claudia-leitte');
          break;
        case 'dia-da-mulher':
          return redirect('/dia-da-mulher');
          break;
        case 'natal-de-amor-e-amizade':
          return redirect('/natal-de-amor-e-amizade');
          break;
        case 'lima':
          return redirect('/gusttavo-lima');
          break;
        case 'mioto':
          return redirect('/gustavo-mioto');
          break;
        case 'camarim':
          return redirect('/camarim');
          break;
        case 'camiseta':
          return redirect('/camiseta');
          break;
        case 'pascoa':
          return redirect('/pascoa');
          break;
        case 'camarote':
          return redirect('/camarote');
          break;
        case 'coracoes':
          return redirect('/coracoes');
          break;
        case 'churras':
          return redirect('/churras');
          break;
        case 'paizao':
          return redirect('/paizao');
          break;
        case 'dia-das-criancas':
          return redirect('/dia-das-criancas');
          break;
        case 'amigo-secreto':
          return redirect('/amigo-secreto');
          break;
        default:
          return redirect('/' . $tipo);
          break;
      }
    } else {
      try {
        unset($requestData['estado']);

        Ouvinte::create($requestData);

        $ouvinte = Ouvinte::where('cpf', $requestData['cpf'])->first();

        //cadastrar cliente nas promocoes selecionadas
        if (isset($promocoes)) {
          foreach ($promocoes as $promo) {
            $ouvinte_old = OuvintePromocao::where('ouvinte', $ouvinte->id)->where('promocao', $promo)->first();
            if (!isset($ouvinte_old->ouvinte)) {
              $dados = array('ouvinte' => $ouvinte->id, 'promocao' => $promo);
              $dadosAceite = array(
                'ip' => $requestData['ip'], 
                'nome_promocao' => $tipo, 
                'ouvinte_id' => $ouvinte->id,
              );
  
              $aceite = Aceite::create($dadosAceite);
              $inserido = OuvintePromocao::create($dados);
            }
          }
        }

        Session::flash('flash_success', 'Cadastro efetuado!');
        switch ($tipo) {
          case 'camarim-anitta':
            return redirect('/camarim-anitta');
            break;
          case 'sorteio-farroupilha':
            return redirect('/sorteio-farroupilha');
            break;
          case 'pai-ninja':
            return redirect('/pai-ninja');
            break;
          case 'rodada-da-amizade':
            return redirect('/rodada-da-amizade');
            break;
          case 'arraial-da-amizade':
            return redirect('/arraial-da-amizade');
            break;
          case 'o-amor-esta-na-moda':
            return redirect('/o-amor-esta-na-moda');
            break;
          case 'humberto-e-ronaldo':
            return redirect('/humberto-e-ronaldo');
            break;
          case 'wesley-safadao':
            return redirect('/wesley-safadao');
            break;
          case 'dia-das-maes':
            return redirect('/dia-das-maes');
            break;
          case 'gaudencio':
            return redirect('/gaudencio');
            break;
          case 'dia-da-mulher':
            return redirect('/dia-da-mulher');
            break;
          case 'natal-de-amor-e-amizade':
            return redirect('/natal-de-amor-e-amizade');
            break;
          case 'leitte':
            return redirect('/claudia-leitte');
            break;
          case 'lima':
            return redirect('/gusttavo-lima');
            break;
          case 'mioto':
            return redirect('/gustavo-mioto');
            break;
          case 'camarim':
            return redirect('/camarim');
            break;
          case 'camarote':
            return redirect('/camarote');
            break;
          case 'camiseta':
            return redirect('/camiseta');
            break;
          case 'pascoa':
            return redirect('/pascoa');
            break;
          case 'coracoes':
            return redirect('/coracoes');
            break;
          case 'churras':
            return redirect('/churras');
            break;
          case 'paizao':
            return redirect('/paizao');
            break;
          case 'dia-das-criancas':
            return redirect('/dia-das-criancas');
            break;
          case 'amigo-secreto':
            return redirect('/amigo-secreto');
            break;
          default:
            return redirect('/' . $tipo);
            break;
        }
      } catch (\Exception $e) {
        //exibir mensagem de erro
        //            Session::flash('flash_danger', 'Um erro ocorreu, tente novamente!');
        Session::flash('flash_danger', $e->getMessage());
        switch ($tipo) {
          case 'camarim-anitta':
            return redirect('/camarim-anitta');
            break;
          case 'sorteio-farroupilha':
            return redirect('/sorteio-farroupilha');
            break;
          case 'pai-ninja':
            return redirect('/pai-ninja');
            break;
          case 'rodada-da-amizade':
            return redirect('/rodada-da-amizade');
            break;
          case 'arraial-da-amizade':
            return redirect('/arraial-da-amizade');
            break;
          case 'o-amor-esta-na-moda':
            return redirect('/o-amor-esta-na-moda');
            break;
          case 'humberto-e-ronaldo':
            return redirect('/humberto-e-ronaldo');
            break;
          case 'wesley-safadao':
            return redirect('/wesley-safadao');
            break;
          case 'dia-das-maes':
            return redirect('/dia-das-maes');
            break;
          case 'gaudencio':
            return redirect('/gaudencio');
            break;
          case 'dia-da-mulher':
            return redirect('/dia-da-mulher');
            break;
          case 'natal-de-amor-e-amizade':
            return redirect('/natal-de-amor-e-amizade');
            break;
          case 'leitte':
            return redirect('/claudia-leitte');
            break;
          case 'lima':
            return redirect('/gusttavo-lima');
            break;
          case 'mioto':
            return redirect('/gustavo-mioto');
            break;
          case 'camarim':
            return redirect('/camarim');
            break;
          case 'camiseta':
            return redirect('/camiseta');
            break;
          case 'pascoa':
            return redirect('/pascoa');
            break;
          case 'coracoes':
            return redirect('/coracoes');
            break;
          case 'camarote':
            return redirect('/camarote');
            break;
          case 'churras':
            return redirect('/churras');
            break;
          case 'paizao':
            return redirect('/paizao');
            break;
          case 'dia-das-criancas':
            return redirect('/dia-das-criancas');
            break;
          case 'amigo-secreto':
            return redirect('/amigo-secreto');
            break;
          default:
            return redirect('/' . $tipo);
            break;
        }
      }
    }
  }
  public function site()
  {
    $banners = Banner::get();
    $imagens = Imagem::get();
    $posts = Blog::latest()->take(3)->get();

    $top10 = '';
    $programacao = '';

    foreach ($imagens as $i) {
      switch ($i->link) {
        case 'top-10';
          $top10 = $i->imagem;
          break;
        case 'programacao-radio';
          $programacao = $i->imagem;
          break;
      }
    }

    $promo = Promoco::latest('created_at')->first();

    return view('site', compact('banners', 'promo', 'top10', 'programacao', 'posts'));
  }

  public function contato(Request $request)
  {
    $dados = $request;

    //e-mail de teste - alterar em produção
    $email = 'adtr@outlook.com';

    Mail::to($email)->send(new Contato($dados));

    return response()->json([1]);
  }

  public function blog($categoria = null)
  {
    $perPage = 10;

    if (!empty($categoria)) {
      $posts = Blog::where('categoria', '=', "$categoria")
        ->paginate($perPage);
    } else {
      $posts = Blog::paginate($perPage);
    }

    return view('blog', compact('posts'));
  }

  public function pesquisaBlog(Request $request)
  {
    $perPage = 10;
    $busca = $request->get('q');

    if (!empty($busca)) {
      $posts = Blog::where('titulo', 'LIKE', "%$busca%")
        ->orWhere('categoria', 'LIKE', "%$busca%")
        ->orWhere('texto', 'LIKE', "%$busca%")
        ->paginate($perPage);
    } else {
      $posts = Blog::paginate($perPage);
    }

    return view('blog', compact('posts'));
  }

  public function internaBlog($id)
  {
    $post = Blog::findOrFail($id);

    $post->pageview++;
    $post->save();

    return view('interna-blog', compact('post'));
  }

  public function topPosts()
  {
    //ajax
    $posts = Blog::orderBy('pageview', 'desc')
      ->take(5)
      ->get(['titulo', 'pageview', 'id']);

    return ['top_posts' => $posts];
  }
}
