@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">SorteioGanhadore {{ $sorteioganhadore->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/sorteio-ganhadores') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/sorteio-ganhadores/' . $sorteioganhadore->id . '/edit') }}" title="Edit SorteioGanhadore"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('sorteioganhadores' . '/' . $sorteioganhadore->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete SorteioGanhadore" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $sorteioganhadore->id }}</td>
                                    </tr>
                                    <tr><th> Ouvinte Id </th><td> {{ $sorteioganhadore->ouvinte_id }} </td></tr><tr><th> Sorteio Id </th><td> {{ $sorteioganhadore->sorteio_id }} </td></tr><tr><th> Promocao Id </th><td> {{ $sorteioganhadore->promocao_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
