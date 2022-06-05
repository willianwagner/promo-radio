@extends('layouts.admin')

@section('content')
    <div class="_container">
        <div class="row">
			<div class="panel">
				<div class="panel-body">
					<h3> <i class="fa fa-image"></i> Imagens</h3>
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
                <span style="width:30%"class="text">TÍTULO</span>
                <div class="tools">
                </div>
              </li>
              @foreach($imagens as $item)
                <li class="mob">
                  <span data-title="IMAGEM:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp3 text"><a href="/uploads/imagens/{{ $item->imagem }}" target="_blank"><img style="width:100px;height:100px;" src="/uploads/imagens/{{ $item->imagem }}"/></a></span>
                  <span data-title="TÍTULO:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp3 text">{{$item->link}}</span>

                  <div class="tools sp4">
                    <a href="{{ url('/imagens/' . $item->id . '/edit') }}"><i class="fa fa-edit"></i></a>

                    @if(1==2)
                    {!! Form::open([
                      'method'=>'DELETE',
                      'url' => ['/imagens', $item->id],
                      'style' => 'display:inline;'
                      ]) !!}
                      {!! Form::button('<i class="fa fa-trash-o"></i>', array(
                      'type' => 'submit',
                      'style' => 'border:none;background:none;',
                      'title' => 'Remover imagem',
                      'onclick'=>'return confirm("Tem certeza que deseja remover a imagem?")'
                      )) !!}
                      {!! Form::close() !!}
                    @endif
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix no-border">
            @if(1==2)
            <a href="{{ url('/imagens/create') }}" class="btn btn-success btn-sm" title="Adicionar imagem">
              <i class="fa fa-plus" aria-hidden="true"></i> Adicionar imagem
            </a>
            @endif

            <div class="pagination-wrapper pull-right"> {!! $imagens->appends(['search' => Request::get('search')])->render() !!} </div>
          </div>
        </div>
            </div>
        </div>
    </div>
@endsection
