<?php

namespace App\Http\Controllers;

use Validator;
use App\Master;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $masters = Master::all();
        $masters = Master::orderBy('surname')->get();

        return view('master.index', ['masters' => $masters]);
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),
        [
            'master_name' => ['required', 'min:3', 'max:64'],
            'master_surname' => ['required', 'min:3', 'max:64'],
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $master = new Master;
        $master->name = $request->master_name;
        $master->surname = $request->master_surname;
        $master->logo = '';
        
        if ($request->hasFile('master_logo')) {
            $image = $request->file('master_logo');
            $name = time().'.'.$image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $master->logo = $name;
        }

        
        $master->save();
        return redirect()->route('master.index')->with('success_message', 'Sekmingai įrašytas.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function show(Master $master)
    {
        return view('master.show', ['master' => $master]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function edit(Master $master)
    {
        return view('master.edit', ['master' => $master]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Master $master)
    {

        $validator = Validator::make($request->all(),
        [
            'master_name' => ['required', 'min:3', 'max:64'],
            'master_surname' => ['required', 'min:3', 'max:64'],
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $master->name = $request->master_name;
        $master->surname = $request->master_surname;
        $master->logo = '';
        
        if ($request->hasFile('master_logo')) {
            $image = $request->file('master_logo');
            $name = time().'.'.$image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $master->logo = $name;
        }
        
        $master->save();
        return redirect()->route('master.index')->with('success_message', 'Sėkmingai pakeistas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function destroy(Master $master)
    {
        if($master->masterOutfits->count()){
            return redirect()->route('master.index')->with('info_message', 'Trinti negalima, nes turi rubų.');
        }
        $master->delete();
        return redirect()->route('master.index')->with('success_message', 'Sekmingai ištrintas.');
    }
}
