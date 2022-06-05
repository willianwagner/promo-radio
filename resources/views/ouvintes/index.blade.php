@extends('layouts.admin')

@section('content')
    <div class="_container">
        <div class="row">
			<div class="panel">
				<div class="panel-body">
					<h3> <i class="fa fa-cube"></i> Ouvintes</h3>
				</div>
				</div>


            <div>
      <div class="panel panel-body">
        <div >
          <div class="box-header">
            {!! Form::open(['method' => 'GET', 'url' => '/ouvintes', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
            <div class="input-group">
              <input type="text" class="form-control" name="search" placeholder="Pesquisar">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
            {!! Form::close() !!}
          </div>
          <!-- /.box-header -->
          <style>
          .sp3{
            width:30%;
          }
          @media only screen and (max-width: 600px){
            .th{display: none;}
            .sp3{
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
          }
          </style>

          <div class="box-body">
            <p>Total de ouvintes cadastrados: <b>{{$count_ouvintes}}</b></p>
            <ul class="todo-list">
              <li class="th">
                <span style="width:20%" class="text">NOME</span>
                <span style="width:10%" class="text">CPF</span>
                <span style="width:10%" class="text">CIDADE</span>
                <span style="width:12%" class="text">DATA DE NASC.</span>
                <span style="width:20%" class="text">E-MAIL</span>
                <span style="width:10%" class="text">TELEFONE</span>
                <span style="width:8%" class="text">GÊNERO</span>
                <div class="tools">
                </div>
              </li>
              @foreach($ouvintes as $item)
                @php
                  $item['data_nascimento'] = implode(preg_match("~\/~", $item['data_nascimento']) == 0 ? "/" : "-", array_reverse(explode(preg_match("~\/~", $item['data_nascimento']) == 0 ? "-" : "/", $item['data_nascimento'])));
                @endphp

                <li class="mob">
                  <span style="width:20%" data-title="NOME:&nbsp;" class="sp3 text">{{ $item->nome }}</span>
                  <span style="width:10%" data-title="CPF:&nbsp;" class="sp3 text">{{ $item->cpf }}</span>
                  <span style="width:10%" data-title="CIDADE:&nbsp;" class="sp3 text">{{ $item->cidade }}</span>
                  <span style="width:12%" data-title="DATA DE NASC.:&nbsp;" class="sp3 text">{{ $item->data_nascimento }}</span>
                  <span style="width:20%" data-title="E-MAIL:&nbsp;" class="sp3 text">{{ $item->email }}</span>
                  <span style="width:10%" data-title="TELEFONE:&nbsp;" class="sp3 text">{{ $item->telefone }}</span>
                  <span style="width:8%" data-title="GÊNERO:&nbsp;" class="sp3 text">{{ $item->genero }}</span>
                </li>
              @endforeach
            </ul>
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix no-border">
            <div class="pagination-wrapper pull-right"> {!! $ouvintes->appends(['search' => Request::get('search')])->render() !!} </div>
          </div>
        </div>
            </div>
        </div>
    </div>
@endsection
