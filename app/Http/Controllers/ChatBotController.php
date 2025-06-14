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
                'suggested_questions' => [],
                'needs_personality_test' => true
            ]);
        }

        // Dapatkan tipe kepribadian dominan
        $personalityTypes = $this->getDominantPersonalityTypes($userResult);
        
        // Cari pertanyaan yang cocok dengan algoritma yang lebih baik
        $question = $this->findBestMatchingQuestion($msg, $personalityTypes);

        if ($question) {
            $reply = $question->answer;
        } else {
            $reply = "Maaf, saya tidak mengerti pertanyaan Anda. Silakan pilih pertanyaan dari daftar yang tersedia.";
        }

        // Simpan balasan bot
        ChatHistory::create([
            'user_id' => $userId,
            'sender' => 'bot',
            'message' => $reply,
        ]);

        return response()->json([
            'reply' => $reply,
            'suggested_questions' => $this->getSuggestedQuestions($personalityTypes)
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

    private function findBestMatchingQuestion($message, $personalityTypes)
    {
        // Normalisasi pesan
        $message = $this->normalizeText($message);
        
        $bestMatch = null;
        $highestSimilarity = 0;
        
        // Cari pertanyaan untuk setiap tipe kepribadian dominan
        foreach ($personalityTypes as $type => $score) {
            $questions = ChatbotQuestion::where('personality_type', $type)->get();
            
            foreach ($questions as $question) {
                $questionText = $this->normalizeText($question->questions);
                
                // Hitung similarity menggunakan similar_text
                similar_text($message, $questionText, $percent);
                
                // Tambahkan bonus berdasarkan skor kepribadian
                $bonus = ($score / 10) * 5; // Bonus maksimal 5%
                $finalScore = $percent + $bonus;
                
                if ($finalScore > $highestSimilarity && $finalScore > 60) {
                    $highestSimilarity = $finalScore;
                    $bestMatch = $question;
                }
            }
        }
        
        return $bestMatch;
    }

    private function normalizeText($text)
    {
        // Convert ke lowercase
        $text = strtolower($text);
        
        // Hapus tanda baca
        $text = preg_replace('/[^\p{L}\p{N}\s]/u', '', $text);
        
        // Hapus extra spaces
        $text = preg_replace('/\s+/', ' ', $text);
        
        // Trim
        return trim($text);
    }

    private function getSuggestedQuestions($personalityTypes)
    {
        $questions = collect();
        
        // Ambil pertanyaan untuk setiap tipe kepribadian dominan
        foreach ($personalityTypes as $type => $score) {
            $typeQuestions = ChatbotQuestion::where('personality_type', $type)
                ->inRandomOrder()
                ->limit(3)
                ->get(['id', 'questions']);
                
            $questions = $questions->concat($typeQuestions);
        }
        
        return $questions->shuffle()->take(5);
    }

    // Endpoint untuk mendapatkan pertanyaan yang tersedia
    public function getAvailableQuestions()
    {
        $userResult = UserResult::where('user_id', auth()->id())
            ->latest()
            ->first();

        if (!$userResult) {
            return response()->json([
                'message' => 'Anda belum melakukan tes kepribadian',
                'questions' => []
            ], 400);
        }

        $personalityTypes = $this->getDominantPersonalityTypes($userResult);
        $questions = $this->getSuggestedQuestions($personalityTypes);

        return response()->json($questions);
    }
}
