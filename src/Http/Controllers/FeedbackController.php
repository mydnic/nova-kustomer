<?php

namespace Mydnic\NovaKustomer\Http\Controllers;

use Mydnic\Kustomer\Feedback;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class FeedbackController extends Controller
{
    public function index()
    {
        $types = config('kustomer.feedbacks');

        return Feedback::latest()->get()->map(function ($feedback) use ($types) {
            $feedback->icon = isset($types[$feedback->type]) ? $types[$feedback->type]['icon'] : '';
            return $feedback;
        });
    }

    public function show(Feedback $feedback)
    {
        $feedback->screenshot = (isset($feedback->user_info['screenshot']) and !is_null($feedback->user_info['screenshot']))
            ? Storage::url($feedback->user_info['screenshot'])
            : null;

        return $feedback;
    }

    public function markAsReviewed(Feedback $feedback)
    {
        $feedback->reviewed = true;
        $feedback->save();

        return response()->json([
            'updated' => true
        ], 201);
    }
}
