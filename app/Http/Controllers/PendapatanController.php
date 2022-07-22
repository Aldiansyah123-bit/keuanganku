<?php

namespace App\Http\Controllers;

use App\Models\Pendapatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PendapatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pendapatan::orderBy('id','DESC')->get();
        return view('admin.pendapatan.index', compact('data'));
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
        $leng   = 9;
        $random = '';

        for ($i=0; $i < $leng; $i++) {
            $random .= rand(0, 1) ? rand(0, 7) : chr(rand(ord('a'), ord('z')));
        }

        $code = 'PDN-'.Str::upper($random);

        $data = Pendapatan::create([
            'code'          => $code,
            'qty'           => $request->qty,
            'description'   => $request->description,
        ]);

        if ($data instanceof Model) {
            toastr()->success('Data Successfully');

            return redirect()->route('pendapatan.index');
        }

        toastr()->error('Data Invalid');

        return back();
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
        Pendapatan::findOrFail($id)->update([
            'qty'           => $request->qty,
            'description'   => $request->description,
        ]);

        toastr()->success('Data Successfully');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pendapatan::destroy($id);

        toastr()->success('Data Successfully');

        return back();
    }
}
