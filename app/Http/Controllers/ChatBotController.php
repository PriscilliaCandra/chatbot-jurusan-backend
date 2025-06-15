<?php

namespace App\Http\Controllers;

use App\Models\ChatbotQuestion;
use App\Models\ChatHistory;
use App\Models\UserResult;
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
        $userId = auth()->id();

        // Simpan pesan user
        ChatHistory::create([
            'user_id' => $userId,
            'sender' => 'user',
            'message' => $msg,
        ]);

        // Ambil hasil tes kepribadian user
        $userResult = UserResult::where('user_id', $userId)
            ->latest()
            ->first();

        if (!$userResult) {
            $reply = "Anda belum melakukan tes kepribadian. Silakan lakukan tes kepribadian terlebih dahulu untuk mendapatkan rekomendasi yang sesuai.";
            
            ChatHistory::create([
                'user_id' => $userId,
                'sender' => 'bot',
                'message' => $reply,
            ]);

            return response()->json([
                'reply' => $reply,
                'needs_personality_test' => true
            ]);
        }

        // Dapatkan tipe kepribadian dominan
        $personalityTypes = $this->getDominantPersonalityTypes($userResult);
        
        // Prepare prompt with personality context
        $personalityContext = implode(' dan ', array_keys($personalityTypes));
        $prompt = "Anda adalah asisten chatbot yang membantu memberikan informasi dan saran tentang perkuliahan. 
                  User memiliki tipe kepribadian {$personalityContext}. 
                  
                  INSTRUKSI BAHASA:
                  1. SELALU gunakan Bahasa Indonesia yang baik dan benar
                  2. Gunakan bahasa yang mudah dipahami
                  3. Hindari penggunaan bahasa asing
                  4. Gunakan istilah yang umum digunakan di Indonesia
                  
                  INSTRUKSI JAWABAN:
                  1. Berikan jawaban yang JELAS, SINGKAT, dan LANGSUNG ke inti pertanyaan
                  2. Sesuaikan jawaban dengan tipe kepribadian user
                  3. Fokus pada informasi yang berguna dan praktis
                  4. JANGAN memberikan jawaban yang bertele-tele atau tidak relevan
                  
                  KARAKTERISTIK TIPE KEPRIBADIAN:
                  - Logis: 
                    * Suka dengan angka, analisis, dan pemecahan masalah
                    * Belajar efektif melalui: latihan soal, praktikum, proyek sistematis
                    * Cocok dengan: jurusan teknik, sains, komputer, ekonomi
                    * Tips belajar: buat jadwal terstruktur, fokus pada pemahaman konsep
                  
                  - Strategis:
                    * Suka dengan perencanaan dan manajemen
                    * Belajar efektif melalui: studi kasus, simulasi, proyek manajemen
                    * Cocok dengan: jurusan manajemen, bisnis, administrasi
                    * Tips belajar: buat rencana jangka panjang, evaluasi berkala
                  
                  PERTANYAAN USER: {$msg}
                  
                  JAWABAN ANDA HARUS:
                  1. Langsung menjawab pertanyaan user dalam Bahasa Indonesia
                  2. Sesuaikan dengan tipe kepribadian {$personalityContext}
                  3. Berikan contoh konkret dan praktis
                  4. Maksimal 3-4 paragraf
                  5. Gunakan bahasa yang mudah dipahami dan formal";

        // Setup cURL untuk streaming
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'http://localhost:11434/api/generate');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120); 
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); // Set connection timeout 10 detik

        // JSON payload dengan streaming aktif
        $postData = json_encode([
            'model' => 'zephyr:7b-beta',
            'prompt' => $prompt,
            'stream' => true,
            'temperature' => 0.7,
            'max_tokens' => 1000
        ]);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        // Log request untuk debugging
        \Log::info('Sending request to Zephyr API', [
            'prompt' => $prompt,
            'postData' => $postData
        ]);

        // Eksekusi cURL dan simpan stream ke dalam satu string
        $fullResponse = '';
        curl_setopt($ch, CURLOPT_WRITEFUNCTION, function ($ch, $data) use (&$fullResponse) {
            $lines = explode("\n", $data);
            foreach ($lines as $line) {
                $line = trim($line);
                
                // Log raw response untuk debugging
                \Log::debug('Raw response line', ['line' => $line]);
                
                // Hapus prefix "data:" jika ada
                if (str_starts_with($line, "data:")) {
                    $line = trim(substr($line, 5));
                }
                
                // Decode dan ambil konten 'response'
                if ($line && str_starts_with($line, "{")) {
                    $json = json_decode($line, true);
                    if (isset($json['response'])) {
                        $fullResponse .= $json['response'];
                        // Log successful response parsing
                        \Log::debug('Parsed response', ['response' => $json['response']]);
                    }
                }
            }
            return strlen($data);
        });

        $response = curl_exec($ch);

        if ($response === false) {
            $error = curl_error($ch);
            $errno = curl_errno($ch);
            curl_close($ch);
            
            // Log error details
            \Log::error('Curl Error', [
                'error' => $error,
                'errno' => $errno,
                'url' => 'http://localhost:11434/api/generate'
            ]);
            
            return response()->json([
                'error' => 'Curl Error: ' . $error,
                'details' => 'Error number: ' . $errno
            ], 500);
        }

        curl_close($ch);

        // Log final response
        \Log::info('Final response from Zephyr', ['response' => $fullResponse]);

        // Jika tidak ada response, berikan pesan default
        if (empty($fullResponse)) {
            \Log::warning('Empty response from Zephyr API');
            $fullResponse = "Maaf, saya mengalami kesulitan dalam memproses pertanyaan Anda. Silakan coba tanyakan kembali dengan cara yang berbeda.";
        }

        // Simpan balasan bot
        ChatHistory::create([
            'user_id' => $userId,
            'sender' => 'bot',
            'message' => $fullResponse,
        ]);

        return response()->json([
            'reply' => $fullResponse
        ]);
    }

    private function getDominantPersonalityTypes($userResult)
    {
        $scores = [
            'Logis' => $userResult->score_a,
            'Kreatif' => $userResult->score_b,
            'Strategis' => $userResult->score_c,
            'Sosial' => $userResult->score_d,
            'Empati' => $userResult->score_e
        ];

        // Urutkan skor dari tertinggi ke terendah
        arsort($scores);
        
        // Ambil 2 tipe kepribadian dengan skor tertinggi
        $dominantTypes = array_slice($scores, 0, 2, true);
        
        // Filter hanya tipe yang memiliki skor signifikan (misal > 3)
        return array_filter($dominantTypes, function($score) {
            return $score > 3;
        });
    }

    public function history()
    {
        $user = auth()->user();

        if(!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $history = ChatHistory::where('user_id', $user->id)
            ->latest()
            ->get(['sender', 'message', 'created_at']);

        return response()->json($history);
    }

    public function logout(Request $request)
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Successfully logged out']);
    }
}
