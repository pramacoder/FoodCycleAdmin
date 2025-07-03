<?php

namespace App\Http\Controllers;

use App\Models\notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NotifikasiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'judul' => 'required',
            'isi' => 'required',
        ]);

        $notification = Notifikasi::create($request->all());

        // Send Firebase notification
        $this->sendNotificationToFirebase($request->judul, $request->isi);

        return response()->json($notification, 201);
    }

    // Send notification to Firebase
    private function sendNotificationToFirebase($title, $message)
    {
        $firebaseApiUrl = 'https://fcm.googleapis.com/fcm/send';
        $serverKey = 'YOUR_FIREBASE_SERVER_KEY';

        $data = [
            'to' => '/topics/all', // Send to all users or a specific topic
            'notification' => [
                'title' => $title,
                'body' => $message,
            ],
        ];

        Http::withHeaders([
            'Authorization' => 'key=' . $serverKey,
            'Content-Type' => 'application/json',
        ])->post($firebaseApiUrl, $data);
    }
}
