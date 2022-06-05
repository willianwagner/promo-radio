@extends('layouts.admin')

@section('content')
    <div class="_container">
        <div class="row">
			<div class="panel">
				<div class="panel-body">
					<h3> <i class="fa fa-image"></i> Equipe</h3>
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
            <ul class="todo-list">
              <li class="th">
                <span style="width:30%"class="text">IMAGEM</span>
                <span style="width:20%"class="text">NOME</span>
                <div class="tools">
                </div>
              </li>
              @foreach($equipe as $item)
                <li class="mob">
                  <span data-title="IMAGEM:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp3 text"><a href="/uploads/banners/{{ $item->imagem }}" target="_blank"><img style="width:100px;height:100px;" src="/uploads/equipe/{{ $item->imagem }}"/></a></span>
                  <span data-title="NOME:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp2 text">{{$item->nome}}</span>

                  <div class="tools sp4">
                    <a href="{{ url('/admin/equipe/' . $item->id . '/edit') }}"><i class="fa fa-edit"></i></a>
  
                    {!! Form::open([
                      'method'=>'DELETE',
                      'url' => ['/admin/equipe', $item->id],
                      'style' => 'display:inline;'
                      ]) !!}
                      {!! Form::button('<i class="fa fa-trash-o"></i>', array(
                      'type' => 'submit',
                      'style' => 'border:none;background:none;',
                      'title' => 'Remover',
                      'onclick'=>'return confirm("Tem certeza que deseja remover o registro?")'
                      )) !!}
                      {!! Form::close() !!}
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix no-border">
            <a href="{{ url('/admin/equipe/create') }}" class="btn btn-success btn-sm" title="Adicionar">
              <i class="fa fa-plus" aria-hidden="true"></i> Adicionar 
            </a>

            <div class="pagination-wrapper pull-right"> {!! $equipe->appends(['search' => Request::get('search')])->render() !!} </div>
          </div>
        </div>
            </div>
        </div>
    </div>
@endsection
