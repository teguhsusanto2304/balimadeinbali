<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
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
        $datas = Supplier::all();
        return view('suppliers.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Supplier $supplier)
    {
        $data = $supplier;
        return view('suppliers.form',compact('data'));
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
            'supplier_name' => 'required|min:3|max:100',
            'kontaks' => 'required|min:10|max:100',
            'phone_number' => 'required|max:15',
        ],[
            'kontaks.required'=>'The contact field is required.',
            'kontaks.min' => 'the contact must be at least 10 characters',
            'kontaks.max' => 'the contact must be at greater than 100 characters',
        ]);
        $request['data_status'] = ($request['data_status']==null?0:1);
        Supplier::create($request->all());
        return redirect()->route('suppliers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return view('suppliers.form',compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $data = $supplier;
        return view('suppliers.form',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'supplier_name' => 'required|min:3|max:100',
            'kontaks' => 'required|min:10|max:100',
            'phone_number' => 'required|max:15',
        ],[
            'kontaks.required'=>'The contact field is required.',
            'kontaks.min' => 'the contact must be at least 10 characters',
            'kontaks.max' => 'the contact must be at greater than 100 characters',
        ]);
        $request['data_status'] = ($request['data_status']==null?0:1);
        $supplier->update($request->all());
        return redirect()->route('suppliers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
