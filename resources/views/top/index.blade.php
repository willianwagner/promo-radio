@extends('layouts.admin')

@section('content')
<script
  src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
  integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g="
  crossorigin="anonymous">
</script>

<div class="_container">
        <div class="row">
			<div class="panel">
				<div class="panel-body">
					<h3> <i class="fa fa-check"></i> Top 10</h3>
				</div>
				</div>


            <div>
      <div class="panel panel-body">
      <form class="form-inline" id="form-periodo">
                        <label for="inlineFormInput">Mês:</label>
                        <select name="mes" id="mes" class="form-control mb-2 mr-sm-2 mb-sm-0">
                          @for($i=1;$i<13;$i++)
                            @if($i == $periodo->mes)
                              <option SELECTED>{{str_pad($i, 2, '0', STR_PAD_LEFT)}}</option>
                            @else
                              <option>{{str_pad($i, 2, '0', STR_PAD_LEFT)}}</option>
                            @endif
                          @endfor
                        </select>


                        <label style="padding-left:10px;" for="inlineFormInputGroup">Ano:</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                          <input name="ano" id="ano" type="text" title="" placeholder="" class="form-control numberonly" value="{{$periodo->ano}}"/>
                        </div>

                        <button type="submit" class="btn btn-primary">Alterar</button>
                      </form>
                      <br/>


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

        @if(count($top) == 0)
          <a class="btn btn-info" href="/base-top10/{{$periodo->mes}}/{{$periodo->ano}}">Gerar base top 10 mês selecionado</a>
        @else
          <div class="box-body">
            <ul class="todo-list">
              <li class="th">
                <span style="width:20%"class="text">POSIÇÃO</span>
                <span style="width:30%"class="text">ARTISTA</span>
                <span style="width:20%"class="text">MÚSICA</span>
                <span style="width:20%"class="text">CAPA</span>
                <div class="tools">
                </div>
              </li>
              @foreach($top as $item)
                <li class="mob">
                  <span data-title="POSIÇÃO:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp2 text">{{$item->posicao}}</span>
                  <span data-title="ARTISTA:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp3 text">{{$item->artista}}</span>
                  <span data-title="MÚSICA:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp2 text">{{$item->musica}}</span>
                  <span data-title="CAPA:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="sp1 text">
                  @if($item->capa != '')
                                            <img src="/uploads/capa/{{ $item->capa }}" height="80"/>
                                            @else
                                            @endif
                </span>

                  <div class="tools sp4">
                    <a href="{{ url('/top/' . $item->id . '/edit') }}"><i class="fa fa-edit"></i></a>
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
        @endif
          <!-- /.box-body -->
          <div class="box-footer clearfix no-border">
          </div>
        </div>
            </div>
        </div>
    </div>
@endsection
