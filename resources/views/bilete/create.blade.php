@extends('layouts.app')

@section('style')
	<link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Adauga bilet</div>

                <div class="panel-body">
                   <form action="{{ isset($bilet) ? url('bilete/'.@$bilet->id) : url('bilete') }}" method="POST">
                   		{{ csrf_field() }}
                   		@if ( isset($bilet) )
                   			{{ method_field('PUT') }}
                   		@else
                   			{{ method_field('POST') }}
                   		@endif
					  	<div class="form-group col-xs-2 col-md-2" >
					    	<label class="control-label" for="data">Data</label>
					    	<div class='input-group date' id='datetimepicker1'>
			                    <input type='text' class="form-control" id="data" name="data" value="{{ $bilet->data or date('Y-m-d') }}" style="min-width: 102px"/>
			                    <span class="input-group-addon">
			                        <span class="fa fa-calendar"></span>
			                    </span>
			                </div>
					  	</div>
					  	<div class="form-group col-xs-2 col-md-2">
					    	<label class="control-label" for="aparat">Aparat</label>
					    	<select class="form-control" id="aparat" name="aparat" >
					    		@if (count($aparate) > 0)
					    			@foreach ($aparate as $aparat)
					    				<option value="{{ $aparat->id }}" {{  (isset($bilet) && $bilet->aparat==$aparat->id)? 'selected' : '' }}>{{ $aparat->value }}</option>
					    			@endforeach
					    		@endif
							</select>
					  	</div>
					  	<div class="form-group col-xs-2 col-md-2">
					    	<label class="control-label" for="bilet">Bilet</label>
					    	<input type="text" class="form-control" id="bilet" name="bilet" value="{{ $bilet->bilet or '' }}">
					  	</div>
					  	<div class="form-group col-xs-2 col-md-2">
					    	<label class="control-label" for="crc">CRC</label>
					    	<input type="text" class="form-control" id="crc" name="crc" value="{{ $bilet->crc or '' }}">
					  	</div>
					  	<div class="form-group col-xs-2 col-md-2">
					    	<label class="control-label" for="castigBrut">Castig brut</label>
					    	<input type="text" class="form-control" id="castigBrut" name="castigBrut" value="{{ $bilet->castigBrut or '' }}">
					  	</div>
					  	<div class="form-group col-xs-2 col-md-2">
					  		<label class="control-label" for="crc">&nbsp;</label>
					  		@if ( isset($bilet) )
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
								<th>Bilet</th>
								<th>CRC</th>
								<th>Castig brut</th>
								<th>Ramburs</th>
								<th>Impozit</th>
								<th>Castig net</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@if (count($bilete) > 0)
								<?php $nrBilete = 1; ?>
								@foreach ($bilete as $bil)
									<tr>
										<td>{{ $nrBilete++ }} </td>
										<td>{{ $bil->data }} </td>
										<td>{{ $bil->setari->value }} </td>
										<td>{{ $bil->bilet }} </td>
										<td>{{ $bil->crc }} </td>
										<td>{{ $bil->castigBrut }} </td>
										<td>{{ $bil->ramburs }} </td>
										<td>{{ $bil->impozit }} </td>
										<td>{{ $bil->castigNet }} </td>
										<td width="84px">
											<form action="{{ url('bilete/'.$bil->id.'/edit') }}" method="POST">
												{{ csrf_field() }}
												{{ method_field('GET') }}
									            <button type="submit" class="btn btn-info">
									                <i class="fa fa-edit"></i> Edit
									            </button>
									        </form>
									    </td>
									    <td width="82px">
											<form action="{{ url('bilete/'.$bil->id) }}" method="POST">
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
