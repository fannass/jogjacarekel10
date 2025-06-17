@extends('backend.layouts.app')

@section('title') Tambah FAQ @endsection

@section('breadcrumbs')
<x-backend.breadcrumbs>
    <x-backend.breadcrumb-item route='{{ route("faqs.index") }}' icon='fa-solid fa-message'>FAQ Chatbot</x-backend.breadcrumb-item>
    <x-backend.breadcrumb-item type="active" icon='fa-solid fa-plus'>Tambah FAQ</x-backend.breadcrumb-item>
</x-backend.breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <x-backend.section-header>
            <i class="fa-solid fa-plus"></i> Tambah FAQ <small class="text-muted">Baru</small>

            <x-slot name="subtitle">
                Tambah FAQ baru untuk chatbot
            </x-slot>
            <x-slot name="toolbar">
                <x-buttons.return-back route='{{ route("faqs.index") }}' />
            </x-slot>
        </x-backend.section-header>

        <form action="{{ route('faqs.store') }}" method="POST">
            @csrf
            <div class="row mt-4">
                <div class="col">
                    <div class="form-group">
                        <label for="medical_type" class="form-label">Jenis Medical</label>
                        <select class="form-control @error('medical_type') is-invalid @enderror" id="medical_type" name="medical_type" required>
                            <option value="">Pilih Jenis Medical</option>
                            @foreach($medicalTypes as $type)
                                <option value="{{ $type }}" {{ old('medical_type') == $type ? 'selected' : '' }}>
                                    {{ ucfirst($type) }}
                                </option>
                            @endforeach
                        </select>
                        @error('medical_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="district" class="form-label">Kecamatan</label>
                        <select class="form-control @error('district') is-invalid @enderror" id="district" name="district" required style="max-height:200px; overflow-y:auto;">
                            <option value="">Pilih Kecamatan</option>
                            @foreach($districts as $district)
                                <option value="{{ $district }}" {{ old('district') == $district ? 'selected' : '' }}>{{ $district }}</option>
                            @endforeach
                        </select>
                        @error('district')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="answer" class="form-label">Jawaban Default</label>
                        <textarea class="form-control @error('answer') is-invalid @enderror" id="answer" name="answer" rows="5" required>{{ old('answer') }}</textarea>
                        @error('answer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="location_type" class="form-label">Tipe Lokasi</label>
                        <select class="form-control @error('location_type') is-invalid @enderror" id="location_type" name="location_type" required>
                            <option value="">Pilih Tipe Lokasi</option>
                            <option value="kecamatan" {{ old('location_type') == 'kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                            <option value="kelurahan" {{ old('location_type') == 'kelurahan' ? 'selected' : '' }}>Kelurahan</option>
                        </select>
                        @error('location_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('faqs.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection 