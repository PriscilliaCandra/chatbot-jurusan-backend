<?php

namespace App\Http\Controllers;

use App\Models\ChatHistory;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ChatBotController extends Controller
{
    public function ask(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $msg = $request->input('message');
        // Jika mau gunakan user login, aktifkan ini:
        // $userId = auth()->id();
        $userId = 1; 

        // Simpan pesan user ke chat history
        ChatHistory::create([
            'user_id' => $userId,
            'sender' => 'user',
            'message' => $msg,
        ]);

        // Setup cURL untuk request ke Ollama API (local server)
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'http://localhost:11434/api/generate');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        $postData = json_encode([
            'model' => 'tinyllama', 
            'prompt' => $msg,
            'stream' => false, 
        ]);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        $response = curl_exec($ch);

        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            $reply = "Curl Error: " . $error;
        } else {
            curl_close($ch);

            $data = json_decode($response, true);
            // Asumsikan balasan ada di key 'response'
            $reply = $data['response'] ?? 'Tidak ada jawaban dari Ollama.';
        }

        // Simpan balasan bot ke chat history
        ChatHistory::create([
            'user_id' => $userId,
            'sender' => 'bot',
            'message' => $reply,
        ]);

        // Kembalikan balasan ke frontend
        return response()->json([
            'reply' => $reply,
        ]);
    }
}
