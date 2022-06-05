@extends('layouts.admin')

@section('content')
    <div class="_container">
        <div class="row">
			<div class="panel">
				<div class="panel-body">
					<h3> <i class="fa fa-image"></i> Banner</h3>
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
                <span style="width:30%"class="text">LINK</span>
                <div class="tools">
                </div>
              </li>
              @foreach($banners as $item)
                <li class="mob">
                  <span data-title="IMAGEM:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp3 text"><a href="/uploads/banners/{{ $item->imagem }}" target="_blank"><img style="width:100px;height:100px;" src="/uploads/banners/{{ $item->imagem }}"/></a></span>
                  <span data-title="LINK:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp3 text">{{$item->link}}</span>

                  <div class="tools sp4">
                    <a href="{{ url('/banners/' . $item->id . '/edit') }}"><i class="fa fa-edit"></i></a>

                    {!! Form::open([
                      'method'=>'DELETE',
                      'url' => ['/banners', $item->id],
                      'style' => 'display:inline;'
                      ]) !!}
                      {!! Form::button('<i class="fa fa-trash-o"></i>', array(
                      'type' => 'submit',
                      'style' => 'border:none;background:none;',
                      'title' => 'Remover banner',
                      'onclick'=>'return confirm("Tem certeza que deseja remover o banner?")'
                      )) !!}
                      {!! Form::close() !!}
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix no-border">
            <a href="{{ url('/banners/create') }}" class="btn btn-success btn-sm" title="Adicionar banner">
              <i class="fa fa-plus" aria-hidden="true"></i> Adicionar banner
            </a>

            <div class="pagination-wrapper pull-right"> {!! $banners->appends(['search' => Request::get('search')])->render() !!} </div>
          </div>
        </div>
            </div>
        </div>
    </div>
@endsection
