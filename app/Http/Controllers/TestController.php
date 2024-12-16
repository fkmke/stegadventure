<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTestRequest;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function create(CreateTestRequest $request)
    {
        Test::create($request->validated());
        return response()->json(
            [
                'message' => 'Knowledge test submitted successfully!',
            ],
            200,
        );
    }
}
