@extends('backend.layouts.app')

@section('title') Daftar Medical @endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h4>Daftar Medical</h4>
        <a href="{{ route('medical-lists.create') }}" class="btn btn-primary mb-3">Tambah Medical</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Medical</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($medicalLists as $medical)
                <tr>
                    <td>{{ $medical->id }}</td>
                    <td>{{ $medical->name }}</td>
                    <td>
                        <a href="{{ route('medical-lists.edit', $medical) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('medical-lists.destroy', $medical) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 