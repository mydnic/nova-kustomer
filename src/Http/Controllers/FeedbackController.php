<?php

namespace Mydnic\NovaKustomer\Http\Controllers;

use Illuminate\Routing\Controller;
use Mydnic\Kustomer\Feedback;

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
