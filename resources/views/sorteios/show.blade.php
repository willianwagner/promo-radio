@extends('layouts.admin')

@section('content')
    <div class="_container">
        <div class="row">
			<div class="panel">
				<div class="panel-body">
					<h3> <i class="fa fa-check"></i> Resultado do sorteio {{ $sorteio->nome }}</h3>
				</div>
				</div>


            <div>
      <div class="panel panel-body">
      <a href="{{ url('/sorteios') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
        <div >
          <div class="box-header">
          </div>
          <!-- /.box-header -->
          <style>
          .sp3{
            width:30%;
          }
          .sp2{
            width:20%;
          }
          .sp1{
            width:10%;
          }
          @media only screen and (max-width: 600px){
            .th{display: none;}
            .sp3{
              width:100%;
            }
            .sp2{
              width:100%;
            }
            .sp1{
              width:100%;
            }
            .sp4{
              width:100%;
              display:block !important;
              float:none !important;
              margin-left: 5px;
            }
            .mob .sp3:before {
              content: attr(data-title);
              padding-right: 10px;
            }
            .mob .sp2:before {
              content: attr(data-title);
              padding-right: 10px;
            }
            .mob .sp1:before {
              content: attr(data-title);
              padding-right: 10px;
            }
          }
          </style>

          <div class="box-body">
            Participantes: <b>{{ $sorteio->num_participantes}}</b>
            <h2>Ganhadores:</h2>

            <ul class="todo-list">
              <li class="th">
                <span style="width:20%"class="text">NOME</span>
                <span style="width:10%"class="text">CPF</span>
                <span style="width:10%"class="text">IDADE</span>
                <span style="width:10%"class="text">CIDADE</span>
                <span style="width:10%"class="text">TELEFONE</span>
                <span style="width:20%"class="text">E-MAIL</span>
              </li>
              @foreach($dados_ganhadores as $item)
              @php
                  // Declara a data! :P
                  $item['data_nascimento'] = implode(preg_match("~\/~", $item['data_nascimento']) == 0 ? "/" : "-", array_reverse(explode(preg_match("~\/~", $item['data_nascimento']) == 0 ? "-" : "/", $item['data_nascimento'])));

                  $data = $item['data_nascimento'];

                  // Separa em dia, mês e ano
                  list($dia, $mes, $ano) = explode('/', $data);

                  // Descobre que dia é hoje e retorna a unix timestamp
                  $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                  // Descobre a unix timestamp da data de nascimento do fulano
                  $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);

                  // Depois apenas fazemos o cálculo já citado :)
                  $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
              @endphp

                <li class="mob">
                  <span data-title="NOME:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp2 text">{{$item->nome}}</span>
                  <span data-title="CPF:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp1 text">{{$item->cpf}}</span>
                  <span data-title="IDADE:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp1 text">{{$idade}}</span>
                  <span data-title="CIDADE:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp1 text">{{$item->cidade}}</span>
                  <span data-title="TELEFONE:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp1 text">{{$item->telefone}}</span>
                  <span data-title="E-MAIL:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp2 text">{{$item->email}}</span>
                </li>
              @endforeach
            </ul>
          </div>
          <!-- /.box-body -->
        </div>
            </div>
        </div>
    </div>
@endsection
