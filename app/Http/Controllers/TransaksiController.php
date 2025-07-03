<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        return response()->json(Transaksi::all());
    }

    public function show(Transaksi $transaction)
    {
        return response()->json($transaction);
    }

    public function store(Request $request)
    {
        $transaction = Transaksi::create($request->all());
        return response()->json($transaction, 201);
    }

    public function update(Request $request, Transaksi $transaction)
    {
        $transaction->update($request->all());
        return response()->json($transaction);
    }

    public function destroy(Transaksi $transaction)
    {
        $transaction->delete();
        return response()->json(null, 204);
    }

    // Add tax CRUD operations
    public function addTax(Request $request, Transaksi $transaction)
    {
        $transaction->update(['pajak' => $request->pajak]);
        return response()->json($transaction);
    }
}
