<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateParticiantRequest;
use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function create(CreateParticiantRequest $request)
    {
        Participant::create($request->validated());
        return response()->json(
            [
                'message' => 'Participant created successfully!',
            ],
            200,
        );
    }
}
