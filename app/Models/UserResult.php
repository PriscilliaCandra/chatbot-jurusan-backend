<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserResult extends Model
{
    protected $table = 'user_results';
    
    protected $fillable = [
        'user_id',
        'score_a',
        'score_b',
        'score_c',
        'score_d',
        'score_e',
        'personality_type',
        'recommended_majors'
    ];

    protected $casts = [
        'recommended_majors' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPersonalityDescriptionAttribute()
    {
        $types = [];
        $scores = [
            'A' => $this->score_a,
            'B' => $this->score_b,
            'C' => $this->score_c,
            'D' => $this->score_d,
            'E' => $this->score_e
        ];

        // Get top 3 scores
        arsort($scores);
        $topScores = array_slice($scores, 0, 3, true);

        foreach ($topScores as $type => $score) {
            switch ($type) {
                case 'A':
                    $types[] = 'Logis';
                    break;
                case 'B':
                    $types[] = 'Kreatif';
                    break;
                case 'C':
                    $types[] = 'Strategis';
                    break;
                case 'D':
                    $types[] = 'Sosial';
                    break;
                case 'E':
                    $types[] = 'Empati';
                    break;
            }
        }

        return implode(' & ', $types);
    }
} 