<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenjualanRequest;
use App\Mail\PenjualanMail;
use App\Mobil;
use App\Penjualan;
use DB;
use Illuminate\Http\Request;
use Mail;
use Yajra\Datatables\Datatables;

class PenjualanController extends Controller
{
    public function index (Request $request)
    {
        if ($request->isMethod('post')) {
            $penjualans = Penjualan::leftJoin('penjualan_details AS a', 'a.penjualan_id', '=', 'penjualans.id')
                ->leftJoin('mobils AS b', 'b.id', '=', 'a.mobil_id')
                ->groupBy('penjualans.id')
                ->select([
                    'penjualans.*',
                    DB::raw('GROUP_CONCAT(CONCAT(b.nama, "(", a.jumlah, ")") SEPARATOR "|") AS detail_penjualan')
                ]);

            /** @var \Yajra\Datatables\Engines\EloquentEngine $datatables */
            $datatables = Datatables::of($penjualans);
            return $datatables
                ->editColumn('detail_penjualan', function ($model) {
                    $explode = explode('|', $model->detail_penjualan);
                    $html = '<ul>';
                    foreach ($explode as $item) {
                        $html .= "<li>{$item}</li>";
                    }
                    $html .= '</ul>';
                    return $html;
                })
                ->escapeColumns(false)
                ->make(true);
        }
        return view('penjualans.index');
    }

    public function create ()
    {
        return view('penjualans.create');
    }

    public function store (PenjualanRequest $request)
    {
//        dd($request->all());
        try {
            DB::beginTransaction();
            $penjualan = Penjualan::create($request->except('details'));
            foreach ($request->details as $detail) {
                $penjualan->details()->create([
                    'mobil_id' => $detail['mobil_id'],
                    'jumlah' => intval($detail['jumlah']),
                    'harga' => intval($detail['harga']),
                    'subtotal' => intval($detail['subtotal'])
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', $e->getMessage());
        }
        try {
            // Send email
            Mail::to($penjualan->email_pembeli)->send(new PenjualanMail($penjualan));

            // Send Chat Api
            $message = "Terima kasih Pak/Bu {$penjualan->nama_pembeli}, anda telah membeli mobil dari kami\nBerikut rincian Pembelian:\n";
            foreach ($penjualan->details as $detail) {
                $message .= "{$detail->mobil->nama}: {$detail->jumlah} x Rp." . number_format($detail->harga) . " = Rp." . number_format($detail->subtotal) . "\n";
            }

            $client = new \GuzzleHttp\Client();
            $phoneNumber = '62' . preg_replace('/^0+/', '', $penjualan->telp_pembeli);
            $response = $client->request('post', env('CHAT_API_URL'), [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ],
                'json' => [
                    'phone' => $phoneNumber,
                    'body' => $message
                ]
            ]);
        } catch (\Exception $e) {

        }
        return redirect('penjualan')->with('success', 'Penjualan berhasil dibuat');
    }

    public function getMobil (Request $request)
    {
//        dd($request->all());
        $mobils = Mobil::where('is_active', 1)
            ->whereRaw("nama LIKE '%{$request->q}%'")
            ->select([
                'id',
                'id AS mobil_id',
                'nama AS text',
                'nama AS nama_mobil',
                'harga'
            ])
            ->get();
        return [
            'results' => $mobils->toArray()
        ];
    }
}
