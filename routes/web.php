<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('aceite', 'AceiteController');
Route::get('/', 'HomeController@diaDosNamorados');

Route::post('/existente', 'HomeController@existente');
Route::post('/cadastrar', 'HomeController@cadastrar');

Route::get('/home', 'HomeController@oNatalAproxima')->name('home');
//Route::get('/home', 'HomeController@site')->name('home');
Route::post('/contato', 'HomeController@contato');

Route::get('ao-vivo', function () {
    return view('ao-vivo');
});

Auth::routes();

Route::get('/dia-dos-namorados', 'HomeController@diaDosNamorados')->name('dia-dos-namorados');
Route::get('/bolsa-de-mae', 'HomeController@bolsaDeMae')->name('bolsa-de-mae');
Route::get('/natal-cheio-de-coisas-boas', 'HomeController@natalCheioDeCoisasBoas')->name('natal-cheio-de-coisas-boas');


//rotas protegidas por login
Route::group(['middleware' => 'auth'], function () {
    Route::get('/relatorio-ouvintes', 'OuvintesController@relatorio')->name('relatorio');
    Route::get('/ouvintes', 'OuvintesController@index')->name('ouvintes');
    Route::resource('banners', 'BannersController');
    Route::resource('imagens', 'ImagensController');
    Route::resource('promocoes', 'PromocoesController');
    Route::resource('sorteios', 'SorteiosController');
    Route::resource('sorteio-ganhadores', 'SorteioGanhadoresController');
    Route::resource('top', 'TopController');

    Route::get('/top10', 'TopController@index');
    Route::get('/top10/{mes}/{ano}', 'TopController@index');
    Route::get('/base-top10/{mes}/{ano}', 'TopController@gerar');

    Route::resource('/admin/equipe', 'EquipeController');

    Route::post('crop-image', 'EquipeController@uploadImage');

    Route::get('/relatorio', 'PromocoesController@relatorio');
    Route::get('/relatorio/{genero}/{promocao}/{cidade}/{idade_min}/{idade_max}', 'PromocoesController@resultadoRelatorio');

    Route::get('relatorio-pdf/{genero}/{promocao}/{cidade}/{idade_min}/{idade_max}', 'PromocoesController@pdf')->name('relatorio_pdf');
    Route::resource('/admin/blog', 'BlogController');
});

Route::get('/register', 'HomeController@index');
//Route::get('/login', 'HomeController@index');

Route::get('/blog', 'HomeController@blog');
Route::get('/blog/{id}', 'HomeController@internaBlog');
Route::get('/categoria-blog/{categoria}', 'HomeController@blog');
Route::get('/pesquisa-blog', 'HomeController@pesquisaBlog');
Route::get('/top-posts', 'HomeController@topPosts');

Route::get('programacao', function () {
    return view('programacao');
});
//rotas provisórias para site
Route::get('interna-blog', function () {
    return view('interna-blog');
});
