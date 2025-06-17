@extends('backend.layouts.app')

@section('title') Detail FAQ @endsection

@section('breadcrumbs')
<x-backend.breadcrumbs>
    <x-backend.breadcrumb-item route='{{ route("faqs.index") }}' icon='fa-solid fa-message'>FAQ Chatbot</x-backend.breadcrumb-item>
    <x-backend.breadcrumb-item type="active" icon='fa-solid fa-eye'>Detail FAQ</x-backend.breadcrumb-item>
</x-backend.breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <x-backend.section-header>
            <i class="fa-solid fa-eye"></i> Detail FAQ <small class="text-muted">#{{ $faq->id }}</small>

            <x-slot name="subtitle">
                Detail FAQ untuk chatbot
            </x-slot>
            <x-slot name="toolbar">
                <x-buttons.return-back route='{{ route("faqs.index") }}' />
                <a href='{!!route("faqs.edit", $faq)!!}' class='btn btn-sm btn-primary' data-toggle="tooltip" title="Edit FAQ"><i class="fas fa-wrench"></i> Edit</a>
            </x-slot>
        </x-backend.section-header>

        <div class="row mt-4">
            <div class="col">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 200px;">ID</th>
                        <td>{{ $faq->id }}</td>
                    </tr>
                    <tr>
                        <th>Pertanyaan</th>
                        <td>{{ $faq->question }}</td>
                    </tr>
                    <tr>
                        <th>Jawaban</th>
                        <td>{{ $faq->answer }}</td>
                    </tr>
                    <tr>
                        <th>Dibuat Pada</th>
                        <td>{{ $faq->created_at->format('d F Y H:i:s') }}</td>
                    </tr>
                    <tr>
                        <th>Diperbarui Pada</th>
                        <td>{{ $faq->updated_at->format('d F Y H:i:s') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 