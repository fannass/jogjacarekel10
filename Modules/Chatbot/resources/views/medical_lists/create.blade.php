@extends('backend.layouts.app')

@section('title') Tambah Medical @endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h4>Tambah Medical</h4>
        <form action="{{ route('medical-lists.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nama Medical</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Simpan</button>
            <a href="{{ route('medical-lists.index') }}" class="btn btn-secondary mt-2">Batal</a>
        </form>
    </div>
</div>
@endsection 