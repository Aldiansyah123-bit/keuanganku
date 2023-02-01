<?php

namespace App\Http\Controllers;

use App\Http\Resources\PengeluaranResource;
use App\Models\Pengeluaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pengeluaran::orderBy('id','DESC')->get();
        return view('admin.pengeluaran.index', compact('data'));
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
        $leng   = 8;
        $random = '';
        for ($i=0; $i < $leng; $i++) {
            $random .= rand(0, 1) ? rand(0,7) : chr(rand(ord('a'), ord('z')));
        }

        $code = 'PNR-'.Str::upper($random);

        $data = Pengeluaran::create([
            'code'        => $code,
            'qty'         => $request->qty,
            'description' => $request->description,
        ]);

        if ($data instanceof Model) {
            toastr()->success('Data Successfully');

            return redirect()->route('pengeluaran.index');
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
        Pengeluaran::findOrFail($id)->update([
            'qty'         => $request->qty,
            'description' => $request->description,
        ]);

        toastr()->success('Data Update Successfully');

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
        Pengeluaran::destroy($id);

        toastr()->success('Data Successfully');

        return back();
    }
}
