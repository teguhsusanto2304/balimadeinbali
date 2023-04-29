<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proofing;

class ProofingController extends Controller
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
        $datas = Proofing::all();
        return view('proofings.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(\App\Models\Proofing $proofing)
    {
        $data = $proofing;
        $suppliers = (new \App\Models\Supplier)::pluck('supplier_name','id');
        $suppliers->prepend('Choose Supplier',null);
        return view('proofings.form',compact('data','suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required',
            'purpose_at' => 'required',
            'proofing_at' => 'required',
            'proof_image' => 'required',
            'description'=>'nullable|min:10'
        ],[
            'supplier_id.required'=>'The supplier can not empty',
            'purpose_at.required' => 'the purpose at can not empty',
            'proofing_at.required' => 'the proofing at can not empty',
            'proof_image.required' => 'the proofing file can not empty',
            'description.min'=>'The description must be at least 10 characters.'
        ]);
		$file = $request->file('proof_image');
        $request['path_image'] = './images/proofings/'.$file->getClientOriginalName();
        $tujuan_upload = 'images/proofings';
        $file->move($tujuan_upload,$file->getClientOriginalName());        
        $request['data_status'] = ($request['data_status']==null?0:1);
        (new \App\Models\Proofing)::create($request->all());
        return redirect()->route('proofings.index');
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
    public function edit(\App\Models\Proofing $proofing)
    {
        $data = $proofing;
        $suppliers = (new \App\Models\Supplier)::pluck('supplier_name','id');
        $suppliers->prepend('Choose Supplier',null);
        return view('proofings.form_update',compact('data','suppliers'));
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
        //
    }
}
