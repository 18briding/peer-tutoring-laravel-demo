@extends('layouts.app')

@section('content')
    <a class="back-link" href="{{ route('requests.index') }}">
        ← All requests
    </a>

    <div class="page-heading">
        <p class="eyebrow">Request #{{ $tutoringRequest->id }}</p>
        <h1>{{ $tutoringRequest->course }} tutoring</h1>
        <p class="intro">Session preferences and request details.</p>
    </div>

    @if (session('success'))
        <div class="notice notice-success" role="status">
            <h2>Request received</h2>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <section class="form-card" aria-labelledby="details-heading">
        <div class="request-card-heading">
            <h2 id="details-heading">Session details</h2>
            <span class="status">{{ $tutoringRequest->status }}</span>
        </div>

        <dl class="confirmation-details">
            <dt>Course</dt>
            <dd>{{ $tutoringRequest->course }}</dd>

            <dt>Preferred date</dt>
            <dd>{{ $tutoringRequest->preferred_date->format('l, F j, Y') }}</dd>

            <dt>Preferred time</dt>
            <dd>{{ $tutoringRequest->preferred_time }}</dd>

            <dt>Topics</dt>
            <dd>{{ implode(', ', $tutoringRequest->topics) }}</dd>

            <dt>What you need help with</dt>
            <dd>{{ $tutoringRequest->reason }}</dd>
        </dl>
    </section>

    <div class="details-actions">
        <a class="button-link" href="{{ route('requests.create') }}">
            Request another session
        </a>
    </div>
@endsection