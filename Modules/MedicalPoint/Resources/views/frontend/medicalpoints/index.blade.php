@extends('frontend.layouts.app')

@section('title') {{ __($module_title) }} @endsection

@section('content')
<!-- Hero Section with Keraton Background -->
<section class="relative h-96 overflow-hidden">
    <!-- Keraton Background -->
    <div class="absolute inset-0">
        <img class="w-full h-full object-cover" src="{{ asset('img/Wallpaper/wallpaperkeraton.jpg') }}" alt="Keraton Yogyakarta">
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/80 via-blue-500/60 to-blue-700/80"></div>
    </div>
    
    <!-- Content -->
    <div class="relative z-10 h-full flex items-center">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl">
                <div class="inline-block bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 mb-4">
                    <span class="text-white text-sm font-medium">📍 @lang('Medical Points in Yogyakarta')</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 leading-tight">
                    Medical
                    <span class="block text-blue-200">Points Hub</span>
                </h1>
                <p class="text-lg text-gray-200 mb-6 max-w-2xl">
                    @lang('Find medical points, clinics, pharmacies and health centers in Yogyakarta with comprehensive location information.')
                </p>
                
                <!-- Quick Stats -->
                @php
                    $clinic_count = $medicalpoints->where('type', 'Clinic')->count();
                    $puskesmas_count = $medicalpoints->where('type', 'Public health center')->count();
                    $pharmacy_count = $medicalpoints->where('type', 'Pharmacy')->count();
                    $total_types = collect([$clinic_count > 0 ? 1 : 0, $puskesmas_count > 0 ? 1 : 0, $pharmacy_count > 0 ? 1 : 0])->sum();
                @endphp
                <div class="flex flex-wrap gap-4 mb-6">
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2">
                        <div class="text-xl font-bold text-white">{{ $medicalpoints->total() }}</div>
                        <div class="text-blue-200 text-sm">@lang('Total Points')</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2">
                        <div class="text-xl font-bold text-white">{{ $total_types }}</div>
                        <div class="text-blue-200 text-sm">@lang('Point Types')</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2">
                        <div class="text-xl font-bold text-white">{{ $districts->count() }}</div>
                        <div class="text-blue-200 text-sm">@lang('Districts')</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2">
                        <div class="text-xl font-bold text-white">24/7</div>
                        <div class="text-blue-200 text-sm">@lang('Info Available')</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white animate-bounce">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
        </svg>
    </div>
    
    @include('frontend.includes.messages')
</section>

<!-- Advanced Search & Filter Section -->
<section id="filters" class="bg-gray-50 dark:bg-gray-900 py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8">
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">
                    <i class="fas fa-search text-blue-600 mr-2"></i>Find Your Perfect Medical Point
                </h3>
                
                <form action="{{ route('frontend.medicalpoints.index') }}" method="GET" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Search Input -->
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search Points</label>
                            <div class="relative">
                                <input type="text" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Search by name, location..." 
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 dark:text-white transition duration-200">
                                <i class="fas fa-search absolute left-3 top-4 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Type Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Facility Type</label>
                            <select name="type" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 dark:text-white transition duration-200">
                                <option value="">All Types</option>
                                <option value="Clinic" {{ request('type') == 'Clinic' ? 'selected' : '' }}>Clinic</option>
                                <option value="Public health center" {{ request('type') == 'Public health center' ? 'selected' : '' }}>Public Health Center</option>
                                <option value="Pharmacy" {{ request('type') == 'Pharmacy' ? 'selected' : '' }}>Pharmacy</option>
                            </select>
                        </div>

                        <!-- District Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">District</label>
                            <select name="district" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 dark:text-white transition duration-200">
                                <option value="">All Districts</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district }}" {{ request('district') == $district ? 'selected' : '' }}>{{ $district }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Sub District Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sub District</label>
                            <select name="sub_district" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 dark:text-white transition duration-200">
                                <option value="">All Sub Districts</option>
                            </select>
                        </div>
                        
                        <!-- Sort Options -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sort By</label>
                            <select name="sort" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 dark:text-white transition duration-200">
                                <option value="">Default</option>
                                <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Most Recent</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-end gap-3">
                            <button type="submit" class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                                <i class="fas fa-search mr-2"></i>Search
                            </button>
                            <a href="{{ route('frontend.medicalpoints.index') }}" class="px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg font-semibold hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                                <i class="fas fa-undo mr-2"></i>Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Main Content with Sidebar Layout -->
