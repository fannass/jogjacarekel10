@extends('medicaltreatment::layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Perawatan Medis</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('medicaltreatment.update', $treatment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nama Perawatan</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $treatment->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $treatment->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="duration" class="form-label">Durasi</label>
                <input type="text" class="form-control @error('duration') is-invalid @enderror" id="duration" name="duration" value="{{ old('duration', $treatment->duration) }}" required>
                @error('duration')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="cost" class="form-label">Biaya</label>
                <input type="number" class="form-control @error('cost') is-invalid @enderror" id="cost" name="cost" value="{{ old('cost', $treatment->cost) }}" required>
                @error('cost')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ old('status', $treatment->status) ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">
                        Aktif
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('medicaltreatment.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection 