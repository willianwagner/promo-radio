@extends('layouts.admin')

@section('content')
    <div class="_container">
        <div class="row">
			<div class="panel">
				<div class="panel-body">
					<h3> <i class="fa fa-gift"></i> Promoções</h3>
				</div>
				</div>


            <div>
      <div class="panel panel-body">
        <div class="text-right">
          <a href="{{ url('/promocoes/create') }}" class="btn btn-success btn-sm" title="Adicionar promoção">
            <i class="fa fa-plus" aria-hidden="true"></i> Adicionar promoção
          </a>

          <div class="pagination-wrapper pull-right"> {!! $promocoes->appends(['search' => Request::get('search')])->render() !!} </div>
        </div>
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
                <span style="width:20%"class="text">STATUS</span>
                <span style="width:20%"class="text">CATEGORIA</span>
                <span style="width:17%"class="text">DATA</span>
                <span style="width:20%"class="text">CADASTROS</span>
                <div class="tools">
                </div>
              </li>
              @foreach($promocoes as $item)
                <li class="mob">
                  <span data-title="NOME:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp2 text">{{$item->nome}}</span>
                  <span data-title="STATUS:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp2 text">{{$item->status}}</span>
                  <span data-title="CATEGORIA:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp2 text">{{$item->categoria}}</span>
                  <span data-title="CATEGORIA:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp2 text">{{  date( 'm-Y' , strtotime( $item->created_at ) )  }}</span>
                  <span data-title="CADASTROS:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp1 text">{{$contagem[$item->id] or 0}}</span>

                  <div class="tools sp4">
                    <a href="{{ url('/promocoes/' . $item->id . '/edit') }}"><i class="fa fa-edit"></i></a>

                    {!! Form::open([
                      'method'=>'DELETE',
                      'url' => ['/promocoes', $item->id],
                      'style' => 'display:inline;'
                      ]) !!}
                      {!! Form::button('<i class="fa fa-trash-o"></i>', array(
                      'type' => 'submit',
                      'style' => 'border:none;background:none;',
                      'title' => 'Remover promoção',
                      'onclick'=>'return confirm("Tem certeza que deseja remover a promoção?")'
                      )) !!}
                      {!! Form::close() !!}
                  </div>
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
