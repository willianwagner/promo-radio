<div class="form-group {{ $errors->has('titulo') ? 'has-error' : ''}}">
    <div class="col-md-12">
        <label for="titulo" class="control-label">{{ 'Titulo' }}</label>
        <input class="form-control" name="titulo" type="text" id="titulo" value="{{ $blog->titulo or ''}}" >
        {!! $errors->first('titulo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('categoria') ? 'has-error' : ''}}">
    <div class="col-md-12">
        <label for="categoria" class="control-label">{{ 'Categoria' }}</label>
        @php
            $cat = $blog->categoria or '';
        @endphp
        {!! Form::select('categoria', ['Notícias' => 'Noticias', 'Eventos' => 'Eventos', 'Social' => 'Social', 'Esporte' => 'Esporte'], $cat, ['class' => 'form-control']) !!}
        {!! $errors->first('categoria', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('texto') ? 'has-error' : ''}}">
    <div class="col-md-12">
        <label for="texto" class="control-label">{{ 'Texto' }}</label>
        <textarea class="form-control" rows="5" name="texto" type="textarea" id="texto" >{{ $blog->texto or ''}}</textarea>
        {!! $errors->first('texto', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('imagem') ? 'has-error' : ''}}">
    <div class="col-md-12">
        <label for="imagem" class="control-label">{{ 'Imagem' }}</label>
        <input class="form-control" name="imagem" type="file" id="imagem" value="{{ $blog->imagem or ''}}" >
        {!! $errors->first('imagem', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('imagem_interna') ? 'has-error' : ''}}">
    <div class="col-md-12">
        <label for="imagem_interna" class="control-label">{{ 'Imagem interna' }} <small>(tamanho: 370x512, extensão: .jpg)</small></label>
        <input class="form-control" name="imagem_interna" type="file" id="imagem_interna" value="{{ $blog->imagem_interna or ''}}" >
        {!! $errors->first('imagem_interna', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-12">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
