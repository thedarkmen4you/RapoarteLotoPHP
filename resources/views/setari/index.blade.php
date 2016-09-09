@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Aparate</div>

                <div class="panel-body">
                   <form action="{{ isset($p_aparat) ? url('setari/'.@$p_aparat->id) : url('setari') }}" method="POST" autocomplete="off">
                   		{{ csrf_field() }}
                   		{{ method_field('POST') }}
					  	<div class="form-group col-xs-2 col-md-2">
					    	<label class="control-label" for="aparat">Aparat</label>
					    	<input type="text" class="form-control" id="aparat" name="aparat" value="{{ isset($p_aparat) ? $p_aparat->value : '' }}">
					  	</div>
					  	<div class="form-group col-xs-2 col-md-2">
					  		<label class="control-label" for="crc">&nbsp;</label>
					  		<button type="submit" class="btn btn-primary form-control" name="salveaza_aparate" value="Salveaza">Salveaza</button>
					  	</div>
					</form>
					<div style="clear: both">
						@if (Session::has('message'))
						    <div class="alert alert-info">{{ Session::get('message') }}</div>
						@endif
						@extends('errors.errors')
					</div>
					<div class="col-xs-4 col-md-4">
						<table class="table table-striped">
	                    	<thead>
								<tr>
									<th>Nr</th>
									<th>Aparat</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@if (count($p_aparate) > 0)
									<?php $nrAparat = 1; ?> 
									@foreach ($p_aparate as $ap)
										<tr>
											<td>{{ $nrAparat++ }} </td>
											<td>{{ $ap->value }} </td>
										    <td width="82px">
												<form action="{{ url('setari/'.$ap->id) }}" method="POST">
										            {{ csrf_field() }}
										            {{ method_field('DELETE') }}
										
										            <button type="submit" class="btn btn-danger">
										                <i class="fa fa-trash"></i> Delete
										            </button>
										        </form>
											</td>
										</tr>
									@endforeach
								@endif
							</tbody>
						</table>
					</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Agentie</div>

                <div class="panel-body">
	                <form class="form-horizontal" action="{{ url('setari') }}" method="POST" autocomplete="off">
	                	{{ csrf_field() }}
                   		{{ method_field('POST') }}
						<div class="form-group">
							<label for="agentie" class="col-sm-2 control-label">Agentie</label>
							<div class="col-sm-2">
								<input type="hidden" class="form-control" name="id_agentie" value="{{ isset($p_agentie) && count($p_agentie)>0 ? $p_agentie->id : '' }}">
								<input type="text" class="form-control" id="agentie" name="agentie" value="{{ isset($p_agentie) && count($p_agentie)>0 ? $p_agentie->value : '' }}">
							</div>
						</div>
						<div class="form-group">
							<label for="marca" class="col-sm-2 control-label">Marca</label>
							<div class="col-sm-2">
								<input type="hidden" class="form-control" name="id_marca" value="{{ isset($p_marca) && count($p_marca)>0 ? $p_marca->id : '' }}">
								<input type="text" class="form-control" id="marca" name="marca" value="{{ isset($p_marca) && count($p_marca)>0 ? $p_marca->value : '' }}">
							</div>
						</div>
						<div class="form-group">
							<label for="judet" class="col-sm-2 control-label">Judet</label>
							<div class="col-sm-3">
								<input type="hidden" class="form-control" name="id_judet" value="{{ isset($p_judet) && count($p_judet)>0 ? $p_judet->id : '' }}">
								<input type="text" class="form-control" id="judet" name="judet" value="{{ isset($p_judet) && count($p_judet)>0 ? $p_judet->value : '' }}">
							</div>
						</div>
						<div class="form-group">
							<label for="localitate" class="col-sm-2 control-label">Localitate</label>
							<div class="col-sm-3">
								<input type="hidden" class="form-control" name="id_localitate" value="{{ isset($p_localitate) && count($p_localitate)>0 ? $p_localitate->id : '' }}">
								<input type="text" class="form-control" id="localitate" name="localitate" value="{{ isset($p_localitate) && count($p_localitate)>0 ? $p_localitate->value : '' }}">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-primary" name="salveaza_agentie" value="Salveaza">Salveaza</button>
							</div>
						</div>
					</form>
					@if (Session::has('message2'))
					    <div class="alert alert-info">{{ Session::get('message2') }}</div>
					@endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Contoare</div>

                <div class="panel-body">
	                <form class="form-horizontal" action="{{ url('setari') }}" method="POST" autocomplete="off">
	                	{{ csrf_field() }}
                   		{{ method_field('POST') }}
						<div class="form-group">
							<label for="nrBorderouDecont" class="col-sm-3 control-label">Nr borderou decont</label>
							<div class="col-sm-2">
								<input type="hidden" class="form-control" name="id_nrBorderouDecont" value="{{ isset($p_nrBorderouDecont) && count($p_nrBorderouDecont)>0 ? $p_nrBorderouDecont->id : '' }}">
								<input type="text" class="form-control" id="nrBorderouDecont" name="nrBorderouDecont" value="{{ isset($p_nrBorderouDecont) && count($p_nrBorderouDecont)>0 ? $p_nrBorderouDecont->value : '' }}">
							</div>
						</div>
						<div class="form-group">
							<label for="nrBorderouInsotitor" class="col-sm-3 control-label">Nr borderou insotitor</label>
							<div class="col-sm-2">
								<input type="hidden" class="form-control" name="id_nrBorderouInsotitor" value="{{ isset($p_nrBorderouInsotitor) && count($p_nrBorderouInsotitor)>0 ? $p_nrBorderouInsotitor->id : '' }}">
								<input type="text" class="form-control" id="nrBorderouInsotitor" name="nrBorderouInsotitor" value="{{ isset($p_nrBorderouInsotitor) && count($p_nrBorderouInsotitor)>0 ? $p_nrBorderouInsotitor->value : '' }}">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-10">
								<button type="submit" class="btn btn-primary" name="salveaza_contoare" value="Salveaza">Salveaza</button>
							</div>
						</div>
					</form>
					@if (Session::has('message3'))
					    <div class="alert alert-info">{{ Session::get('message3') }}</div>
					@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection