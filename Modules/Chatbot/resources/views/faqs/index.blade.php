@extends('backend.layouts.app')

@section('title') FAQ Chatbot @endsection

@section('breadcrumbs')
<x-backend.breadcrumbs>
    <x-backend.breadcrumb-item type="active" icon='fa-solid fa-message'>FAQ Chatbot</x-backend.breadcrumb-item>
</x-backend.breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">

        <x-backend.section-header>
            <i class="fa-solid fa-message"></i> FAQ Chatbot <small class="text-muted">Daftar</small>

            <x-slot name="subtitle">
                Manajemen FAQ Chatbot
            </x-slot>
            <x-slot name="toolbar">
                {{-- Asumsikan permission untuk FAQ adalah manage_faqs atau serupa --}}
                {{-- @can('manage_faqs') --}}
                <x-buttons.create route='{{ route("faqs.create") }}' title="Tambah FAQ" />
                {{-- @endcan --}}
            </x-slot>
        </x-backend.section-header>

        <div class="row mt-4">
            <div class="col">
                <table id="datatable" class="table table-bordered table-hover table-responsive-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($faqs as $faq)
                        <tr>
                            <td>{{ $faq->id }}</td>
                            <td>{{ $faq->question }}</td>
                            <td>{{ $faq->answer }}</td>
                            <td class="text-end">
                                {{-- @can('manage_faqs') --}}
                                <a href='{!!route("faqs.edit", $faq)!!}' class='btn btn-sm btn-primary mt-1' data-toggle="tooltip" title="Edit FAQ"><i class="fas fa-wrench"></i></a>
                                <a href='{!!route("faqs.show", $faq)!!}' class='btn btn-sm btn-success mt-1' data-toggle="tooltip" title="Lihat FAQ"><i class="fas fa-tv"></i></a>
                                <form action="{{ route('faqs.destroy', $faq) }}" method="POST" style="display:inline;" onsubmit="return confirm('Anda yakin ingin menghapus FAQ ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger mt-1" data-toggle="tooltip" title="Hapus FAQ"><i class="fas fa-trash"></i></button>
                                </form>
                                {{-- @endcan --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    Total {{ $faqs->total() ?? $faqs->count() }} FAQ
                </div>
            </div>
            <div class="col-5">
                <div class="float-end">
                    {{ $faqs->links() ?? '' }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 