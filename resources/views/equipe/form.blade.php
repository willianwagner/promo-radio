<div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
    <div class="col-md-12">
        <label for="nome" class="control-label">{{ 'Nome' }}</label>
        <input class="form-control" name="nome" type="text" id="nome" value="{{ $equipe->nome or ''}}" >
        {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('descricao') ? 'has-error' : ''}}">
    <div class="col-md-12">
        <label for="descricao" class="control-label">{{ 'Descricao' }}</label>
        <textarea class="form-control" rows="5" name="descricao" type="textarea" id="descricao" >{{ $equipe->descricao or ''}}</textarea>
        {!! $errors->first('descricao', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('imagem') ? 'has-error' : ''}}">
    <div class="col-md-12">
        <label for="imagem" class="control-label">{{ 'Imagem' }}</label>
        <div id="upload-demo"></div>
        <div class="col-xs-8">
        <input class="form-control" name="imagem" type="file" id="imagem" value="{{ $equipe->imagem or ''}}" >
        </div>
        <div class="col-xs-4">
        <button class="btn btn-success upload-image" style="margin-top:2%">Upload da imagem</button>
        </div>
        <input name="imagem_url" type="hidden" id="imagem_url">
        {!! $errors->first('imagem', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-12">
        <input class="btn btn-primary" type="submit" value="Enviar">
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>

<script type="text/javascript">



$.ajaxSetup({

  headers: {

    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

  }

});



var resize = $('#upload-demo').croppie({

    enableExif: true,

    enableOrientation: true,    

    viewport: { 

        width: 300,

        height: 300,

        type: 'circle'

    },

    boundary: {

        width: 300,

        height: 300

    }

});



$('#imagem').on('change', function () { 

  var reader = new FileReader();

    reader.onload = function (e) {

      resize.croppie('bind',{

        url: e.target.result

      }).then(function(){

        console.log('jQuery bind complete');

      });

    }

    reader.readAsDataURL(this.files[0]);

});



$('.upload-image').on('click', function (ev) {
    ev.preventDefault();
  resize.croppie('result', {

    type: 'canvas',

    size: 'viewport'

  }).then(function (img) {

    $.ajax({

      url: "/crop-image",

      type: "POST",

      data: {"image":img},

      success: function (data) {
        $("#imagem_url").val(data.url);
        alert('Upload enviado! Pressione ENVIAR para gravar dados');
      }

    });

  });

});
</script>

