<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setari;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SetariController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {	
    	$user = Auth::user();
    	return view('setari/index', [
	        'p_aparate' => Setari::where([['type', '=', 'aparate'],['userId', '=', $user->id]])->whereNull('deleted_at')->get(),
    		'p_agentie' => Setari::where([['type', '=', 'agentie'],['userId', '=', $user->id]])->whereNull('deleted_at')->first(),
    		'p_marca' => Setari::where([['type', '=', 'marca'],['userId', '=', $user->id]])->whereNull('deleted_at')->first(),
    		'p_judet' => Setari::where([['type', '=', 'judet'],['userId', '=', $user->id]])->whereNull('deleted_at')->first(),
    		'p_localitate' => Setari::where([['type', '=', 'localitate'],['userId', '=', $user->id]])->whereNull('deleted_at')->first(),
    		'p_nrBorderouDecont' => Setari::where([['type', '=', 'nrBorderouDecont'],['userId', '=', $user->id]])->whereNull('deleted_at')->first(),
    		'p_nrBorderouInsotitor' => Setari::where([['type', '=', 'nrBorderouInsotitor'],['userId', '=', $user->id]])->whereNull('deleted_at')->first(),
	    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$user = Auth::user();
    	
    	// salvare aparate
    	if(isset($request->salveaza_aparate)){
	    	$validator = Validator::make($request->all(), [
	    			'aparat' => 'required'
	    	]);
	    	
	    	if ($validator->fails()) {
	    		return redirect('/setari')
	    		->withInput()
	    		->withErrors($validator);
	    	}else{
	    		$setari = new Setari;
	    		$setari->userId = $user->id;
	    		$setari->type = "aparate";
	    		$setari->value = $request->aparat;
	    		$setari->save();
	    	
	    		Session::flash('message', 'S-a salvat cu succes!');
	    		return redirect('/setari');
	    	}
    	}
    	
    	// salvare agentie
    	if(isset($request->salveaza_agentie)){
    		$validator = Validator::make($request->all(), [
    			'agentie' => 'required',
    			'marca' => 'required',
    			'judet' => 'required',
    			'localitate' => 'required'
    		]);
    		
    		if ($validator->fails()) {
    			return redirect('/setari')
    			->withInput()
    			->withErrors($validator);
    		}else{
    			// softDelete la valorile vechi
    			$del = Setari::find($request->id_agentie); if($del){ $del->delete(); }
    			$del = Setari::find($request->id_marca); if($del){ $del->delete(); }
    			$del = Setari::find($request->id_judet); if($del){ $del->delete(); }
    			$del = Setari::find($request->id_localitate); if($del){ $del->delete(); }
    			
    			// salveaza valorile noi
    			$setari = new Setari;
    			$setari->userId = $user->id;
    			$setari->type = "agentie";
    			$setari->value = $request->agentie;
    			$setari->save();
    			
    			$setari = new Setari;
    			$setari->userId = $user->id;
    			$setari->type = "marca";
    			$setari->value = $request->marca;
    			$setari->save();
    			
    			$setari = new Setari;
    			$setari->userId = $user->id;
    			$setari->type = "judet";
    			$setari->value = $request->judet;
    			$setari->save();
    			
    			$setari = new Setari;
    			$setari->userId = $user->id;
    			$setari->type = "localitate";
    			$setari->value = $request->localitate;
    			$setari->save();
    		
    			Session::flash('message2', 'S-a salvat cu succes!');
    			return redirect('/setari');
    		}
    	}
    	
    	// salvare contoare
    	if(isset($request->salveaza_contoare)){
    		$validator = Validator::make($request->all(), [
    				'nrBorderouDecont' => 'required',
    				'nrBorderouInsotitor' => 'required'
    		]);
    		
    		if ($validator->fails()) {
    			return redirect('/setari')
    			->withInput()
    			->withErrors($validator);
    		}else{
    			// softDelete la valorile vechi
    			$del = Setari::find($request->id_nrBorderouDecont); if($del){ $del->delete(); }
    			$del = Setari::find($request->id_nrBorderouInsotitor); if($del){ $del->delete(); }
    			 
    			// salveaza valorile noi
    			$setari = new Setari;
    			$setari->userId = $user->id;
    			$setari->type = "nrBorderouDecont";
    			$setari->value = $request->nrBorderouDecont;
    			$setari->save();
    			 
    			$setari = new Setari;
    			$setari->userId = $user->id;
    			$setari->type = "nrBorderouInsotitor";
    			$setari->value = $request->nrBorderouInsotitor;
    			$setari->save();
    			 
    			Session::flash('message3', 'S-a salvat cu succes!');
    			return redirect('/setari');
    		}
    	}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Setari::findOrFail($id)->delete();
        Session::flash('message', 'Aparatul selectat s-a sters cu succes!');
		return redirect('/setari');
    }
}
