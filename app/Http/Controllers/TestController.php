<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTestRequest;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{

    private $score = 0;

    public function create(CreateTestRequest $request)
    {
        $answers = $request->validated();

        // Calculate test score
        $this->calculateScore($answers);
        $answers['score'] = $this->score;

        // Send to model
        Test::create($answers);

        // Send response
        return response()->json(
            [
                'message' => 'Knowledge test submitted successfully!',
                'score' => $this->score,
            ],
            200,
        );
    }

    private $correctAnswers = [
        'question1' => ["1", "2", "3"],
        'question2' => ["2", "3", "4"],
        'question3' => ["1", "4"],
        'question4' => "4",
        'question5' => "2",
        'question6' => ["1", "2"],
        'question7' => ["4", "5"],
        'question8' => "1",
        'question9' => "5",
    ];

    // When array: left is points to add when correct, right is points to subtract for each wrong ticked box.
    // Max points: 6. When checkbox: points are divided amongst amount of correct and incorrect boxes.
    private $pointsCorrectOrIncorrectAnswers = [
        'question1' => [2, 6],
        'question2' => [2, 6],
        'question3' => [3, 2],
        'question4' => 6,
        'question5' => 6,
        'question6' => [3, 2],
        'question7' => [3, 2],
        'question8' => 6,
        'question9' => 6,
    ];

    private function calculateScore(array $answers): void
    {
        // Score calculation logic
        $this->checkCheckboxQuestion('question1', $answers);
        $this->checkCheckboxQuestion('question2', $answers);
        $this->checkCheckboxQuestion('question3', $answers);
        $this->checkRadioQuestion('question4', $answers);
        $this->checkRadioQuestion('question5', $answers);
        $this->checkCheckboxQuestion('question6', $answers);
        $this->checkCheckboxQuestion('question7', $answers);
        $this->checkRadioQuestion('question8', $answers);
        $this->checkRadioQuestion('question9', $answers);
    }

    private function checkRadioQuestion(string $question, array $answers): void
    {
        if ($answers[$question] === "0") {
            // Don't do anything if student does not know the answer
            return;
        }
        if ($this->correctAnswers[$question] === $answers[$question]) {
            $this->score += $this->pointsCorrectOrIncorrectAnswers[$question];
        } else {
            $this->score -= $this->pointsCorrectOrIncorrectAnswers[$question];
        }
    }

    private function checkCheckboxQuestion(string $question, array $answers): void
    {
        if (in_array("0", $answers[$question])) {
            // Don't do anything if student does not know the answer
            return;
        }
        foreach ($answers[$question] as $answer) {
            // Check if answer is in the correct answers
            if (in_array($answer, $this->correctAnswers[$question])) {
                $this->score += $this->pointsCorrectOrIncorrectAnswers[$question][0];
                continue;
            } else {
                $this->score -= $this->pointsCorrectOrIncorrectAnswers[$question][1];
                continue;
            }
        }
    }
}
