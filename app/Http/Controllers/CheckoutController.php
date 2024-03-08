<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('barang')->get();
        return response()->json(['data' => $transactions], 200);
    }
    public function show($id)
    {
        $transaction = Transaction::with('barang')->findOrFail($id);
        return response()->json(['data' => $transaction], 200);
    }

    public function process(Request $request)
    {
        $data = $request->all();

        $transaction = Transaction::create([
            'product_id' => $data['product_id'],
            'price' => $data['price'],
            'status' => 'pending',
        ]);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $data['price'],
            ),
            'customer_details' => array(
                'first_name' => 'Naufal Puji Mahdy',
                'email' => 'naufalpm230800@gmail.com'
            )
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $transaction->snap_token = $snapToken;
        $transaction->save();

        return response()->json(['message' => 'Silahkan melakukan pembayaran sekarang', 'data' => $transaction], 201);
    }

    public function success(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $data = [
            'status' => $request->status,
        ];

        $transaction->update($data);

        return response()->json(['message' => 'Pembayaran berhasil dilakukan', 'data' => $transaction], 200);
    }
}
