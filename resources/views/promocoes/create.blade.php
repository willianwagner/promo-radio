@extends('layouts.admin')

@section('content')



    <div class="_container">


        <div class="row">


	<div class="panel">
				<div class="panel-body">
					<h3> <i class="fa fa-gift"></i> Cadastrando Promoção</h3>
				</div>
				</div>
            <div>


              <section class="">

                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="{{ url('/promocoes') }}" title="Voltar"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/promocoes', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('promocoes.form')

                        {!! Form::close() !!}

                    </div>
                </div>
              </section>
            </div>
        </div>
    </div>
@endsection
