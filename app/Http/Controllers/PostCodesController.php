<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostCode;
use Auth;

class PostCodesController extends Controller
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
    public function index()
    {
        $postcodes = PostCode::where('account_id', Auth::user()->account_id)->orderBy('created_at', 'DESC')->get();
        return view('postcodes.index')->with('postcodes', $postcodes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('postcodes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $products = new PostCode();
        $products->account_id = Auth::user()->account_id;
        $products->user_id = Auth::user()->id;
        $products->name = $request->input('name');
        $products->boiler = $request->has('boiler');
        $products->quotes = $request->has('quotes');
        $products->save();


        return redirect('/postcodes')->with("success", "Postcode added successfully !");
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
        $postCode = PostCode::find($id);
        return view('postcodes.edit')->with('postCode', $postCode);
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
        $this->validate($request, [
            'name' => 'required'
        ]);

        $products = PostCode::whereId($id)->first();
        $products->account_id = Auth::user()->account_id;
        $products->user_id = Auth::user()->id;
        $products->name = $request->input('name');
        $products->boiler = $request->has('boiler');
        $products->quotes = $request->has('quotes');
        $products->save();


        return redirect('/postcodes')->with("success", "Postcode updated successfully !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        PostCode::whereId($id)->delete();
        return redirect('/postcodes')->with("success", "Postcode deleted successfully !");
    }
}
