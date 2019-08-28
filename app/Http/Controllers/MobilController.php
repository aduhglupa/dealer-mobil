<?php

namespace App\Http\Controllers;

use App\Http\Requests\MobilRequest;
use App\Mobil;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class MobilController extends Controller
{
    public function index (Request $request)
    {
        if ($request->isMethod('post')) {
            $mobils = Mobil::select(['*'])
                ->where('is_active', 1);

            /** @var \Yajra\Datatables\Engines\EloquentEngine $datatables */
            $datatables = Datatables::of($mobils);
            return $datatables
                ->addColumn('action', function ($model) {
                    return link_to("mobil/edit/$model->id", 'Ubah', ['class' => 'btn btn-primary btn-xs', 'target' => '_blank']);
                })
                ->editColumn('harga', function ($model) {
                    return 'Rp.' . number_format($model->harga, 0);
                })
                ->make(true);
        }
        return view('mobils.index');
    }

    public function create ()
    {
        return view('mobils.create');
    }

    public function store (MobilRequest $request)
    {
        Mobil::create($request->all());
        return redirect('mobil')->with('success', 'Berhasil menambah mobil');
    }

    public function edit ($id)
    {
        $mobil = Mobil::findOrFail($id);
        if ($mobil->is_active == 0) {
            return redirect('mobil')->with('error', 'Tidak dapat menemukan mobil');
        }
        return view('mobils.edit', get_defined_vars());
    }

    public function update (MobilRequest $request, $id)
    {
        /** @var \App\Mobil $mobil */
        $mobil = Mobil::findOrFail($id);
        $mobil->update($request->all());
        return back()->with('success', 'Berhasil mengubah data');
    }

    public function destroy ($id)
    {
        $mobil = Mobil::findOrFail($id);
        $mobil->update([
            'is_active' => 0
        ]);
        return \Response::json(['redirect' => url('mobil')]);
    }
}
