@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-semibold mb-4">Transaksi</h2>

<table class="min-w-full table-auto">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2 text-left">ID</th>
            <th class="px-4 py-2 text-left">Hotel/Restoran</th>
            <th class="px-4 py-2 text-left">Peternak Babi</th>
            <th class="px-4 py-2 text-left">Produk</th>
            <th class="px-4 py-2 text-left">Jumlah</th>
            <th class="px-4 py-2 text-left">Total Harga</th>
            <th class="px-4 py-2 text-left">Status</th>
            <th class="px-4 py-2 text-left">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($TransaksiController as $transaction)
        <tr>
            <td class="border px-4 py-2">{{ $transaction->id }}</td>
            <td class="border px-4 py-2">{{ $transaction->hotelRestoran->name }}</td>
            <td class="border px-4 py-2">{{ $transaction->peternakBabi->name }}</td>
            <td class="border px-4 py-2">{{ $transaction->produk->name }}</td>
            <td class="border px-4 py-2">{{ $transaction->jumlah }}</td>
            <td class="border px-4 py-2">{{ $transaction->total_harga }}</td>
            <td class="border px-4 py-2">{{ $transaction->status }}</td>
            <td class="border px-4 py-2">
                <a href="{{ route(TransaksiController.show', $transaction->id) }}" class="text-blue-500 hover:text-blue-700">Detail</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
