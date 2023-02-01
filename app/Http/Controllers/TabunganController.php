<?php

namespace App\Http\Controllers;

use App\Models\Tabungan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TabunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'data' => Tabungan::orderBy('id', 'DESC')->get(),
            'total'=> Tabungan::sum('qty')
        ];

        return view('admin.tabungan.index', $data);
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

        $code = 'TBN-'.Str::upper($random);

        $data = Tabungan::create([
            'code'        => $code,
            'qty'         => $request->qty,
            'description' => $request->description,
        ]);

        if ($data instanceof Model) {
            toastr()->success('Data Successfully');

            return redirect()->route('tabungan.index');
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
        Tabungan::findOrFail($id)->update([
            'qty'         => $request->qty,
            'description' => $request->description,
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
        Tabungan::destroy($id);

        toastr()->success('Data Successfully');

        return back();
    }
}
