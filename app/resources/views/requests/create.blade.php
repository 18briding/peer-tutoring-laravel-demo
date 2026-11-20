@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <p class="eyebrow">Learn together</p>
        <h1>Request a tutoring session</h1>
        <p class="intro">
            Tell us what you’re working on and when you’d like to meet.
        </p>
    </div>

    @if ($errors->any())
        <div class="notice notice-error" role="alert">
            <h2>Check your request</h2>
            <p>
                Please correct the highlighted fields and submit again.
                Your entries have been kept.
            </p>

            @error('form_name')
                <p>{{ $message }}</p>
            @enderror
        </div>
    @endif

    <form
        class="form-card"
        action="{{ route('requests.store') }}"
        method="POST"
    >
        @csrf

        <input
            type="hidden"
            name="form_name"
            value="tutoring_request"
        >

        <p class="form-note">All fields are required.</p>

        <div class="form-grid">
            <div class="field">
                <label for="course">Course</label>

                <select
                    id="course"
                    name="course"
                    required
                    @error('course')
                        aria-invalid="true"
                        aria-describedby="course-error"
                    @enderror
                >
                    <option value="">Choose a course</option>

                    @foreach ($courses as $course)
                        <option
                            value="{{ $course }}"
                            @selected(old('course') === $course)
                        >
                            {{ $course }}
                        </option>
                    @endforeach
                </select>

                @error('course')
                    <p class="field-error" id="course-error">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="field">
                <label for="preferreddate">Preferred date</label>

                <input
                    id="preferreddate"
                    name="preferreddate"
                    type="date"
                    value="{{ is_string(old('preferreddate')) ? old('preferreddate') : '' }}"
                    required
                    aria-describedby="date-help @error('preferreddate') date-error @enderror"
                    @error('preferreddate')
                        aria-invalid="true"
                    @enderror
                >

                <p class="help" id="date-help">
                    Choose today or a future date.
                </p>

                @error('preferreddate')
                    <p class="field-error" id="date-error">
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        <div class="field">
            <label for="reason">What would you like help with?</label>

            <textarea
                id="reason"
                name="reason"
                rows="4"
                maxlength="500"
                required
                aria-describedby="reason-help @error('reason') reason-error @enderror"
                @error('reason')
                    aria-invalid="true"
                @enderror
                placeholder="For example, I’d like help understanding PHP arrays."
            >{{ is_string(old('reason')) ? old('reason') : '' }}</textarea>

            <p class="help" id="reason-help">
                Describe your request in 10–500 characters.
            </p>

            @error('reason')
                <p class="field-error" id="reason-error">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <fieldset
            @if ($errors->has('topics') || $errors->has('topics.*'))
                aria-describedby="topics-error"
            @endif
        >
            <legend>Topics</legend>
            <p class="help">Choose at least one.</p>

            <div class="choices">
                @foreach ($topics as $topic)
                    <label class="choice">
                        <input
                            type="checkbox"
                            name="topics[]"
                            value="{{ $topic }}"
                            @checked(in_array(
                                $topic,
                                is_array(old('topics')) ? old('topics') : [],
                                true
                            ))
                        >
                        <span>{{ $topic }}</span>
                    </label>
                @endforeach
            </div>

            @if ($errors->has('topics') || $errors->has('topics.*'))
                <p class="field-error" id="topics-error">
                    {{ $errors->first('topics') ?: $errors->first('topics.*') }}
                </p>
            @endif
        </fieldset>

        <fieldset
            @error('preferredtime')
                aria-describedby="time-error"
            @enderror
        >
            <legend>Preferred time</legend>

            <div class="choices">
                @foreach ($times as $time)
                    <label class="choice">
                        <input
                            type="radio"
                            name="preferredtime"
                            value="{{ $time }}"
                            required
                            @checked(old('preferredtime') === $time)
                        >
                        <span>{{ $time }}</span>
                    </label>
                @endforeach
            </div>

            @error('preferredtime')
                <p class="field-error" id="time-error">
                    {{ $message }}
                </p>
            @enderror
        </fieldset>

        <div class="form-actions">
            <button type="submit">Request session</button>
            <p class="help">
                Your request will be submitted for review.
            </p>
        </div>
    </form>
@endsection