<section id="medical-points" class="bg-gray-50 dark:bg-gray-900 min-h-screen py-12">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filters -->
            <div class="lg:w-80 space-y-6">
                <!-- Search Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 sticky top-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <div class="w-8 h-8 bg-indigo-500 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        @lang('Search & Filter')
                    </h3>
                    
                    <form action="{{ route('frontend.medicalpoints.index') }}" method="GET" class="space-y-4" id="filterForm">
                        <!-- Search Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">@lang('Search Points')</label>
                            <div class="relative">
                                <input type="text" name="search" value="{{ request('search') }}" 
                                       placeholder="@lang('Point name, location...')" 
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white dark:bg-gray-700 dark:text-white">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Type Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">@lang('Facility Type')</label>
                            <div class="space-y-2">
                                @php
                                $types = [
                                    ['value' => '', 'label' => __('All Types'), 'color' => 'gray', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
                                    ['value' => 'Clinic', 'label' => __('Clinic'), 'color' => 'indigo', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                    ['value' => 'Public health center', 'label' => __('Public Health Center'), 'color' => 'purple', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                                    ['value' => 'Pharmacy', 'label' => __('Pharmacy'), 'color' => 'blue', 'icon' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z']
                                ];
                                @endphp
                                
                                @foreach($types as $type)
                                <label class="flex items-center p-3 rounded-lg border-2 cursor-pointer transition-all duration-200 {{ request('type') == $type['value'] ? 'border-'.$type['color'].'-500 bg-'.$type['color'].'-50 dark:bg-'.$type['color'].'-900/20' : 'border-gray-200 dark:border-gray-600 hover:border-'.$type['color'].'-300' }}">
                                    <input type="radio" name="type" value="{{ $type['value'] }}" {{ request('type') == $type['value'] ? 'checked' : '' }} class="sr-only">
                                    <div class="w-8 h-8 bg-{{ $type['color'] }}-500 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="{{ $type['icon'] }}"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $type['label'] }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- District Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">@lang('District')</label>
                            <select name="district" id="district" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white dark:bg-gray-700 dark:text-white">
                                <option value="">@lang('All Districts')</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district }}" {{ request('district') == $district ? 'selected' : '' }}>{{ $district }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Sub District Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">@lang('Sub District')</label>
                            <select name="sub_district" id="sub_district" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white dark:bg-gray-700 dark:text-white">
                                <option value="">@lang('All Sub Districts')</option>
                            </select>
                        </div>
                        
                        <!-- Sort Options -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">@lang('Sort By')</label>
                            <select name="sort" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white dark:bg-gray-700 dark:text-white">
                                <option value="">@lang('Default')</option>
                                <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>@lang('Most Recent')</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>@lang('Oldest First')</option>
                            </select>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="space-y-3 pt-4">
                            <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                @lang('Apply Filters')
                            </button>
                            <a href="{{ route('frontend.medicalpoints.index') }}" class="w-full bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-medium py-3 px-4 rounded-lg transition-all duration-200 text-center block">
                                @lang('Reset Filters')
                            </a>
                        </div>
                    </form>
                </div>
                
                <!-- Quick Info -->
                <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl p-6 text-white">
                    <h4 class="font-bold mb-2">💡 @lang('Search Tips')</h4>
                    <ul class="text-sm space-y-1 text-indigo-100">
                        <li>• @lang('Filter by facility type')</li>
                        <li>• @lang('Search by district')</li>
                        <li>• @lang('Check location details')</li>
                    </ul>
                </div>
            </div>
            
            <!-- Main Content Area -->
            <div class="flex-1">
                <!-- View Controls and Results Info -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                            @lang('Medical Points')
                        </h2>
                        <p class="text-gray-600 dark:text-gray-400">
                            @lang('Found') {{ $medicalpoints->total() }} @lang('points')
                            @if(request('search')) @lang('for') "<span class="font-medium">{{ request('search') }}</span>" @endif
                            @if(request('type')) @lang('in') <span class="font-medium">{{ request('type') }}</span> @lang('category') @endif
                        </p>
                    </div>
                    
                    <!-- View Toggle -->
                    <div class="flex items-center mt-4 sm:mt-0">
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-1 shadow-lg">
                            <button onclick="toggleView('masonry')" id="masonryBtn" class="px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 view-btn active">
                                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                </svg>
                                @lang('Masonry')
                            </button>
                            <button onclick="toggleView('list')" id="listBtn" class="px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 view-btn">
                                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"/>
                                </svg>
                                @lang('List')
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Cards Container -->
                @if($medicalpoints->count() > 0)
                    <!-- Masonry View (Default) -->
                    <div id="masonryView" class="masonry-container">
                        @foreach ($medicalpoints as $index => $medicalpoint)
                        @php
                        $details_url = route("frontend.medicalpoints.show", [encode_id($medicalpoint->id), $medicalpoint->slug]);
                        $colors = [
                            'Clinic' => ['bg' => 'from-indigo-500 to-indigo-600', 'text' => 'text-indigo-600', 'light' => 'bg-indigo-50', 'dark' => 'bg-indigo-900/20'],
                            'Public health center' => ['bg' => 'from-purple-500 to-purple-600', 'text' => 'text-purple-600', 'light' => 'bg-purple-50', 'dark' => 'bg-purple-900/20'],
                            'Pharmacy' => ['bg' => 'from-blue-500 to-blue-600', 'text' => 'text-blue-600', 'light' => 'bg-blue-50', 'dark' => 'bg-blue-900/20']
                        ];
                        $color = $colors[$medicalpoint->type] ?? ['bg' => 'from-gray-500 to-gray-600', 'text' => 'text-gray-600', 'light' => 'bg-gray-50', 'dark' => 'bg-gray-900/20'];
                        $heights = ['h-64', 'h-72', 'h-80', 'h-56'];
                        $randomHeight = $heights[$index % 4];
                        @endphp
                        
                        <article class="masonry-item group bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 dark:border-gray-700 mb-6 transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                            <!-- Image -->
                            <div class="relative {{ $randomHeight }} overflow-hidden">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                                     src="{{ asset($medicalpoint->image) }}" 
                                     alt="{{ $medicalpoint->name }}"
                                     loading="lazy">
                                
                                <!-- Gradient Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t {{ $color['bg'] }} opacity-0 group-hover:opacity-70 transition-opacity duration-300"></div>
                                
                                <!-- Floating Actions -->
                                <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="flex flex-col gap-2">
                                        <a href="{{ $details_url }}" class="bg-white/90 hover:bg-white text-gray-900 p-2 rounded-full shadow-lg">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </a>
                                        @if($medicalpoint->maps)
                                        <a href="{{ $medicalpoint->maps }}" target="_blank" class="bg-white/90 hover:bg-white text-gray-900 p-2 rounded-full shadow-lg">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Type Badge -->
                                <div class="absolute top-4 left-4">
                                    <span class="bg-gradient-to-r {{ $color['bg'] }} text-white text-xs font-semibold px-3 py-1.5 rounded-full shadow-lg">
                                        {{ $medicalpoint->type }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:{{ $color['text'] }} transition-colors duration-200">
                                    {{ $medicalpoint->name }}
                                </h3>
                                
                                @if($medicalpoint->district || $medicalpoint->sub_district)
                                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-3">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    @if($medicalpoint->sub_district){{ $medicalpoint->sub_district }}, @endif{{ $medicalpoint->district }}
                                </div>
                                @endif
                                
                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3">
                                    {{ $medicalpoint->description ?? $medicalpoint->intro }}
                                </p>
                                
                                <!-- Meta & Action -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $medicalpoint->created_at->format('M d, Y') }}
                                    </div>
                                    <a href="{{ $details_url }}" class="text-sm font-medium {{ $color['text'] }} hover:underline">
                                        @lang('View Details') →
                                    </a>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>
                    
                    <!-- List View (Hidden by default) -->
                    <div id="listView" class="space-y-6 hidden">
                        @foreach ($medicalpoints as $medicalpoint)
                        @php
                        $details_url = route("frontend.medicalpoints.show", [encode_id($medicalpoint->id), $medicalpoint->slug]);
                        $colors = [
                            'Clinic' => ['bg' => 'from-indigo-500 to-indigo-600', 'text' => 'text-indigo-600'],
                            'Public health center' => ['bg' => 'from-purple-500 to-purple-600', 'text' => 'text-purple-600'],
                            'Pharmacy' => ['bg' => 'from-blue-500 to-blue-600', 'text' => 'text-blue-600']
                        ];
                        $color = $colors[$medicalpoint->type] ?? ['bg' => 'from-gray-500 to-gray-600', 'text' => 'text-gray-600'];
                        @endphp
                        
                        <article class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 dark:border-gray-700">
                            <div class="md:flex">
                                <!-- Image -->
                                <div class="md:w-64 h-48 md:h-auto relative overflow-hidden">
                                    <img class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" 
                                         src="{{ asset($medicalpoint->image) }}" 
                                         alt="{{ $medicalpoint->name }}">
                                    <div class="absolute top-4 left-4">
                                        <span class="bg-gradient-to-r {{ $color['bg'] }} text-white text-xs font-semibold px-3 py-1.5 rounded-full">
                                            {{ $medicalpoint->type }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Content -->
                                <div class="flex-1 p-6">
                                    <div class="flex flex-col h-full">
                                        <div class="flex-1">
                                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                                                {{ $medicalpoint->name }}
                                            </h3>
                                            
                                            @if($medicalpoint->district || $medicalpoint->sub_district)
                                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-3">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                </svg>
                                                @if($medicalpoint->sub_district){{ $medicalpoint->sub_district }}, @endif{{ $medicalpoint->district }}
                                            </div>
                                            @endif
                                            
                                            <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">
                                                {{ $medicalpoint->description ?? $medicalpoint->intro }}
                                            </p>
                                        </div>
                                        
                                        <!-- Footer -->
                                        <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
                                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                {{ $medicalpoint->created_at->format('M d, Y') }}
                                            </div>
                                            <div class="flex gap-2">
                                                @if($medicalpoint->maps)
                                                <a href="{{ $medicalpoint->maps }}" target="_blank" class="bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300 px-3 py-2 rounded-lg font-medium transition-all duration-200">
                                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    </svg>
                                                    @lang('Maps')
                                                </a>
                                                @endif
                                                <a href="{{ $details_url }}" class="bg-gradient-to-r {{ $color['bg'] }} text-white px-4 py-2 rounded-lg font-medium hover:shadow-lg transition-all duration-200">
                                                    @lang('View Details')
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div class="max-w-md mx-auto">
                            <div class="w-24 h-24 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">@lang('No Points Found')</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-6">
                                @lang('Sorry, no medical points match your search criteria.')
                            </p>
                            <a href="{{ route('frontend.medicalpoints.index') }}" 
                               class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                @lang('Reset Search')
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Pagination -->
                @if($medicalpoints->hasPages())
                    <div class="mt-12 flex justify-center">
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                            {{ $medicalpoints->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection

@push('after-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // View toggle functionality
    window.toggleView = function(viewType) {
        const masonryView = document.getElementById('masonryView');
        const listView = document.getElementById('listView');
        const masonryBtn = document.getElementById('masonryBtn');
        const listBtn = document.getElementById('listBtn');
        
        if (viewType === 'masonry') {
            masonryView.classList.remove('hidden');
            listView.classList.add('hidden');
            masonryBtn.classList.add('active');
            listBtn.classList.remove('active');
            localStorage.setItem('preferredView', 'masonry');
            
            setTimeout(initMasonry, 100);
        } else {
            masonryView.classList.add('hidden');
            listView.classList.remove('hidden');
            masonryBtn.classList.remove('active');
            listBtn.classList.add('active');
            localStorage.setItem('preferredView', 'list');
        }
    };
    
    // Initialize masonry layout
    function initMasonry() {
        const container = document.querySelector('.masonry-container');
        if (!container) return;
        
        container.style.columnCount = '';
        container.style.columnGap = '';
        
        if (window.innerWidth >= 1024) {
            container.style.columnCount = '3';
        } else if (window.innerWidth >= 768) {
            container.style.columnCount = '2';
        } else {
            container.style.columnCount = '1';
        }
        container.style.columnGap = '2rem';
        
        const items = container.querySelectorAll('.masonry-item');
        items.forEach(item => {
            item.style.breakInside = 'avoid';
            item.style.pageBreakInside = 'avoid';
            item.style.display = 'inline-block';
            item.style.width = '100%';
        });
    }
    
    // District & Sub-district functionality
    const districtSelect = document.getElementById('district');
    const subDistrictSelect = document.getElementById('sub_district');
    const subDistricts = @json($sub_districts);

    districtSelect.addEventListener('change', function() {
        const selectedDistrict = this.value;
        subDistrictSelect.innerHTML = '<option value="">@lang("All Sub Districts")</option>';

        if (selectedDistrict && subDistricts[selectedDistrict]) {
            subDistricts[selectedDistrict].forEach(subDistrict => {
                const option = document.createElement('option');
                option.value = subDistrict;
                option.textContent = subDistrict;
                subDistrictSelect.appendChild(option);
            });
        }
    });

    // Set initial value for sub_district if district is already selected
    if (districtSelect.value) {
        districtSelect.dispatchEvent(new Event('change'));
        subDistrictSelect.value = '{{ request('sub_district') }}';
    }
    
    // Restore preferred view from localStorage
    const preferredView = localStorage.getItem('preferredView') || 'masonry';
    toggleView(preferredView);
    
    // Handle window resize for masonry
    window.addEventListener('resize', function() {
        if (!document.getElementById('masonryView').classList.contains('hidden')) {
            initMasonry();
        }
    });
    
    // Auto-submit form on filter change
    const filterForm = document.getElementById('filterForm');
    const typeInputs = filterForm.querySelectorAll('input[name="type"]');
    
    typeInputs.forEach(input => {
        input.addEventListener('change', function() {
            this.closest('label').classList.add('animate-pulse');
            setTimeout(() => {
                this.closest('label').classList.remove('animate-pulse');
            }, 300);
        });
    });
    
    // Smooth scroll to results when filtering
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('search') || urlParams.get('type') || urlParams.get('sort') || urlParams.get('district')) {
        setTimeout(() => {
            document.querySelector('.flex-1')?.scrollIntoView({ 
                behavior: 'smooth', 
                block: 'start' 
            });
        }, 100);
    }
    
    // Add loading states to form submission
    filterForm.addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        if (submitBtn) {
            const originalContent = submitBtn.innerHTML;
            submitBtn.innerHTML = `
                <svg class="w-5 h-5 inline mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                @lang('Searching...')
            `;
            submitBtn.disabled = true;
        }
    });
    
    // Intersection Observer for animations
    if ('IntersectionObserver' in window) {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-up');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.masonry-item, article').forEach(card => {
            observer.observe(card);
        });
    }
    
    // Enhanced search input functionality
    const searchInput = filterForm.querySelector('input[name="search"]');
    if (searchInput) {
        let searchTimeout;
        
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const value = this.value;
            
            if (value.length > 0) {
                this.parentNode.classList.add('border-indigo-500');
            } else {
                this.parentNode.classList.remove('border-indigo-500');
            }
            
            searchTimeout = setTimeout(() => {
                if (value.length >= 3 || value.length === 0) {
                    // Could implement live search here
                }
            }, 500);
        });
    }
    
    // Add keyboard navigation support
    document.addEventListener('keydown', function(e) {
        // ESC to clear search
        if (e.key === 'Escape' && searchInput) {
            searchInput.value = '';
            searchInput.focus();
        }
        
        // Alt+1 for masonry view
        if (e.altKey && e.key === '1') {
            e.preventDefault();
            toggleView('masonry');
        }
        
        // Alt+2 for list view
        if (e.altKey && e.key === '2') {
            e.preventDefault();
            toggleView('list');
        }
    });
    
    // Initialize everything
    initMasonry();
});
</script>
@endpush

