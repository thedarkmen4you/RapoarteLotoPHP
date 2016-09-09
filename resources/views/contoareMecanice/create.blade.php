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
                   <form action="{{ isset($contor) ? url('contoare_mecanice/'.@$contor->id) : url('contoare_mecanice') }}" method="POST">
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
					    	<label class="control-label" for="in">In</label>
					    	<input type="text" class="form-control" id="in" name="in" value="{{ $contor->in or '' }}">
					  	</div>
					  	<div class="form-group col-xs-2 col-md-2">
					    	<label class="control-label" for="out">Out</label>
					    	<input type="text" class="form-control" id="out" name="out" value="{{ $contor->out or '' }}">
					  	</div>
					  	<div class="form-group col-xs-2 col-md-2">
					    	<label class="control-label" for="bet">Bet</label>
					    	<input type="text" class="form-control" id="bet" name="bet" value="{{ $contor->bet or '' }}">
					  	</div>
					  	<div class="form-group col-xs-2 col-md-2">
					    	<label class="control-label" for="win">Win</label>
					    	<input type="text" class="form-control" id="win" name="win" value="{{ $contor->win or '' }}">
					  	</div>
					  	<div class="form-group col-xs-2 col-md-2">
					    	<label class="control-label" for="games">Games</label>
					    	<input type="text" class="form-control" id="games" name="games" value="{{ $contor->games or '' }}">
					  	</div>
					  	<div class="form-group col-xs-2 col-md-2">
					    	<label class="control-label" for="remonte">Remonte</label>
					    	<input type="text" class="form-control" id="remonte" name="remonte" value="{{ $contor->remonte or '' }}">
					  	</div>
					  	<div class="form-group col-xs-2 col-md-2">
					    	<label class="control-label" for="handPay">Handpay</label>
					    	<input type="text" class="form-control" id="handPay" name="handPay" value="{{ $contor->handPay or '' }}">
					  	</div>
					  	<div class="form-group col-xs-2 col-md-2">
					    	<label class="control-label" for="bills">Bills</label>
					    	<input type="text" class="form-control" id="bills" name="bills" value="{{ $contor->bills or '' }}">
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
								<th>In</th>
								<th>Out</th>
								<th>Bet</th>
								<th>Win</th>
								<th>Games</th>
								<th>Remonte</th>
								<th>Handpay</th>
								<th>Bills</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@if (count($p_date) > 0)
								<?php $nrBilete = 1; ?>
								@foreach ($p_date as $date)
									<tr>
										<td>{{ $nrBilete++ }} </td>
										<td>{{ $date->data }} </td>
										<td>{{ $date->setari->value }} </td>
										<td>{{ $date->in }} </td>
										<td>{{ $date->out }} </td>
										<td>{{ $date->bet }} </td>
										<td>{{ $date->win }} </td>
										<td>{{ $date->games }} </td>
										<td>{{ $date->remonte }} </td>
										<td>{{ $date->handPay }} </td>
										<td>{{ $date->bills }} </td>
										<td width="84px">
											<form action="{{ url('contoare_mecanice/'.$date->id.'/edit') }}" method="POST">
												{{ csrf_field() }}
												{{ method_field('GET') }}
									            <button type="submit" class="btn btn-info">
									                <i class="fa fa-edit"></i> Edit
									            </button>
									        </form>
									    </td>
									    <td width="82px">
											<form action="{{ url('contoare_mecanice/'.$date->id) }}" method="POST">
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
