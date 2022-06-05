@extends('layouts.admin')

@section('content')
    <div class="_container">
        <div class="row">
			<div class="panel">
				<div class="panel-body">
					<h3> <i class="fa fa-list"></i> Relatório</h3>
				</div>
				</div>


            <div>
      <div class="panel panel-body">
        <div >
          <div class="box-header">
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          <div class="col-sm-10">    
            <form class="text-center form-inline" id="form-periodo">
                <label for="promocao">Promoção:</label>
              <select name="promocao" id="promocao" class="form-control mb-2 mr-sm-2 mb-sm-0" style="margin-left:10px">
                  <?php foreach($promocoes as $p):?>
                    @if(isset($request->promocao) && $request->promocao == $p->id)
                        <option value="{{$p->id}}" selected>{{$p->nome}}</option>
                    @else
                        <option value="{{$p->id}}">{{$p->nome}}</option>
                    @endif
                  <?php endforeach;?>
              </select>

              <label style="margin-left:10px;" for="inlineFormInput">Genero:</label>
              <select name="genero" id="genero" class="form-control mb-2 mr-sm-2 mb-sm-0" style="margin-left:10px">
                  <option value="0">Todos</option>
                  @if(isset($request->genero) && $request->genero == 'Feminino')
                    <option value="Feminino" selected>Feminino</option>
                    <option value="Masculino">Masculino</option>
                  @else
                    @if(isset($request->genero) && $request->genero == 'Masculino')
                        <option value="Feminino">Feminino</option>
                        <option value="Masculino" selected>Masculino</option>
                    @else
                      <option value="Feminino">Feminino</option>
                      <option value="Masculino">Masculino</option>
                    @endif
                  @endif
              </select>
              <br/><br/>
              <label style="margin-left:10px;" for="inlineFormInput">Cidade:</label>
              <select name="cidade" id="cidade" class="form-control mb-2 mr-sm-2 mb-sm-0" style="margin-left:10px">
                  <option value="0">Todas</option>
                  <?php foreach($cidades as $p):?>
                    @if(isset($request->cidade) && $request->cidade == $p->cidade)
                        <option value="{{$p->cidade}}" selected>{{$p->cidade}}</option>
                    @else
                        <option value="{{$p->cidade}}">{{$p->cidade}}</option>
                    @endif
                  <?php endforeach;?>
              </select>

             
              <label style="margin-left:10px;" for="inlineFormInput">Idade:</label>
              <input id="idade_min" name="idade_min" type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" style="margin-left:10px;margin-right:10px;"placeholder="idade mínima" value="{{$request->idade_min or ''}}"> a 
              <input id="idade_max" name="idade_max" type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" style="margin-left:10px;margin-right:10px;"placeholder="idade máxima" value="{{$request->idade_max or ''}}"> 

              <button type="submit" class="btn btn-primary">Filtrar</button>
           </form>
 </div><div class="clearfix"></div><br/><br/>

            @if(isset($data))
                <a target="_blank" class="btn btn-success" href="/relatorio-pdf/{{$request->genero}}/{{$request->promocao}}/{{$request->cidade}}/{{$request->idade_min}}/{{$request->idade_max}}">PDF</a><br/><br/>
                <table class="table table-hover table-bordered">
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Idade</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Cidade</th>
                    </tr>
                @foreach($data as $d)
                    <tr>
                        <td>{{$d->nome}}</td>
                        <td>{{$d->cpf}}</td>
                        <td>{{$d->idade}}</td>
                        <td>{{$d->telefone}}</td>
                        <td>{{$d->email}}</td>
                        <td>{{$d->cidade}}</td>
                    </tr>
                @endforeach
                </table>
            @endif
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix no-border">
          </div>
        </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script>
    $(document).ready(function(){
      $(function() {
          $('#form-periodo').each(function() {
              $(this).find('input').keypress(function(e) {
                  // Enter pressed?
                  if(e.which == 10 || e.which == 13) {
                      this.form.submit();
                  }
              });
          });
      });

      $('#form-periodo').on('submit', function(e){
          e.preventDefault();

          genero = $('#genero').val();
          promocao = $('#promocao').val();
          cidade = $('#cidade').val();
          idade_min = $('#idade_min').val();
          idade_max = $('#idade_max').val();

          if(idade_min == ''){
              idade_min = 1;
          }
          if(idade_max == ''){
              idade_max = 99;
          }

          window.location.replace("/relatorio/"+genero+"/"+promocao+"/"+cidade+"/"+idade_min+"/"+idade_max);
      });
  });

</script>
@endsection

