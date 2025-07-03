<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    // Tampilkan semua data income
    public function index()
    {
        $incomes = Income::all();
        return response()->json($incomes);
    }

    // Tampilkan form create (opsional, biasanya untuk web)
    public function create()
    {
        // Jika menggunakan API, biasanya tidak perlu
        return response()->json(['message' => 'Show create form']);
    }

    // Simpan data income baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string',
            // tambahkan validasi lain sesuai kebutuhan
        ]);

        $income = Income::create($validated);
        return response()->json($income, 201);
    }

    // Tampilkan detail income tertentu
    public function show(Income $income)
    {
        return response()->json($income);
    }

    // Tampilkan form edit (opsional, biasanya untuk web)
    public function edit(Income $income)
    {
        // Jika menggunakan API, biasanya tidak perlu
        return response()->json($income);
    }

    // Update data income
    public function update(Request $request, Income $income)
    {
        $validated = $request->validate([
            'amount' => 'sometimes|required|numeric',
            'description' => 'sometimes|required|string',
            // tambahkan validasi lain sesuai kebutuhan
        ]);

        $income->update($validated);
        return response()->json($income);
    }

    // Hapus data income
    public function destroy(Income $income)
    {
        $income->delete();
        return response()->json(['message' => 'Income deleted']);
    }
}
