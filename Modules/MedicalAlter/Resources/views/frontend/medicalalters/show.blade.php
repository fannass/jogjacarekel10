@extends('frontend.layouts.app')

@section('title') {{ $medicalalter->name }} - @lang("Medical Alternative") @endsection

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden bg-cover bg-center py-24" style="background-image: url('{{ asset('img/Wallpaper/wallpaperkeraton.jpg') }}');">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-600/90 via-blue-500/85 to-blue-800/85"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center text-white max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="mb-8">
                <ol class="flex justify-center space-x-2 text-white/90">
                    <li><a href="{{ route('frontend.index') }}" class="hover:text-white">@lang("Home")</a></li>
                    <li><i class="fas fa-chevron-right mx-2"></i></li>
                    <li><a href="{{ route('frontend.medicalalters.index') }}" class="hover:text-white">@lang("Medical Alternative")</a></li>
                    <li><i class="fas fa-chevron-right mx-2"></i></li>
                    <li class="text-white">{{ $medicalalter->name }}</li>
                </ol>
            </nav>

            <h1 class="text-4xl md:text-6xl font-bold mb-6">{{ $medicalalter->name }}</h1>
            
            <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-lg border border-white/20 rounded-full text-white mb-6">
                <i class="fas fa-leaf mr-2"></i>
                <span class="font-medium">{{ $medicalalter->type }}</span>
            </div>

            @if($medicalalter->intro)
                <p class="text-xl md:text-2xl mb-8">{{ $medicalalter->intro }}</p>
            @endif
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-12 bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content -->
            <div class="w-full lg:w-2/3">
                <!-- Main Image -->
                @if($medicalalter->image)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden mb-8">
                    <img src="{{ asset($medicalalter->image) }}" 
                         alt="{{ $medicalalter->name }}" 
                         class="w-full h-96 object-cover">
                </div>
                @endif

                <!-- Description -->
                @if($medicalalter->description)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                        <i class="fas fa-info-circle text-blue-600 mr-3"></i>
                        @lang("Description")
                    </h2>
                    <div class="prose max-w-none text-gray-600 dark:text-gray-400">
                        {!! nl2br(e($medicalalter->description)) !!}
                    </div>
                </div>
                @endif

                <!-- Benefits -->
                @if($medicalalter->benefits)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                        <i class="fas fa-heart text-blue-600 mr-3"></i>
                        @lang("Health Benefits")
                    </h2>
                    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-6">
                        <div class="prose max-w-none text-blue-900 dark:text-blue-300">
                            {!! nl2br(e($medicalalter->benefits)) !!}
                        </div>
                    </div>
                </div>
                @endif

                <!-- Treatment Information -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                        <i class="fas fa-spa text-blue-600 mr-3"></i>
                        @lang("Treatment Information")
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Treatment Type -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2 flex items-center">
                                <i class="fas fa-tag text-blue-600 mr-2"></i>@lang("Treatment Type")
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ $medicalalter->type }}</p>
                        </div>

                        <!-- Approach -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2 flex items-center">
                                <i class="fas fa-hands-helping text-blue-600 mr-2"></i>@lang("Approach")
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                @if(str_contains(strtolower($medicalalter->type), 'traditional'))
                                    @lang("Traditional healing methods")
                                @elseif(str_contains(strtolower($medicalalter->type), 'herbal'))
                                    @lang("Natural herbal remedies")
                                @elseif(str_contains(strtolower($medicalalter->type), 'energy'))
                                    @lang("Energy-based healing")
                                @else
                                    @lang("Holistic wellness approach")
                                @endif
                            </p>
                        </div>

                        <!-- Suitable For -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2 flex items-center">
                                <i class="fas fa-user-check text-blue-600 mr-2"></i>@lang("Suitable For")
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400">@lang("Adults seeking complementary healthcare")</p>
                        </div>

                        <!-- Safety -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2 flex items-center">
                                <i class="fas fa-shield-alt text-blue-600 mr-2"></i>@lang("Safety Note")
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400">@lang("Consult healthcare providers before use")</p>
                        </div>
                    </div>

                    <!-- Important Notice -->
                    <div class="mt-6 p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg border border-yellow-200 dark:border-yellow-800">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-yellow-600 dark:text-yellow-400 mt-1 mr-3"></i>
                            <div>
                                <h4 class="font-semibold text-yellow-900 dark:text-yellow-300 mb-2">@lang("Important Notice")</h4>
                                <p class="text-sm text-yellow-800 dark:text-yellow-400">
                                    @lang("Alternative medicine should complement, not replace, conventional medical treatment. Always consult qualified healthcare providers before starting any alternative treatment, especially if you have existing health conditions or are taking medications.")
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="w-full lg:w-1/3">
                <!-- Quick Info -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                        @lang("Quick Info")
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">@lang("Treatment"):</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $medicalalter->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">@lang("Type"):</span>
                            <span class="font-medium text-blue-600">{{ $medicalalter->type }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">@lang("Added"):</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $medicalalter->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">@lang("Updated"):</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $medicalalter->updated_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">@lang("Actions")</h3>
                    <div class="space-y-3">
                        <a href="{{ route('frontend.medicalalters.index') }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-4 rounded-lg transition-colors font-medium block">
                            <i class="fas fa-arrow-left mr-2"></i>@lang("Back to List")
                        </a>
                        <button class="w-full bg-green-600 hover:bg-green-700 text-white text-center py-3 px-4 rounded-lg transition-colors font-medium" onclick="window.print()">
                            <i class="fas fa-print mr-2"></i>@lang("Print Info")
                        </button>
                        <button class="w-full bg-gray-600 hover:bg-gray-700 text-white text-center py-3 px-4 rounded-lg transition-colors font-medium" onclick="if(navigator.share) navigator.share({title: '{{ $medicalalter->name }}', url: window.location.href})">
                            <i class="fas fa-share mr-2"></i>@lang("Share")
                        </button>
                    </div>
                </div>

                <!-- Related Treatments -->
                @php
                    $relatedTreatments = \Modules\MedicalAlter\Models\MedicalAlter::where('id', '!=', $medicalalter->id)
                        ->where('type', $medicalalter->type)
                        ->orderBy('created_at', 'desc')
                        ->limit(4)
                        ->get();
                @endphp

                @if($relatedTreatments->count() > 0)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <i class="fas fa-leaf text-blue-600 mr-2"></i>
                        @lang("Related Treatments")
                    </h3>
                    <div class="space-y-3">
                        @foreach($relatedTreatments as $related)
                        <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-3">
                            <h5 class="font-medium text-gray-900 dark:text-white text-sm mb-1">{{ $related->name }}</h5>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mb-2">
                                {{ Str::limit($related->intro, 60) }}
                            </p>
                            <a href="{{ route('frontend.medicalalters.show', [encode_id($related->id), $related->slug]) }}" class="text-blue-600 hover:text-blue-700 text-xs">
                                @lang("Learn More") →
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Treatment Categories -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <i class="fas fa-list text-blue-600 mr-2"></i>
                        @lang("Treatment Categories")
                    </h3>
                    <div class="space-y-2">
                        @php
                            $categories = [
                                'Traditional medicine' => 'fas fa-mortar-pestle',
                                'Traditional Alternative' => 'fas fa-yin-yang',
                                'Herbal Medicine' => 'fas fa-seedling',
                                'Energy Healing' => 'fas fa-hands'
                            ];
                        @endphp
                        @foreach($categories as $category => $icon)
                        <a href="{{ route('frontend.medicalalters.index', ['type' => $category]) }}" 
                           class="flex items-center p-2 rounded-lg {{ $medicalalter->type == $category ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' : 'hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400' }} transition-colors">
                            <i class="{{ $icon }} mr-3"></i>
                            <span class="text-sm">{{ $category }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('frontend.includes.messages')
@endsection

@push('after-styles')
<style>
/* Prose styling for content */
.prose {
    line-height: 1.7;
}

.prose p {
    margin-bottom: 1rem;
}

/* Custom animations */
@keyframes fade-in-down {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Smooth transitions */
* {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
}

/* Print styles */
@media print {
    .sticky,
    .fixed {
        position: static !important;
    }
    
    .shadow-lg,
    .shadow-xl {
        box-shadow: none !important;
        border: 1px solid #e5e7eb !important;
    }
    
    .bg-blue-600 {
        background-color: #2563eb !important;
        color: white !important;
    }
}

/* Accessibility improvements */
.focus\:ring-2:focus {
    outline: 2px solid transparent;
    outline-offset: 2px;
    box-shadow: 0 0 0 2px rgb(37 99 235);
}

/* Dark mode adjustments */
[data-coreui-theme="dark"] .bg-white {
    background-color: rgb(31 41 55);
}

[data-coreui-theme="dark"] .text-gray-900 {
    color: rgb(243 244 246);
}
</style>
@endpush