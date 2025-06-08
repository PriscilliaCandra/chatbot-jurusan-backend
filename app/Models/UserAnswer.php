<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;

    protected $table = 'user_answers'; 

    protected $fillable = [
        'user_id',
        'question_id',
        'level',
        'question_order',
        'answer_choice',
    ];

    /**
     * Relasi dengan model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi dengan model Question.
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
