<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\UserResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAnswer;

class GameController extends Controller
{
    public function start()
    {
        return view('game.start');
    }

    public function getQuestion($level, $questionNumber)
    {
        $question = Question::where('level', $level)
            ->where('question_order', $questionNumber)
            ->first();

        if (!$question) {
            return response()->json(['error' => 'Question not found'], 404);
        }

        return response()->json([
            'question' => $question->question_text,
            'options' => $question->options
        ]);
    }

    public function submitAnswer(Request $request)
    {
        $request->validate([
            'level' => 'required|in:1,2,3',
            'question_number' => 'required|integer|min:1|max:12',
            'answer' => 'required|in:A,B,C,D,E'
        ]);

        $userId = Auth::id();

        $question = Question::where('level', $request->level)
                            ->where('question_order', $request->question_number)
                            ->first();

        // Store answer in session
        // $answers = session('answers', []);
        // $answers[$request->level][$request->question_number] = $request->answer;
        // session(['answers' => $answers]);

        UserAnswer::updateOrCreate(
            [
                'user_id' => $userId,
                'question_id' => $question->id,
            ],
            [
                'level' => $request->level,
                'question_order' => $request->question_number,
                'answer_choice' => $request->answer,
            ]
        );

        // Return next question
        $nextQuestionNumber = $request->question_number + 1;
        if ($nextQuestionNumber > 12) {
            $nextLevel = $request->level + 1;
            $nextQuestionNumber = 1;
        } else {
            $nextLevel = $request->level;
        }

        // Check if this was the last question
        if ($request->question_number == 12 && $request->level == 3) {
            return $this->calculateResult();
        }

        return response()->json([
            'next_level' => $nextLevel,
            'next_question' => $nextQuestionNumber
        ]);
    }

    private function calculateResult()
    {
        $userId = Auth::id();
        $userAnswers = UserAnswer::where('user_id', $userId)->get();

        // $answers = session('answers', []);
        $scores = [
            'A' => 0,
            'B' => 0,
            'C' => 0,
            'D' => 0,
            'E' => 0
        ];

        // Calculate scores
        foreach ($userAnswers as $userAnswer) {
            $answerChoice = $userAnswer->answer_choice;
            if (isset($scores[$answerChoice])) {
                $scores[$answerChoice]++;
            }
        }

        // Get personality type
        arsort($scores);
        $topScores = array_slice($scores, 0, 3, true);
        $personalityTypes = [];
        $recommendedMajors = [];

        foreach ($topScores as $type => $score) {
            switch ($type) {
                case 'A':
                    $personalityTypes[] = 'Logis';
                    $recommendedMajors[] = [
                        'Teknologi Informasi',
                        'Matematika',
                        'Kedokteran',
                        'Teknik'
                    ];
                    break;
                case 'B':
                    $personalityTypes[] = 'Kreatif';
                    $recommendedMajors[] = [
                        'Desain Grafis',
                        'Seni Rupa',
                        'Arsitektur',
                        'Perfilman'
                    ];
                    break;
                case 'C':
                    $personalityTypes[] = 'Strategis';
                    $recommendedMajors[] = [
                        'Manajemen Bisnis',
                        'Ekonomi',
                        'Teknik Industri'
                    ];
                    break;
                case 'D':
                    $personalityTypes[] = 'Sosial';
                    $recommendedMajors[] = [
                        'Hukum',
                        'Hubungan Internasional',
                        'Ilmu Politik'
                    ];
                    break;
                case 'E':
                    $personalityTypes[] = 'Empati';
                    $recommendedMajors[] = [
                        'Psikologi',
                        'Pendidikan',
                        'Konseling',
                        'Kesehatan Masyarakat'
                    ];
                    break;
            }
        }

        $finalPersonalityType = implode(' & ', $personalityTypes);
        $finalRecommendedMajors = array_values(array_unique(array_merge(...$recommendedMajors)));

        // Save result if user is logged in
        if (Auth::check()) {
            UserResult::create(
                [
                    'user_id' => $userId,
                    'score_a' => $scores['A'] ?? 0,
                    'score_b' => $scores['B'] ?? 0,
                    'score_c' => $scores['C'] ?? 0,
                    'score_d' => $scores['D'] ?? 0,
                    'score_e' => $scores['E'] ?? 0,
                    'personality_type' => $finalPersonalityType,
                    'recommended_majors' => json_encode($finalRecommendedMajors) // Simpan sebagai JSON string
                ]
            );
        }

        // Clear session
        session()->forget('answers');

        return response()->json([
            'personality_type' => implode(' & ', $personalityTypes),
            'recommended_majors' => array_unique(array_merge(...$recommendedMajors))
        ]);
    }

    public function getResult()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $result = UserResult::where('user_id', Auth::id())
            ->latest()
            ->first();

        if (!$result) {
            return response()->json(['error' => 'No result found'], 404);
        }

        return response()->json([
            'personality_type' => $result->personality_type,
            'personality_description' => $result->personality_description, 
            'recommended_majors' => json_decode($result->recommended_majors) 
        ]);
    }
}
