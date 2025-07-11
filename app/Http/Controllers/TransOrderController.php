<?php

namespace App\Http\Controllers;

use App\Models\TransOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Customers;
use App\Models\TypeOfServices;
use App\Models\TransDetails;
use Midtrans\Config;
use Midtrans\Snap;

class TransOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function index()
    {
        $title = "Transaksi Order";
        $datas = TransOrders::with('customer')->orderBy('id', 'desc')->get();
        return view('trans.index', compact('title', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //TR-01072025-01
        $today = Carbon::now()->format('dmY');
        $countDay = TransOrders::whereDate('created_at', now()->toDateString())->count() + 1;
        $runningNumber = str_pad($countDay, 3, '0', STR_PAD_LEFT);
        $title = "Tambah Transaksi";
        $orderCode = "TR-" . $today . "-" . $runningNumber;

        $customers = Customers::orderBy('id', 'desc')->get();
        $services = TypeOfServices::orderBy('id', 'desc')->get();
        return view('trans.create', compact('title', 'orderCode', 'customers', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_end_date' => 'required'
        ]);

        $transOrder = TransOrders::create([
            'id_customer' => $request->id_customer,
            'order_code' => $request->order_code,
            'order_end_date' => $request->order_end_date,
            'total' => $request->grand_total,
        ]);

        foreach ($request->id_service as $key => $idService) {
            $id_trans = $transOrder->id;
            TransDetails::create([
                'id_trans' => $id_trans,
                'id_service' => $idService,
                'qty' => $request->qty[$key],
                'subtotal' => $request->total[$key]
            ]);
        }
        alert()->success('Tambah Berhasil', 'Data Berhasil Ditambah');
        return redirect()->route('trans.index')->with('status', 'berhsil');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = "Detail Transaksi";
        $details = TransOrders::with(['customer', 'details.service'])->where('id', $id)->first();
        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => 10.000,
            ],
            'customer_details' => [
                'first_name' => "Agus",
                'last_name' => "Rojali",
                'email' => "agus@gmail.com",
                'phone' => "08123456789",
            ],
        ];
        // $snapToken = Snap::getSnapToken($params);
        $snapToken = Snap::createTransaction($params);
        return view('trans.show', compact('title', 'details', 'snapToken'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transOrder = TransOrders::find($id);
        $transOrder->order_status = 1;
        $transOrder->order_pay = $request->order_pay;
        $transOrder->order_change = $request->order_change;
        $transOrder->save();
        alert()->success('Ubah Berhasil', 'Data Berhasil Diubah');
        return redirect()->to('trans')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = TransOrders::find($id);
        $user->delete();
        alert()->success('Hapus Berhasil', 'Data Berhasil Ditambah');
        return redirect()->to('trans')->with('success', 'Data Berhasil Dihapus');
    }

    public function printStruk(string $id)
    {
        $details = TransOrders::with(['customer', 'details.service'])->where('id', $id)->first();
        return view('trans.print', compact('details'));
    }

    public function snap(Request $request, $id)
    {
        $order = TransOrders::with(['details', 'customer'])->findOrFail($id);
        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $order->total,
            ],
            'customer_details' => [
                'first_name' => $order->customer->name ?? 'Umum',
                'email' => $order->customer->email ?? 'dummy@email.com',
            ],
        ];
        $snap = Snap::createTransaction($params);
        return response()->json(['token' => $snap->token]);
    }
}
