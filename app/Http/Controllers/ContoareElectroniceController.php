<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setari;
use App\ContoareElectronice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class ContoareElectroniceController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
    	return view('contoareElectronice/create', [
    			'p_aparate' => Setari::where([['type', '=', 'aparate'],['userId', '=', $user->id]])->whereNull('deleted_at')->get(),
    			'p_date' => ContoareElectronice::where('userId', '=', $user->id)->with('setari')->get(),
//     			'p_date' => \DB::table('contoare_electronice') 
//     							->join('setari', 'setari.id', '=', 'contoare_electronice.aparat')
//     							->select('contoare_electronice.id', 'contoare_electronice.data', 'setari.value as aparat', 'contoare_electronice.indexInceput', 'contoare_electronice.indexSfarsit', 'contoare_electronice.totalImpulsuri', 'contoare_electronice.pretImpuls', 'contoare_electronice.valoareIncasari')
//     							->where('contoare_electronice.userId', '=', $user->id)
//     						->get(),
    		]);
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
    	
    	$validator = Validator::make($request->all(), [
			'data' => 'required',
        	'aparat' => 'required',
        	'indexInceput' => 'required|numeric',
        	'indexSfarsit' => 'required|numeric',
        	'pretImpuls' => 'required|numeric',
		]);
	
		if ($validator->fails()) {
			return redirect('/contoare_electronice/create')
			->withInput()
			->withErrors($validator);
		}else{
			$contor = new ContoareElectronice;
		    $contor->userId = $user->id;
		    $contor->data = $request->data;
		    $contor->aparat = $request->aparat;
		    $contor->indexInceput = $request->indexInceput;
		    $contor->indexSfarsit = $request->indexSfarsit;
		    $contor->totalImpulsuri = $request->indexSfarsit-$request->indexInceput;
		    $contor->pretImpuls = $request->pretImpuls;
		    $contor->valoareIncasari = ($request->indexSfarsit-$request->indexInceput)*$request->pretImpuls;
		    $contor->save();
		
		    Session::flash('message', 'S-a salvat cu succes!');
		    return redirect('/contoare_electronice/create');
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
        $user = Auth::user();
        return view('contoareElectronice/create', [
        	'contor' => ContoareElectronice::findOrFail($id),
	        'p_aparate' => Setari::where([['type', '=', 'aparate'],['userId', '=', $user->id]])->whereNull('deleted_at')->get(),
    		'p_date' => ContoareElectronice::where('userId', '=', $user->id)->get(),
	    ]);
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
    	$rules = array(
            'data' => 'required',
        	'aparat' => 'required',
        	'indexInceput' => 'required|numeric',
        	'indexSfarsit' => 'required|numeric',
        	'pretImpuls' => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('contoare_electronice/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            // store
            $contor = ContoareElectronice::find($id);
		    $contor->data = $request->data;
		    $contor->aparat = $request->aparat;
		    $contor->indexInceput = $request->indexInceput;
		    $contor->indexSfarsit = $request->indexSfarsit;
		    $contor->totalImpulsuri = $request->indexSfarsit-$request->indexInceput;
		    $contor->pretImpuls = $request->pretImpuls;
		    $contor->valoareIncasari = ($request->indexSfarsit-$request->indexInceput)*$request->pretImpuls;
		    $contor->save();

            // redirect
            Session::flash('message', 'S-a salvat cu succes!');
            return Redirect::to('contoare_electronice/create');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ContoareElectronice::findOrFail($id)->delete();
        Session::flash('message', 'Inregistrarea s-a sters cu succes!');
		return redirect('/contoare_electronice/create');
    }
}
