@extends('layouts.admin')

@section('content')
    <div class="_container">
        <div class="row">
            <div>
              <section class="content-header">
                <h1>
                  Produtos
                  <small>Visualizar</small>
                </h1>
              </section>

              <section class="content">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <a href="{{ url('/admin/produtos') }}" title="Voltar"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
                        <a href="{{ url('/admin/produtos/' . $produto->id . '/edit') }}" title="Editar produto"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/produtos', $produto->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Remover', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Remover produto',
                                    'onclick'=>'return confirm("Tem certeza que deseja remover o produto?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $produto->id }}</td>
                                    </tr>
                                    <tr><th> Nome </th><td> {{ $produto->nome }} </td></tr>
                                    <tr><th> Situação </th><td> {{ $produto->status }} </td></tr>
                                    <tr><th> Descrição </th><td> {{ $produto->descricao }} </td></tr>
                                    <tr><th> Imagem </th><td> <img src="/uploads/produtos/{{ $produto->imagem }}"/> </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
              </section>
            </div>
        </div>
    </div>
@endsection
