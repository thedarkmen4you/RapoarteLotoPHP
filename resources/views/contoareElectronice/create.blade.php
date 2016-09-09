@extends('layouts.app')

@section('style')
	<link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Adauga contor</div>

                <div class="panel-body">
                   <form action="{{ isset($contor) ? url('contoare_electronice/'.@$contor->id) : url('contoare_electronice') }}" method="POST">
                   		{{ csrf_field() }}
                   		@if ( isset($contor) )
                   			{{ method_field('PUT') }}
                   		@else
                   			{{ method_field('POST') }}
                   		@endif
					  	<div class="form-group col-xs-2 col-md-2" >
					    	<label class="control-label" for="data">Data</label>
					    	<div class='input-group date' id='datetimepicker1'>
			                    <input type='text' class="form-control" id="data" name="data" value="{{ $contor->data or date('Y-m-d') }}" style="min-width: 102px"/>
			                    <span class="input-group-addon">
			                        <span class="fa fa-calendar"></span>
			                    </span>
			                </div>
					  	</div>
					  	<div class="form-group col-xs-2 col-md-2">
					    	<label class="control-label" for="aparat">Aparat</label>
					    	<select class="form-control" id="aparat" name="aparat" >
					    		@if (count($p_aparate) > 0)
					    			@foreach ($p_aparate as $aparat)
					    				<option value="{{ $aparat->id }}" {{  (isset($contor) && $contor->aparat==$aparat->id)? 'selected' : '' }}>{{ $aparat->value }}</option>
					    			@endforeach
					    		@endif
							</select>
					  	</div>
					  	<div class="form-group col-xs-2 col-md-2">
					    	<label class="control-label" for="indexInceput">Index inceput</label>
					    	<input type="text" class="form-control" id="indexInceput" name="indexInceput" value="{{ $contor->indexInceput or '' }}">
					  	</div>
					  	<div class="form-group col-xs-2 col-md-2">
					    	<label class="control-label" for="indexSfarsit">Index sfarsit</label>
					    	<input type="text" class="form-control" id="indexSfarsit" name="indexSfarsit" value="{{ $contor->indexSfarsit or '' }}">
					  	</div>
					  	<div class="form-group col-xs-2 col-md-2">
					    	<label class="control-label" for="pretImpuls">Pret impuls</label>
					    	<input type="text" class="form-control" id="pretImpuls" name="pretImpuls" value="{{ $contor->pretImpuls or '' }}">
					  	</div>
					  	<div class="form-group col-xs-2 col-md-2">
					  		<label class="control-label" for="crc">&nbsp;</label>
					  		@if ( isset($contor) )
					  			<button type="submit" class="btn btn-primary form-control">Modifica</button>
					  		@else
					  			<button type="submit" class="btn btn-primary form-control">Salveaza</button>
					  		@endif
					  	</div>
					</form>
					<div style="clear: both">
						@if (Session::has('message'))
						    <div class="alert alert-info">{{ Session::get('message') }}</div>
						@endif
						@extends('errors.errors')
					</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Vizualizare</div>

                <div class="panel-body">
                    <table class="table table-striped">
                    	<thead>
							<tr>
								<th>Nr</th>
								<th>Data</th>
								<th>Aparat</th>
								<th>Index inceput</th>
								<th>Index sfarsit</th>
								<th>Total impulsuri</th>
								<th>Pret impuls</th>
								<th>Valoare incasari</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@if (count($p_date) > 0)
								<?php $nrBilete = 1; ?>
								@foreach ($p_date as $bil)
									<tr>
										<td>{{ $nrBilete++ }} </td>
										<td>{{ $bil->data }} </td>
										<td>{{ $bil->setari->value }} </td>
										<td>{{ $bil->indexInceput }} </td>
										<td>{{ $bil->indexSfarsit }} </td>
										<td>{{ $bil->totalImpulsuri }} </td>
										<td>{{ $bil->pretImpuls }} </td>
										<td>{{ $bil->valoareIncasari }} </td>
										<td width="84px">
											<form action="{{ url('contoare_electronice/'.$bil->id.'/edit') }}" method="POST">
												{{ csrf_field() }}
												{{ method_field('GET') }}
									            <button type="submit" class="btn btn-info">
									                <i class="fa fa-edit"></i> Edit
									            </button>
									        </form>
									    </td>
									    <td width="82px">
											<form action="{{ url('contoare_electronice/'.$bil->id) }}" method="POST">
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
@endsection

@section('JavaScript')
	<script src="{{ asset('js/moment.js') }}"></script>
	<script src="{{ asset('js/bootstrap/transition.js') }}"></script>
	<script src="{{ asset('js/bootstrap/collapse.js') }}"></script>
	<script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
	
	<script type="text/javascript">
        $(function () {
        	$('#datetimepicker1').datetimepicker({ format: 'YYYY-MM-DD' });
    	});
    </script>
@endsection
