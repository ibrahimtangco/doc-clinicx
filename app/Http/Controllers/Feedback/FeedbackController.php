<?php

namespace App\Http\Controllers\Feedback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function create()
    {
        return view('feedback.send');
    }

    public function store(Request $request)
    {

        $validation = [
            'rating1' => 'integer',
            'rating2' => 'integer',
            'rating3' => 'integer',
            'rating4' => 'integer',
            'star5' => 'string',
            'feedback_description' => 'string'
        ];
        dd($request);
        $userFeedback = $request->validate($validation);
    }
}
