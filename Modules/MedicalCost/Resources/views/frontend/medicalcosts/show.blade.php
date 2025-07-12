@extends('frontend.layouts.app')

@section('title') {{ $medicalcost->name }} - @lang("Medical Costs") @endsection

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
                    <li><a href="{{ route('frontend.medicalcosts.index') }}" class="hover:text-white">@lang("Medical Costs")</a></li>
                    <li><i class="fas fa-chevron-right mx-2"></i></li>
                    <li class="text-white">{{ $medicalcost->name }}</li>
                </ol>
            </nav>

            <h1 class="text-4xl md:text-6xl font-bold mb-6">{{ $medicalcost->name }}</h1>
            
            <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-lg border border-white/20 rounded-full text-white mb-6">
                <i class="fas fa-dollar-sign mr-2"></i>
                <span class="font-medium">@lang("Medical Service Cost")</span>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-12 bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content -->
            <div class="w-full lg:w-2/3">
                <!-- Price Overview -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                        <i class="fas fa-chart-line text-blue-600 mr-3"></i>
                        @lang("Price Overview")
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Starting Price -->
                        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-6 text-center">
                            <div class="text-blue-600 mb-2">
                                <i class="fas fa-arrow-down text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">@lang("Starting Price")</h3>
                            <div class="text-3xl font-bold text-blue-600 mb-2">
                                Rp {{ number_format($medicalcost->lowest_price, 0, ',', '.') }}
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">@lang("Minimum cost for this service")</p>
                        </div>

                        <!-- Maximum Price -->
                        <div class="bg-blue-100 dark:bg-blue-800/30 rounded-xl p-6 text-center">
                            <div class="text-blue-800 mb-2">
                                <i class="fas fa-arrow-up text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">@lang("Upper Range")</h3>
                            <div class="text-3xl font-bold text-blue-800 mb-2">
                                Rp {{ number_format($medicalcost->highest_price, 0, ',', '.') }}
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">@lang("Maximum expected cost")</p>
                        </div>
                    </div>

                    <!-- Price Analysis -->
                    <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                            <div>
                                <div class="text-lg font-bold text-gray-900 dark:text-white">
                                    Rp {{ number_format($medicalcost->highest_price - $medicalcost->lowest_price, 0, ',', '.') }}
                                </div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">@lang("Price Range")</div>
                            </div>
                            <div>
                                <div class="text-lg font-bold text-gray-900 dark:text-white">
                                    Rp {{ number_format(($medicalcost->lowest_price + $medicalcost->highest_price) / 2, 0, ',', '.') }}
                                </div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">@lang("Average Price")</div>
                            </div>
                            <div>
                                <div class="text-lg font-bold text-gray-900 dark:text-white">
                                    {{ $medicalcost->lowest_price > 0 ? number_format((($medicalcost->highest_price - $medicalcost->lowest_price) / $medicalcost->lowest_price) * 100, 1) : '0' }}%
                                </div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">@lang("Price Variation")</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service Information -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                        <i class="fas fa-info-circle text-blue-600 mr-3"></i>
                        @lang("Service Information")
                    </h2>

                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">@lang("Service Name")</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-lg">{{ $medicalcost->name }}</p>
                        </div>

                        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4">
                            <h4 class="text-md font-semibold text-blue-900 dark:text-blue-300 mb-2 flex items-center">
                                <i class="fas fa-shield-alt mr-2"></i>@lang("Insurance Coverage")
                            </h4>
                            <p class="text-sm text-blue-800 dark:text-blue-400">
                                @lang("Prices may vary depending on your insurance coverage. BPJS Kesehatan and private insurance may cover part or all of the costs.")
                            </p>
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
                            <span class="text-gray-600 dark:text-gray-400">@lang("Service"):</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $medicalcost->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">@lang("Min Price"):</span>
                            <span class="font-medium text-blue-600">Rp {{ number_format($medicalcost->lowest_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">@lang("Max Price"):</span>
                            <span class="font-medium text-blue-800">Rp {{ number_format($medicalcost->highest_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">@lang("Actions")</h3>
                    <div class="space-y-3">
                        <a href="{{ route('frontend.medicalcosts.index') }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-4 rounded-lg transition-colors font-medium block">
                            <i class="fas fa-arrow-left mr-2"></i>@lang("Back to List")
                        </a>
                        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-4 rounded-lg transition-colors font-medium" onclick="window.print()">
                            <i class="fas fa-print mr-2"></i>@lang("Print Info")
                        </button>
                        <button class="w-full bg-gray-600 hover:bg-gray-700 text-white text-center py-3 px-4 rounded-lg transition-colors font-medium" onclick="if(navigator.share) navigator.share({title: '{{ $medicalcost->name }}', url: window.location.href})">
                            <i class="fas fa-share mr-2"></i>@lang("Share")
                        </button>
                    </div>
                </div>

                <!-- Related Services -->
                @if(isset($relatedCosts) && $relatedCosts->count() > 0)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <i class="fas fa-list text-blue-600 mr-2"></i>
                        @lang("Related Services")
                    </h3>
                    <div class="space-y-3">
                        @foreach($relatedCosts->take(4) as $related)
                        <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-3">
                            <h5 class="font-medium text-gray-900 dark:text-white text-sm mb-1">{{ $related->name }}</h5>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                Rp {{ number_format($related->lowest_price, 0, ',', '.') }} - 
                                Rp {{ number_format($related->highest_price, 0, ',', '.') }}
                            </p>
                            <a href="{{ route('frontend.medicalcosts.show', [encode_id($related->id), Str::slug($related->name)]) }}" class="text-blue-600 hover:text-blue-700 text-xs">
                                @lang("View Details") →
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@include('frontend.includes.messages')
@endsection