@extends('frontend.layouts.app')

@section('title') @lang("Medical Costs Hub") @endsection

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden bg-cover bg-center min-h-screen flex items-center" style="background-image: url('{{ asset('img/Wallpaper/wallpaperkeraton.jpg') }}');">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-600/90 via-blue-500/85 to-blue-800/85"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center text-white max-w-4xl mx-auto">
            <h1 class="text-5xl md:text-7xl font-bold mb-6">@lang("Medical Costs Hub")</h1>
            <p class="text-xl md:text-2xl mb-8">@lang("Discover transparent medical service costs and price ranges across Yogyakarta healthcare facilities")</p>
            
            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-6 text-center">
                    <div class="text-4xl font-bold text-white">{{ $medicalcosts->total() }}</div>
                    <div class="text-white/90 mt-2">@lang("Medical Services")</div>
                </div>
                <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-6 text-center">
                    <div class="text-4xl font-bold text-white">
                        @if($medicalcosts->count() > 0)
                            Rp {{ number_format($medicalcosts->avg('lowest_price'), 0, ',', '.') }}
                        @else
                            N/A
                        @endif
                    </div>
                    <div class="text-white/90 mt-2">@lang("Avg. Starting Price")</div>
                </div>
                <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-6 text-center">
                    <div class="text-4xl font-bold text-white">24/7</div>
                    <div class="text-white/90 mt-2">@lang("Price Transparency")</div>
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
                        <form action="{{ route('frontend.medicalcosts.index') }}" method="GET" class="space-y-4">
                            <!-- Search Input -->
                            <div>
                                <label class="block font-medium text-gray-700 dark:text-gray-300 mb-2">@lang("Search Medical Services")</label>
                                <input type="text" 
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" 
                                       name="search" 
                                       value="{{ request('search') }}" 
                                       placeholder="@lang('Enter service name...')">
                            </div>

                            <!-- Price Range -->
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-sm text-gray-600 dark:text-gray-400 mb-1">@lang("Min Price")</label>
                                    <input type="number" 
                                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" 
                                           name="min_price" 
                                           value="{{ request('min_price') }}" 
                                           placeholder="0">
                                </div>
                                <div>
                                    <label class="block text-sm text-gray-600 dark:text-gray-400 mb-1">@lang("Max Price")</label>
                                    <input type="number" 
                                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" 
                                           name="max_price" 
                                           value="{{ request('max_price') }}" 
                                           placeholder="No limit">
                                </div>
                            </div>

                            <!-- Sort Options -->
                            <div>
                                <label class="block font-medium text-gray-700 dark:text-gray-300 mb-2">@lang("Sort By")</label>
                                <select class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" name="sort">
                                    <option value="">@lang("Default")</option>
                                    <option value="lowest_price" {{ request('sort') == 'lowest_price' ? 'selected' : '' }}>@lang("Lowest Price First")</option>
                                    <option value="highest_price" {{ request('sort') == 'highest_price' ? 'selected' : '' }}>@lang("Highest Price First")</option>
                                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>@lang("Name A-Z")</option>
                                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>@lang("Name Z-A")</option>
                                </select>
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-3">
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                                    <i class="fas fa-search mr-2"></i>@lang("Apply Filters")
                                </button>
                                <a href="{{ route('frontend.medicalcosts.index') }}" class="w-full bg-white hover:bg-gray-50 text-blue-600 border border-blue-600 font-medium py-3 px-4 rounded-lg transition-colors text-center block">
                                    <i class="fas fa-undo mr-2"></i>@lang("Clear Filters")
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="w-full lg:w-3/4">
                <!-- Results Header -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-8">
                    <h4 class="text-2xl font-bold text-gray-900 dark:text-white">
                        @lang("Medical Costs")
                        <span class="inline-flex items-center px-3 py-1 ml-2 text-sm font-medium text-white bg-blue-600 rounded-full">{{ $medicalcosts->total() }}</span>
                    </h4>
                    @if(request()->hasAny(['search', 'min_price', 'max_price']))
                        <p class="text-gray-500 dark:text-gray-400 mt-1">
                            @if(request('search'))
                                @lang("Search for"): "{{ request('search') }}"
                            @endif
                            @if(request('min_price'))
                                • @lang("Min"): Rp {{ number_format(request('min_price'), 0, ',', '.') }}
                            @endif
                            @if(request('max_price'))
                                • @lang("Max"): Rp {{ number_format(request('max_price'), 0, ',', '.') }}
                            @endif
                        </p>
                    @endif
                </div>

                <!-- Medical Costs Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($medicalcosts as $medicalcost)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl hover:transform hover:-translate-y-2 transition-all duration-300 border border-blue-100 dark:border-blue-900">
                            <!-- Header -->
                            <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                                <h5 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $medicalcost->name }}</h5>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                    <i class="fas fa-dollar-sign mr-1"></i>@lang("Medical Service")
                                </span>
                            </div>
                            
                            <!-- Price Information -->
                            <div class="p-6">
                                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4 mb-4">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="text-center">
                                            <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">@lang("Starting Price")</div>
                                            <div class="text-lg font-bold text-blue-600">
                                                Rp {{ number_format($medicalcost->lowest_price, 0, ',', '.') }}
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">@lang("Upper Range")</div>
                                            <div class="text-lg font-bold text-blue-800">
                                                Rp {{ number_format($medicalcost->highest_price, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Button -->
                                <a href="{{ route('frontend.medicalcosts.show', [encode_id($medicalcost->id), Str::slug($medicalcost->name)]) }}" 
                                   class="w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-4 rounded-lg transition-colors text-sm font-medium block">
                                    <i class="fas fa-eye mr-1"></i>@lang("View Details")
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-2xl shadow-lg">
                                <div class="text-6xl text-gray-400 mb-6">
                                    <i class="fas fa-search-dollar"></i>
                                </div>
                                <h4 class="text-2xl font-bold text-gray-500 dark:text-gray-400 mb-4">@lang("No Medical Costs Found")</h4>
                                <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-md mx-auto">
                                    @if(request()->hasAny(['search', 'min_price', 'max_price']))
                                        @lang("No costs match your search criteria. Try adjusting your filters.")
                                    @else
                                        @lang("No medical costs are available at the moment.")
                                    @endif
                                </p>
                                @if(request()->hasAny(['search', 'min_price', 'max_price']))
                                    <a href="{{ route('frontend.medicalcosts.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                                        <i class="fas fa-undo mr-2"></i>@lang("Clear Filters")
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($medicalcosts->hasPages())
                    <div class="mt-12 flex justify-center">
                        {{ $medicalcosts->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@include('frontend.includes.messages')
@endsection 