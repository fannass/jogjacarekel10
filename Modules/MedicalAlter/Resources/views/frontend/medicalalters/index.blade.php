@extends('frontend.layouts.app')

@section('title') @lang("Medical Alternative Hub") @endsection

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden bg-cover bg-center min-h-screen flex items-center" style="background-image: url('{{ asset('img/Wallpaper/wallpaperkeraton.jpg') }}');">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-600/90 via-blue-500/85 to-blue-800/85"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center text-white max-w-4xl mx-auto">
            <h1 class="text-5xl md:text-7xl font-bold mb-6">@lang("Medical Alternative Hub")</h1>
            <p class="text-xl md:text-2xl mb-8">@lang("Discover alternative and traditional medicine practices that complement conventional healthcare in Yogyakarta")</p>
            
            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-6 text-center">
                    <div class="text-4xl font-bold text-white">{{ $medicalalters->total() }}</div>
                    <div class="text-white/90 mt-2">@lang("Alternative Services")</div>
                </div>
                <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-6 text-center">
                    <div class="text-4xl font-bold text-white">
                        {{ $medicalalters->pluck('type')->unique()->count() }}
                    </div>
                    <div class="text-white/90 mt-2">@lang("Treatment Types")</div>
                </div>
                <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-6 text-center">
                    <div class="text-4xl font-bold text-white">24/7</div>
                    <div class="text-white/90 mt-2">@lang("Natural Healing")</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-12 bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filters -->
            <div class="w-full lg:w-1/4">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
                    <div class="bg-blue-600 text-white p-4">
                        <h5 class="font-bold text-lg">
                            <i class="fas fa-filter mr-2"></i>@lang("Search & Filter")
                        </h5>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('frontend.medicalalters.index') }}" method="GET" class="space-y-4">
                            <!-- Search Input -->
                            <div>
                                <label class="block font-medium text-gray-700 dark:text-gray-300 mb-2">@lang("Search Alternative Medicine")</label>
                                <input type="text" 
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" 
                                       name="search" 
                                       value="{{ request('search') }}" 
                                       placeholder="@lang('Enter treatment name...')">
                            </div>

                            <!-- Type Filter -->
                            <div>
                                <label class="block font-medium text-gray-700 dark:text-gray-300 mb-2">@lang("Treatment Type")</label>
                                <select class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" name="type">
                                    <option value="">@lang("All Types")</option>
                                    <option value="Traditional medicine" {{ request('type') == 'Traditional medicine' ? 'selected' : '' }}>@lang("Traditional Medicine")</option>
                                    <option value="Traditional Alternative" {{ request('type') == 'Traditional Alternative' ? 'selected' : '' }}>@lang("Traditional Alternative")</option>
                                    <option value="Herbal Medicine" {{ request('type') == 'Herbal Medicine' ? 'selected' : '' }}>@lang("Herbal Medicine")</option>
                                    <option value="Energy Healing" {{ request('type') == 'Energy Healing' ? 'selected' : '' }}>@lang("Energy Healing")</option>
                                </select>
                            </div>

                            <!-- Sort Options -->
                            <div>
                                <label class="block font-medium text-gray-700 dark:text-gray-300 mb-2">@lang("Sort By")</label>
                                <select class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" name="sort">
                                    <option value="">@lang("Default")</option>
                                    <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>@lang("Most Recent")</option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>@lang("Oldest")</option>
                                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>@lang("Name A-Z")</option>
                                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>@lang("Name Z-A")</option>
                                </select>
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-3">
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                                    <i class="fas fa-search mr-2"></i>@lang("Apply Filters")
                                </button>
                                <a href="{{ route('frontend.medicalalters.index') }}" class="w-full bg-white hover:bg-gray-50 text-blue-600 border border-blue-600 font-medium py-3 px-4 rounded-lg transition-colors text-center block">
                                    <i class="fas fa-undo mr-2"></i>@lang("Clear Filters")
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Info Box -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mt-6">
                    <h6 class="font-bold text-blue-600 mb-3">
                        <i class="fas fa-info-circle mr-2"></i>@lang("About Alternative Medicine")
                    </h6>
                    <div class="text-sm text-gray-600 dark:text-gray-400 space-y-2">
                        <p>@lang("Alternative medicine practices offer complementary approaches to health and wellness:")</p>
                        <ul class="pl-4 space-y-1">
                            <li>• @lang("Traditional healing methods")</li>
                            <li>• @lang("Natural and herbal remedies")</li>
                            <li>• @lang("Holistic wellness approaches")</li>
                            <li>• @lang("Mind-body healing techniques")</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="w-full lg:w-3/4">
                <!-- Results Header -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-8">
                    <h4 class="text-2xl font-bold text-gray-900 dark:text-white">
                        @lang("Alternative Medicine Services")
                        <span class="inline-flex items-center px-3 py-1 ml-2 text-sm font-medium text-white bg-blue-600 rounded-full">{{ $medicalalters->total() }}</span>
                    </h4>
                    @if(request()->hasAny(['search', 'type', 'sort']))
                        <p class="text-gray-500 dark:text-gray-400 mt-1">
                            @if(request('search'))
                                @lang("Search for"): "{{ request('search') }}"
                            @endif
                            @if(request('type'))
                                • @lang("Type"): {{ request('type') }}
                            @endif
                            @if(request('sort'))
                                • @lang("Sorted by"): {{ request('sort') }}
                            @endif
                        </p>
                    @endif
                </div>

                <!-- Medical Alters Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($medicalalters as $medicalalter)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl hover:transform hover:-translate-y-2 transition-all duration-300 border border-blue-100 dark:border-blue-900">
                            <!-- Image -->
                            @if($medicalalter->image)
                                <div class="relative">
                                    <img src="{{ asset($medicalalter->image) }}" 
                                         alt="{{ $medicalalter->name }}" 
                                         class="w-full h-48 object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-600 text-white">
                                            {{ $medicalalter->type }}
                                        </span>
                                    </div>
                                </div>
                            @else
                                <div class="h-48 bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-900 dark:to-blue-800 flex items-center justify-center">
                                    <div class="text-center">
                                        <i class="fas fa-leaf text-4xl text-blue-600 dark:text-blue-300 mb-2"></i>
                                        <span class="block text-xs font-medium bg-blue-600 text-white px-3 py-1 rounded-full">
                                            {{ $medicalalter->type }}
                                        </span>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Content -->
                            <div class="p-6">
                                <h5 class="text-xl font-bold text-gray-900 dark:text-white mb-3">{{ $medicalalter->name }}</h5>
                                
                                @if($medicalalter->intro)
                                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-3">
                                        {{ Str::limit($medicalalter->intro, 120) }}
                                    </p>
                                @endif

                                <!-- Benefits Preview -->
                                @if($medicalalter->benefits)
                                    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-3 mb-4">
                                        <h6 class="text-sm font-semibold text-blue-900 dark:text-blue-300 mb-1">
                                            <i class="fas fa-heart mr-1"></i>@lang("Key Benefits")
                                        </h6>
                                        <p class="text-xs text-blue-800 dark:text-blue-400">
                                            {{ Str::limit($medicalalter->benefits, 80) }}
                                        </p>
                                    </div>
                                @endif

                                <!-- Action Button -->
                                <a href="{{ route('frontend.medicalalters.show', [encode_id($medicalalter->id), $medicalalter->slug]) }}" 
                                   class="w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-4 rounded-lg transition-colors text-sm font-medium block">
                                    <i class="fas fa-eye mr-1"></i>@lang("Learn More")
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-2xl shadow-lg">
                                <div class="text-6xl text-gray-400 mb-6">
                                    <i class="fas fa-leaf"></i>
                                </div>
                                <h4 class="text-2xl font-bold text-gray-500 dark:text-gray-400 mb-4">@lang("No Alternative Medicine Found")</h4>
                                <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-md mx-auto">
                                    @if(request()->hasAny(['search', 'type', 'sort']))
                                        @lang("No services match your search criteria. Try adjusting your filters.")
                                    @else
                                        @lang("No alternative medicine services are available at the moment.")
                                    @endif
                                </p>
                                @if(request()->hasAny(['search', 'type', 'sort']))
                                    <a href="{{ route('frontend.medicalalters.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                                        <i class="fas fa-undo mr-2"></i>@lang("Clear Filters")
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($medicalalters->hasPages())
                    <div class="mt-12 flex justify-center">
                        {{ $medicalalters->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@include('frontend.includes.messages')
@endsection

@push('after-styles')
<style>
/* Line clamp utility */
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
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

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, rgb(37 99 235), rgb(29 78 216));
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, rgb(29 78 216), rgb(30 64 175));
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