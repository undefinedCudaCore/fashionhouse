<?php

namespace App\Http\Controllers;

use Validator;
use App\Master;
use App\Outfit;
use Illuminate\Http\Request;

class OutfitController extends Controller
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
        $masters = Master::all();
        $selectId = 0;
        $sort = '';

        if ($request->master_id) {

            if ($request->sort) {
                if ($request->sort == 'type') {
                    $outfits = Outfit::where('master_id', $request->master_id)->orderBy('type')->get();
                    $sort = 'type';
                } elseif ($request->sort == 'color') {
                    $outfits = Outfit::where('master_id', $request->master_id)->orderBy('color')->get();
                    $sort = 'color';
                } else {
                    $outfits = Outfit::all();
                }
            } else {
                $outfits = Outfit::where('master_id', $request->master_id)->get();
            }

            $selectId = $request->master_id;
        } else {
            
            if ($request->sort) {
                if ($request->sort == 'type') {
                    $outfits = Outfit::orderBy('type')->get();
                    $sort = 'type';
                } elseif ($request->sort == 'color') {
                    $outfits = Outfit::orderBy('color')->get();
                    $sort = 'color';
                } else {
                    $outfits = Outfit::all();
                }
            } else {
                $outfits = Outfit::all();
            }
        }
        return view('outfit.index', compact('outfits','masters', 'selectId', 'sort'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $masters = Master::all();
        return view('outfit.create', ['masters' => $masters]);
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
            'outfit_type' => ['required', 'min:3', 'max:50'],
            'outfit_color' => ['required', 'min:3', 'max:20'],
            'outfit_size' => ['required', 'integer'],
            'outfit_about' => ['required', 'min:3', 'max:200'],
            'master_id' => ['required']
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $outfit = new Outfit;
        $outfit->type = $request->outfit_type;
        $outfit->color = $request->outfit_color;
        $outfit->size = $request->outfit_size;
        $outfit->about = $request->outfit_about;
        $outfit->master_id = $request->master_id;
        $outfit->save();
        return redirect()->route('outfit.index')->with('success_message', 'Sekmingai įrašytas.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function show(Outfit $outfit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function edit(Outfit $outfit)
    {
        $masters = Master::all();
        return view('outfit.edit', ['outfit' => $outfit, 'masters' => $masters]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outfit $outfit)
    {
       $outfit->type = $request->outfit_type;
       $outfit->color = $request->outfit_color;
       $outfit->size = $request->outfit_size;
       $outfit->about = $request->outfit_about;
       $outfit->master_id = $request->master_id;
       $outfit->save();
       return redirect()->route('outfit.index')->with('success_message', 'Sėkmingai pakeistas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outfit $outfit)
    {
        $outfit->delete();
        return redirect()->route('outfit.index')->with('success_message', 'Sekmingai ištrintas.');
    }
}
