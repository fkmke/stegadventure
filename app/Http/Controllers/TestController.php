<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTestRequest;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function create(CreateTestRequest $request)
    {

        $answers = $request->validated();
        $score = 0;
        // TODO calculate score and save score


        $answers['score'] = $score;
        Test::create($answers);
        return response()->json(
            [
                'message' => 'Knowledge test submitted successfully!',
            ],
            200,
        );
    }
}
