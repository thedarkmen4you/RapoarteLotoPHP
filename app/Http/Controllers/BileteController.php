<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bilete;
use App\Setari;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BileteController extends Controller
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
        return view('bilete/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$user = Auth::user();
        return view('bilete/create', [
	        'bilete' => Bilete::where('userId', '=', $user->id)->orderBy('created_at', 'desc')->with('setari')->get(),
        	'aparate' => Setari::where([['type', '=', 'aparate'],['userId', '=', $user->id]])->whereNull('deleted_at')->get()
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
        	'bilet' => 'required|numeric',
        	'crc' => 'required|numeric',
        	'castigBrut' => 'required|numeric',
		]);
	
		if ($validator->fails()) {
			return redirect('/contacts/create')
			->withInput()
			->withErrors($validator);
		}else{
			$bilet = new Bilete;
		    $bilet->userId = $user->id;
		    $bilet->data = $request->data;
		    $bilet->aparat = $request->aparat;
		    $bilet->bilet = $request->bilet;
		    $bilet->crc = $request->crc;
		    $bilet->castigBrut = $request->castigBrut;
		    $bilet->save();
		
		    Session::flash('message', 'S-a salvat cu succes!');
		    return redirect('/bilete/create');
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
        return view('bilete/create', [
        	'bilet' => Bilete::findOrFail($id),
	        'bilete' => Bilete::where('userId', '=', $user->id)->orderBy('created_at', 'desc')->get(),
        	'aparate' => Setari::where([['type', '=', 'aparate'],['userId', '=', $user->id]])->whereNull('deleted_at')->get()
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
        	'bilet' => 'required|numeric',
        	'crc' => 'required|numeric',
        	'castigBrut' => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('bilete/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            // store
            $bilet = Bilete::find($id);
		    $bilet->data = $request->data;
		    $bilet->aparat = $request->aparat;
		    $bilet->bilet = $request->bilet;
		    $bilet->crc = $request->crc;
		    $bilet->castigBrut = $request->castigBrut;
		    $bilet->save();

            // redirect
            Session::flash('message', 'S-a salvat cu succes!');
            return Redirect::to('bilete/create');
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
       	Bilete::findOrFail($id)->delete();
        Session::flash('message', 'Biletul s-a sters cu succes!');
		return redirect('/bilete/create');
    }
}