@push('after-styles')
<style>
/* Masonry Layout */
.masonry-container {
    column-gap: 2rem;
    transition: all 0.3s ease;
}

.masonry-item {
    break-inside: avoid;
    page-break-inside: avoid;
    display: inline-block;
    width: 100%;
    margin-bottom: 2rem;
}

/* View Toggle Buttons */
.view-btn {
    background: transparent;
    color: #6B7280;
}

.view-btn.active {
    background: #6366F1;
    color: white;
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
}

.view-btn:hover:not(.active) {
    background: #F3F4F6;
    color: #374151;
}

/* Custom Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.6s ease-out forwards;
}

/* Scroll indicator animation */
@keyframes bounce {
    0%, 20%, 53%, 80%, 100% {
        transform: translate(-50%, 0);
    }
    40%, 43% {
        transform: translate(-50%, -10px);
    }
    70% {
        transform: translate(-50%, -5px);
    }
    90% {
        transform: translate(-50%, -2px);
    }
}

.animate-bounce {
    animation: bounce 2s infinite;
}

/* Enhanced hover effects */
.hover-lift {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.hover-lift:hover {
    transform: translateY(-8px) scale(1.02);
}

/* Custom focus states */
input:focus, select:focus, button:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

/* Gradient overlays */
.gradient-overlay {
    background: linear-gradient(135deg, rgba(99, 102, 241, 0.8) 0%, rgba(139, 92, 246, 0.8) 100%);
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 10px;
}

::-webkit-scrollbar-track {
    background: #F1F5F9;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #6366F1, #8B5CF6);
    border-radius: 10px;
    border: 2px solid #F1F5F9;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #4F46E5, #7C3AED);
}

/* Dark mode scrollbar */
.dark ::-webkit-scrollbar-track {
    background: #374151;
}

.dark ::-webkit-scrollbar-thumb {
    border-color: #374151;
}

/* Radio button custom styling */
input[type="radio"]:checked + div {
    transform: scale(1.1);
}

/* Loading spinner animation */
@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.animate-spin {
    animation: spin 1s linear infinite;
}

/* Pulse animation for feedback */
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: .5;
    }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

