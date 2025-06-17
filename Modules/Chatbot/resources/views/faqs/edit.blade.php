@extends('backend.layouts.app')

@section('title') Edit FAQ @endsection

@section('breadcrumbs')
<x-backend.breadcrumbs>
    <x-backend.breadcrumb-item route='{{ route("faqs.index") }}' icon='fa-solid fa-message'>FAQ Chatbot</x-backend.breadcrumb-item>
    <x-backend.breadcrumb-item type="active" icon='fa-solid fa-edit'>Edit FAQ</x-backend.breadcrumb-item>
</x-backend.breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <x-backend.section-header>
            <i class="fa-solid fa-edit"></i> Edit FAQ <small class="text-muted">#{{ $faq->id }}</small>

            <x-slot name="subtitle">
                Edit FAQ untuk chatbot
            </x-slot>
            <x-slot name="toolbar">
                <x-buttons.return-back route='{{ route("faqs.index") }}' />
            </x-slot>
        </x-backend.section-header>

        <form action="{{ route('faqs.update', $faq->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mt-4">
                <div class="col">
                    <div class="form-group">
                        <label for="question" class="form-label">Pertanyaan</label>
                        <input type="text" class="form-control @error('question') is-invalid @enderror" id="question" name="question" value="{{ old('question', $faq->question) }}" required>
                        @error('question')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="answer" class="form-label">Jawaban</label>
                        <textarea class="form-control @error('answer') is-invalid @enderror" id="answer" name="answer" rows="5" required>{{ old('answer', $faq->answer) }}</textarea>
                        @error('answer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('faqs.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection 