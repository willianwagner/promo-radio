@extends('layouts.admin')

@section('content')
    <div class="_container">
        <div class="row">
			<div class="panel">
				<div class="panel-body">
					<h3> <i class="fa fa-check"></i> Sorteios</h3>
				</div>
				</div>


            <div>
      <div class="panel panel-body">
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
          .sp21{
            width:15%;
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
          }
          </style>

          <div class="box-body">
            <ul class="todo-list">
              <li class="th">
                <span style="width:20%"class="text">NOME</span>
                <span style="width:15%"class="text">NÚMERO DE SORTEADOS</span>
                <span style="width:15%"class="text">NÚMERO DE PARTICIPANTES</span>
                <span style="width:20%"class="text">DATA DO SORTEIO</span>
                <span style="width:10%"class="text">EXCLUIR</span>
              </li>
              @foreach($sorteios as $item)
                @php
                  $d = explode(' ', $item->created_at);
                  $da = $d[0];
                  $data = implode(preg_match("~\/~", $da) == 0 ? "/" : "-", array_reverse(explode(preg_match("~\/~", $da) == 0 ? "-" : "/", $da)));

                @endphp
                <li class="mob">
                  <span data-title="NOME:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp2 text"><a href="{{ url('/sorteios/' . $item->id) }}">{{$item->nome}}</a></span>
                  <span data-title="SORTEADOS:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp2 text">{{$item->num_sorteados}}</span>
                  <span data-title="PARTICIPANTES:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp21 text">{{$item->num_participantes}}</span>
                  <span data-title="DATA DO SORTEIO:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp21 text">{{$data}}</span>
                  <span data-title="EXCLUIR SORTEIO:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp1 text">
                  {!! Form::open([
                      'method'=>'DELETE',
                      'url' => ['/sorteios', $item->id],
                      'style' => 'display:inline;'
                      ]) !!}
                      {!! Form::button('<i class="fa fa-trash-o"></i>', array(
                      'type' => 'submit',
                      'style' => 'border:none;background:none;',
                      'title' => 'Remover sorteio',
                      'onclick'=>'return confirm("Tem certeza que deseja remover o sorteio?")'
                      )) !!}
                      {!! Form::close() !!}
                  
                  </span>
                </li>
              @endforeach
            </ul>
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix no-border">
            <a href="{{ url('/sorteios/create') }}" class="btn btn-success btn-sm" title="Novo sorteio">
              <i class="fa fa-plus" aria-hidden="true"></i> Novo sorteio
            </a>

            <div class="pagination-wrapper pull-right"> {!! $sorteios->appends(['search' => Request::get('search')])->render() !!} </div>
          </div>
        </div>
            </div>
        </div>
    </div>
@endsection