/* Text truncation */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Responsive breakpoints */
@media (max-width: 1024px) {
    .masonry-container {
        column-count: 2 !important;
    }
}

@media (max-width: 768px) {
    .masonry-container {
        column-count: 1 !important;
    }
    
    .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    .lg\:w-80 {
        width: 100%;
    }
    
    .text-5xl {
        font-size: 2.5rem;
    }
    
    .md\:text-7xl {
        font-size: 3rem;
    }
}

@media (max-width: 640px) {
    .h-96 {
        height: 20rem;
    }
    
    .text-xl {
        font-size: 1rem;
    }
    
    .py-12 {
        padding-top: 2rem;
        padding-bottom: 2rem;
    }
}

/* Print styles */
@media print {
    .sticky, .view-btn, .no-print {
        display: none !important;
    }
    
    .masonry-container {
        column-count: 1 !important;
    }
    
    body {
        background: white !important;
        color: black !important;
    }
}

/* High contrast mode */
@media (prefers-contrast: high) {
    .bg-gradient-to-r, .bg-gradient-to-br {
        background: #000 !important;
        color: #fff !important;
    }
    
    .border-gray-200 {
        border-color: #000 !important;
    }
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

/* Backdrop blur support */
@supports (backdrop-filter: blur(10px)) {
    .backdrop-blur-sm {
        backdrop-filter: blur(4px);
    }
}

/* Custom gradient backgrounds */
.bg-indigo-gradient {
    background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%);
}

.bg-purple-gradient {
    background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
}

/* Enhanced card shadows */
.card-shadow {
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.card-shadow:hover {
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

/* Custom border radius */
.rounded-2xl {
    border-radius: 1rem;
}

/* Smooth transitions for all interactive elements */
a, button, input, select, .transition-all {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Loading state overlay */
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.dark .loading-overlay {
    background: rgba(17, 24, 39, 0.9);
}
</style>
@endpush