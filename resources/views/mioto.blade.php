<!doctype html>

@php
$hide = 0;
@endphp
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title></title>
    <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/AdminLTE.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('plugins/iCheck/minimal/_all.css') }}" rel="stylesheet">

	<link href="{{ asset('css/skins/skin-requinte.css') }}" rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .content {
                text-align: center;
            }
        </style>
    </head>
    <body>
      @if (1==1):
      <style>
        .banner{
          background-image: url('/img/oktoberfest.jpg');
          background-repeat: no-repeat;
          background-size: 100%;
          margin-top:-25px;
          background-color:#fff;
          height: 300px;
          }
          @media (max-width: 600px){
            .banner{
              height: 9rem;
            }
          }
          @media (min-width: 601px) and (max-width: 750px){
            .banner{
              height: 13rem;
            }
          }
          @media (min-width: 1100px) and (max-width: 1599px){
            .banner{
              height: 28rem;
            }
          }
          @media (min-width: 1600px){
            .banner{
              height: 44rem;
            }
          }
          @media (max-width: 750px){
            .footer-pensou-logo{
              height:170px;
              padding-top:70px;
            }
          }
      </style>
      @endif
	 <div class="banner">
	 </div>

        <div class="flex-center position-ref full-height">
            <div class="content col-xs-10 col-sm-8">
              <!-- avisos -->
              <div class="flash-message">
                  @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('flash_' . $msg))
                    @php
                      $mensagem = Session::get('flash_' . $msg)
                    @endphp
                    <h4>
                      <p class="alert alert-{{ $msg }}">{{ $mensagem }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    </h4>
                      @if(trim($mensagem) == 'CPF não cadastrado! Preencha seus dados no formulário abaixo para cadastrar')
                      @php
                        $hide = 1;
                      @endphp
                      @endif
                    @endif
                  @endforeach
                </div>
                <!-- /avisos -->
                @if(Session::has('pagina'))
                  @php
                    $hide = 1;
                  @endphp
                @endif

                <!-- erros -->
                @if ($errors->any())
                <div class="flash-message">
                  @foreach ($errors->all() as $error)
                    <h4>
                      <p class="alert alert-danger">{{ $error }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    </h4>
                  @endforeach
                </div>
                @endif
                <!-- /erros -->

              <p>
                <h2>Participe Agora</h2>

                <div id="existente">
                {!! Form::open(['url' => '/existente', 'class' => 'form-horizontal', 'files' => true]) !!}
                {!! Form::hidden('tipo', 'leitte') !!}
				   <div class="form-group">
                {!! Form::label('cpf', 'CPF', ['class' => 'control-label']) !!}
								<div class="input-group">
									 <div class="input-group-addon">
										<i class="fa fa-check-square-o"></i>
									 </div>
                    {!! Form::text('cpf', null, ['class' => 'form-control']) !!}
								</div>
								<!-- /.input group -->
						  </div>

						   <div class="form-group">
                 @foreach($promocoes as $promo)
                  <div class="col-sm-6 col-xs-12" style="padding:0;text-align:left;">
                    <label>
                      @if(count($promo) == 1)
                        <input type="checkbox" class="minimal" name="promocao[]" value="{{$promo->id}}" checked> {{$promo->nome}}
                      @else
                        <input type="checkbox" class="minimal" name="promocao[]" value="{{$promo->id}}"> {{$promo->nome}}
                      @endif
                    </label>
                  </div>
                 @endforeach
              </div>

                  <div class="form-group">
                      <div class="col-md-12">
                          {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Participar', ['class' => 'btn btn-primary']) !!}
                      </div>
                  </div>
                {!! Form::close() !!}
              </p>
            </div>

              <hr/>

              <div id="novo">
              <p>
                        {!! Form::open(['url' => '/cadastrar', 'class' => 'form-horizontal', 'files' => true]) !!}
                {!! Form::hidden('tipo', 'leitte') !!}
						  <div class="form-group">
                {!! Form::label('nome', 'Nome Completo', ['class' => 'control-label']) !!}

								<div class="input-group">
									 <div class="input-group-addon">
										<i class="fa fa-user"></i>
									 </div>
                    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
								</div>
								<!-- /.input group -->
						  </div>

						    <div class="form-group">
                  {!! Form::label('cpf', 'CPF', ['class' => 'control-label']) !!}

								<div class="input-group">
									 <div class="input-group-addon">
										<i class="fa fa-check-square-o"></i>
									 </div>
                   @php
                    $cpf = '';
                   @endphp
                   @if(null !== session()->get('cpf'))
                    @php
                      $cpf = session()->get('cpf');
                    @endphp
                   @endif
                  {!! Form::text('cpf', $cpf, ['class' => 'form-control']) !!}
								</div>
								<!-- /.input group -->
						  </div>

						  <div class="form-group">
                {!! Form::label('cidade', 'Cidade', ['class' => 'control-label']) !!}

								<div class="input-group">
									 <div class="input-group-addon">
										<i class="fa fa-map-marker"></i>
									 </div>
                    {!! Form::text('cidade', null, ['class' => 'form-control']) !!}
								</div>
								<!-- /.input group -->
						  </div>

						    <div class="form-group">
                {!! Form::label('data_nascimento', 'Data de nascimento', ['class' => 'control-label']) !!}

								<div class="input-group">
									 <div class="input-group-addon">
										<i class="fa  fa-calendar-check-o"></i>
									 </div>
                    {!! Form::text('data_nascimento', null, ['class' => 'form-control datepicker']) !!}
								</div>
								<!-- /.input group -->
						  </div>

						    <div class="form-group">
                {!! Form::label('email', 'E-mail', ['class' => 'control-label']) !!}

								<div class="input-group">
									 <div class="input-group-addon">
										<i class="fa fa-envelope"></i>
									 </div>
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
								</div>
								<!-- /.input group -->
						  </div>


						  <div class="form-group">
                  {!! Form::label('telefone', 'Telefone', ['class' => 'control-label']) !!}

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  {!! Form::text('telefone', null, ['class' => 'form-control']) !!}
                </div>
                <!-- /.input group -->
              </div>


			  	  <div class="form-group">
                  {!! Form::label('genero', 'Gênero', ['class' => 'control-label']) !!}

								<div class="input-group">
									 <div class="input-group-addon">
										<i class="fa fa-heart"></i>
									 </div>
                  {!! Form::select('genero', ['' => 'Selecione', 'Feminino' => 'Feminino', 'Masculino' => 'Masculino'], null, ['class' => 'form-control']) !!}
								</div>
								<!-- /.input group -->
						  </div>

						   <div class="form-group">
                   @if(null !== session()->get('promocoes'))
                    @php
                      $promos = session()->get('promocoes');
                    @endphp
                   @endif

                 @foreach($promocoes as $promo)
                  <div class="col-sm-6 col-xs-12" style="padding:0;text-align:left;">
                  <label>
                    @php
                      $tem = 0;
                    @endphp
                    @if(isset($promos))
                      @foreach($promos as $p)
                        @if($p == $promo->id)
                          @php
                            $tem = 1;
                          @endphp
                        @endif
                      @endforeach
                    @endif

                    @if($tem == 1)
                      <input type="checkbox" class="minimal" name="promocao[]" value="{{$promo->id}}" checked> {{$promo->nome}}
                    @else
                      <input type="checkbox" class="minimal" name="promocao[]" value="{{$promo->id}}"> {{$promo->nome}}
                    @endif
                  </label>
                </div>
                 @endforeach
              </div>

                          <div class="form-group">
                              <div class="col-md-12">
                                  {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Cadastrar e participar', ['class' => 'btn btn-primary']) !!}
                              </div>
                          </div>
                        {!! Form::close() !!}

              </p>
            </div>
            </div>
        </div>
	<div class="footer-pensou">
		<h2>Realização:</h2>
		<a href="http://www.amizade.fm.br/" target="_blank"><img src="/img/logoradiop.png" width="300"></img></a>

	 </div>

	  <div class="footer-pensou-logo">


		<div class="pensou">
			<h4> Desenvolvido por: </h4>
			<a href="http://www.pensousistemas.com.br" target="_blank"><img src="/img/logopensou.png" width="200"></img></a>
		</div>
	 </div>
    <!-- Scripts -->
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>


    <!-- Animation library for notifications   -->
    <link href="/lib/css/animate.min.css" rel="stylesheet"/>
    <!--  Jquery UI CSS    -->
    <link href="/lib/js/jquery-ui/jquery-ui.min.css" rel="stylesheet"/>
    <!--  Notifications Plugin    -->
    <script src="/lib/js/bootstrap-notify.js"></script>

    <!-- iCheck 1.0.1 -->
    <script src="/plugins/iCheck/icheck.min.js"></script>
    <script>
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    </script>

    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="/plugins/datepicker/datepicker3.css">
    <script src="/plugins/datepicker/bootstrap-datepicker.js"></script>

    <!-- InputMask -->
    <script src="/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="/plugins/datepicker/locales/bootstrap-datepicker.pt-BR.js"></script>

    <script>
      $(document).ready(function(){
        $('input[name=cpf]').inputmask("999.999.999-99");
        $('input[name=cnpj]').inputmask("99.999.999/9999-99");
        $('input[name=telefone]').inputmask("(99) 99999 9999");
        $('input[name=data_nascimento]').inputmask("99/99/9999");

        @if($hide == 1)
        $("#existente").hide();
        $("#novo").show();
        @else
        $("#novo").hide();
        @endif

      });

      //Date picker
      $(".datepicker").datepicker({'language': 'pt-BR', 'format': 'dd/mm/yyyy','autoclose': true});
    </script>
    </body>
</html>
