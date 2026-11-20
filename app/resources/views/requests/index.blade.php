@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <p class="eyebrow">Peer support</p>
        <h1>Tutoring requests</h1>
        <p class="intro">
            Browse submitted requests or ask for help with a course.
        </p>
    </div>

    <div class="list-toolbar">
        <p class="help">
            {{ $requests->count() }}
            {{ $requests->count() === 1 ? 'request' : 'requests' }}
        </p>

        <a class="button-link" href="{{ route('requests.create') }}">
            Request a session
        </a>
    </div>

    @forelse ($requests as $item)
        <article class="request-card">
            <div class="request-card-heading">
                <h2>
                    <a href="{{ route('requests.show', ['tutoringRequest' => $item]) }}">
                        {{ $item->course }} · Request #{{ $item->id }}
                    </a>
                </h2>

                <span class="status">{{ $item->status }}</span>
            </div>

            <p class="request-description">{{ $item->reason }}</p>

            <p class="request-meta">
                {{ $item->preferred_date->format('M j, Y') }}
                · {{ $item->preferred_time }}
            </p>

            <div class="topic-tags">
                @foreach ($item->topics as $topic)
                    <span class="topic-tag">{{ $topic }}</span>
                @endforeach
            </div>
        </article>
    @empty
        <section class="form-card empty-state">
            <h2>The first session starts here</h2>
            <p>
                Submit a tutoring request and it will appear on this page.
            </p>

            <a href="{{ route('requests.create') }}">
                Request a session
            </a>
        </section>
    @endforelse

    <p class="demo-note">
        Shared classroom demo. Requests are saved in SQLite
        and are visible to anyone using this demo.
    </p>
@endsection