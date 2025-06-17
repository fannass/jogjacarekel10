@extends('backend.layouts.app')

@section('title') Edit Medical @endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h4>Edit Medical</h4>
        <form action="{{ route('medical-lists.update', $medical) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nama Medical</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $medical->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Update</button>
            <a href="{{ route('medical-lists.index') }}" class="btn btn-secondary mt-2">Batal</a>
        </form>
    </div>
</div>
@endsection 