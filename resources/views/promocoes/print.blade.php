
    <div class="_container">
        <div class="row">
			<div class="panel">
				<div class="panel-body">
					<h1 style="text-align:center;">Relatório de ouvintes</h1>
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
                <label for="promocao"><b>Promoção:</b></label>
                  @foreach($promocoes as $p)
                    @if(isset($request->promocao) && $request->promocao == $p->id)
                        {{$p->nome}}
                    @endif
                    @endforeach
              </select>

              <label style="margin-left:10px;" for="inlineFormInput"><b>Gênero:</b></label>
                  @if(isset($request->genero) && $request->genero == 'Feminino')
                    Feminino
                  @else
                    @if(isset($request->genero) && $request->genero == 'Masculino')
                       Masculino
                    @else
                      Todos
                    @endif
                  @endif
                  <br/><br/>
              <label style="" for="inlineFormInput"><b>Cidade:</b></label>
              
                  <?php foreach($cidades as $p):?>
                    @if(isset($request->cidade) && $request->cidade == $p->cidade)
                        {{$p->cidade}}
                    @endif
                  <?php endforeach;?>
                  @if($request->cidade === 0)
                    Todas
                    @endif
              

            
              <label style="margin-left:10px;" for="inlineFormInput"><b>Idade:</b></label>
              {{$request->idade_min}} a {{$request->idade_max}}
           </form>
 </div><div class="clearfix"></div><br/><br/>

            @if(isset($data))
                <table style="width:100%;font-size:75%;border: 1px solid black;" class="table table-hover table-bordered">
                    <tr style="border: 1px solid black;">
                        <th style="width:25%;border: 1px solid black;">Nome</th>
                        <th style="width:13%;border: 1px solid black;">CPF</th>
                        <th style="border: 1px solid black;">Idade</th>
                        <th style="width:15%;border: 1px solid black;">Telefone</th>
                        <th style="border: 1px solid black;">E-mail</th>
                        <th style="border: 1px solid black;">Cidade</th>
                    </tr>
                @foreach($data as $d)
                    <tr style="border: 1px solid black;">
                        <td style="border: 1px solid black;">{{$d->nome}}</td>
                        <td style="border: 1px solid black;">{{$d->cpf}}</td>
                        <td style="border: 1px solid black;">{{$d->idade}}</td>
                        <td style="border: 1px solid black;">{{$d->telefone}}</td>
                        <td style="border: 1px solid black;">{{$d->email}}</td>
                        <td style="border: 1px solid black;">{{$d->cidade}}</td>
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
