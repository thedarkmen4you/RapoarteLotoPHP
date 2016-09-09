<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContoareMecanice;
use App\Setari;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ContoareMecaniceController extends Controller
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
    	return view('contoareMecanice/create', [
    			'p_aparate' => Setari::where([['type', '=', 'aparate'],['userId', '=', $user->id]])->whereNull('deleted_at')->get(),
    			'p_date' => ContoareMecanice::where('userId', '=', $user->id)->with('setari')->get(),
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
        	'in' => 'required|numeric',
        	'out' => 'required|numeric',
        	'bet' => 'required|numeric',
		]);
	
		if ($validator->fails()) {
			return redirect('/contoare_electronice/create')
			->withInput()
			->withErrors($validator);
		}else{
			$contor = new ContoareMecanice;
		    $contor->userId = $user->id;
		    $contor->data = $request->data;
		    $contor->aparat = $request->aparat;
		    $contor->in = $request->in;
		    $contor->out = $request->out;
		    $contor->bet = $request->bet;
		    $contor->win = $request->win;
		    $contor->games = $request->games;
		    $contor->remonte = $request->remonte;
		    $contor->handPay = $request->handPay;
		    $contor->bills = $request->bills;
		    $contor->save();
		
		    Session::flash('message', 'S-a salvat cu succes!');
		    return redirect('/contoare_mecanice/create');
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
        return view('contoareMecanice/create', [
        	'contor' => ContoareMecanice::findOrFail($id),
	        'p_aparate' => Setari::where([['type', '=', 'aparate'],['userId', '=', $user->id]])->whereNull('deleted_at')->get(),
    		'p_date' => ContoareMecanice::where('userId', '=', $user->id)->get(),
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
        	'in' => 'required|numeric',
        	'out' => 'required|numeric',
        	'bet' => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('contoare_electronice/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            // store
            $contor = ContoareMecanice::find($id);
		    $contor->data = $request->data;
		    $contor->aparat = $request->aparat;
		    $contor->in = $request->in;
		    $contor->out = $request->out;
		    $contor->bet = $request->bet;
		    $contor->win = $request->win;
		    $contor->games = $request->games;
		    $contor->remonte = $request->remonte;
		    $contor->handPay = $request->handPay;
		    $contor->bills = $request->bills;
		    $contor->save();

            // redirect
            Session::flash('message', 'S-a salvat cu succes!');
            return Redirect::to('contoare_mecanice/create');
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
        ContoareMecanice::findOrFail($id)->delete();
        Session::flash('message', 'Inregistrarea s-a sters cu succes!');
		return redirect('/contoare_mecanice/create');
    }
}
