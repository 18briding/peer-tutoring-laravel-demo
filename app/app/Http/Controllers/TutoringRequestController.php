<?php

namespace App\Http\Controllers;

use App\Models\TutoringRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TutoringRequestController extends Controller
{
    private const COURSES = [
        'IS 6465',
        'IS 6495',
        'IS 6570',
    ];

    private const TOPICS = [
        'Exam review',
        'Practice problems',
        'Study plan',
    ];

    private const TIMES = [
        'Morning',
        'Afternoon',
        'Evening',
    ];

    public function index()
    {
        $requests = TutoringRequest::orderByDesc('id')->get();

        return view('requests.index', [
            'requests' => $requests,
        ]);
    }

    public function create()
    {
        return view('requests.create', [
            'courses' => self::COURSES,
            'topics' => self::TOPICS,
            'times' => self::TIMES,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'course' => [
                    'required',
                    'string',
                    Rule::in(self::COURSES),
                ],
                'reason' => [
                    'required',
                    'string',
                    'min:10',
                    'max:500',
                ],
                'topics' => [
                    'required',
                    'array',
                    'min:1',
                    'max:3',
                ],
                'topics.*' => [
                    'required',
                    'string',
                    'distinct',
                    Rule::in(self::TOPICS),
                ],
                'preferredtime' => [
                    'required',
                    'string',
                    Rule::in(self::TIMES),
                ],
                'preferreddate' => [
                    'required',
                    'date_format:Y-m-d',
                    'after_or_equal:today',
                ],
                'form_name' => [
                    'required',
                    Rule::in(['tutoring_request']),
                ],
            ],
            [
                'course.required' => 'Please choose a course.',
                'course.in' => 'Please choose one of the listed courses.',
                'reason.required' => 'Please describe what you need help with.',
                'reason.min' => 'Use at least 10 characters to describe your request.',
                'reason.max' => 'Keep your description within 500 characters.',
                'topics.required' => 'Please choose at least one topic.',
                'topics.*.in' => 'Please choose one of the listed topics.',
                'preferredtime.required' => 'Please choose a preferred time.',
                'preferreddate.required' => 'Please choose a preferred date.',
                'preferreddate.date_format' => 'Please enter a valid date.',
                'preferreddate.after_or_equal' => 'Preferred date cannot be in the past.',
            ]
        );

        $tutoringRequest = TutoringRequest::create([
            'course' => $validated['course'],
            'reason' => $validated['reason'],
            'topics' => $validated['topics'],
            'preferred_date' => $validated['preferreddate'],
            'preferred_time' => $validated['preferredtime'],
        ]);

        return redirect()
            ->route('requests.show', [
                'tutoringRequest' => $tutoringRequest,
            ])
            ->with('success', 'Your tutoring request has been received.');
    }

    public function show(TutoringRequest $tutoringRequest)
    {
        return view('requests.show', [
            'tutoringRequest' => $tutoringRequest,
        ]);
    }
}