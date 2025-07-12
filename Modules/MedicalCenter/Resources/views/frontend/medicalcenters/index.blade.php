@extends('frontend.layouts.app')

@section('title') @lang("Medical Centers Hub") @endsection

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
                    <span class="text-white text-sm font-medium">🏥 @lang('Medical Centers in Yogyakarta')</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 leading-tight">
                    Medical
                    <span class="block text-blue-200">Centers Hub</span>
                </h1>
                <p class="text-lg text-gray-200 mb-6 max-w-2xl">
                    @lang('Discover comprehensive healthcare facilities and medical centers across Yogyakarta with complete information.')
                </p>
                
                <!-- Quick Stats -->
                @php
                    $hospital_count = $medicalcenters->where('type', 'Hospital')->count();
                    $medical_center_count = $medicalcenters->where('type', 'Medical Center')->count();
                    $specialist_clinic_count = $medicalcenters->where('type', 'Specialist Clinic')->count();
                    $total_types = collect([$hospital_count > 0 ? 1 : 0, $medical_center_count > 0 ? 1 : 0, $specialist_clinic_count > 0 ? 1 : 0])->sum();
                @endphp
                <div class="flex flex-wrap gap-4 mb-6">
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2">
                        <div class="text-xl font-bold text-white">{{ $medicalcenters->total() }}</div>
                        <div class="text-blue-200 text-sm">@lang('Total Centers')</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2">
                        <div class="text-xl font-bold text-white">{{ $total_types }}</div>
                        <div class="text-blue-200 text-sm">@lang('Center Types')</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2">
                        <div class="text-xl font-bold text-white">{{ $districts->count() }}</div>
                        <div class="text-blue-200 text-sm">@lang('Districts')</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2">
                        <div class="text-xl font-bold text-white">24/7</div>
                        <div class="text-blue-200 text-sm">@lang('Emergency Care')</div>
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
                    <i class="fas fa-search text-blue-600 mr-2"></i>Find Your Perfect Medical Center
                </h3>
                
                <form action="{{ route('frontend.medicalcenters.index') }}" method="GET" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Search Input -->
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search Centers</label>
                            <div class="relative">
                                <input type="text" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Search by name, description..." 
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 dark:text-white transition duration-200">
                                <i class="fas fa-search absolute left-3 top-4 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Type Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Center Type</label>
                            <select name="type" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 dark:text-white transition duration-200">
                                <option value="">All Types</option>
                                <option value="Hospital" {{ request('type') == 'Hospital' ? 'selected' : '' }}>Hospital</option>
                                <option value="Medical Center" {{ request('type') == 'Medical Center' ? 'selected' : '' }}>Medical Center</option>
                                <option value="Specialist Clinic" {{ request('type') == 'Specialist Clinic' ? 'selected' : '' }}>Specialist Clinic</option>
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
                            <a href="{{ route('frontend.medicalcenters.index') }}" class="px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg font-semibold hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                                <i class="fas fa-undo mr-2"></i>Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section id="medical-centers" class="main-content py-12 bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filters -->
            <div class="w-full lg:w-1/4">
                <div class="sticky top-4 space-y-6">
                                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
                    <div class="bg-blue-600 text-white p-4">
                        <h5 class="font-bold text-lg">
                            <i class="fas fa-filter mr-2"></i>@lang("Advanced Search")
                        </h5>
                    </div>
                        <div class="p-6 space-y-6">
                            <form action="{{ route('frontend.medicalcenters.index') }}" method="GET" id="filterForm">
                                <!-- Search Input -->
                                <div>
                                    <label class="block font-medium text-gray-700 dark:text-gray-300 mb-2">@lang("Search Medical Centers")</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-search text-gray-400"></i>
                                        </div>
                                        <input type="text" class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" 
                                               name="search" 
                                               value="{{ request('search') }}" 
                                               placeholder="@lang('Enter center name...')">
                                    </div>
                                </div>

                                <!-- Type Filter -->
                                <div>
                                    <label class="block font-medium text-gray-700 dark:text-gray-300 mb-3">@lang("Center Type")</label>
                                    <div class="space-y-2">
                                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors {{ !request('type') ? 'bg-blue-50 dark:bg-blue-900/20 border-blue-300' : '' }}">
                                            <input type="radio" name="type" value="" class="sr-only" {{ !request('type') ? 'checked' : '' }}>
                                            <i class="fas fa-th-large text-blue-600 mr-3"></i>
                                            <span class="text-gray-700 dark:text-gray-300">@lang("All Types")</span>
                                        </label>

                                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors {{ request('type') == 'Hospital' ? 'bg-blue-50 dark:bg-blue-900/20 border-blue-300' : '' }}">
                                            <input type="radio" name="type" value="Hospital" class="sr-only" {{ request('type') == 'Hospital' ? 'checked' : '' }}>
                                            <i class="fas fa-hospital text-blue-600 mr-3"></i>
                                            <span class="text-gray-700 dark:text-gray-300">@lang("Hospital")</span>
                                        </label>

                                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors {{ request('type') == 'Medical Center' ? 'bg-blue-50 dark:bg-blue-900/20 border-blue-300' : '' }}">
                                            <input type="radio" name="type" value="Medical Center" class="sr-only" {{ request('type') == 'Medical Center' ? 'checked' : '' }}>
                                            <i class="fas fa-building text-blue-600 mr-3"></i>
                                            <span class="text-gray-700 dark:text-gray-300">@lang("Medical Center")</span>
                                        </label>

                                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors {{ request('type') == 'Specialist Clinic' ? 'bg-blue-50 dark:bg-blue-900/20 border-blue-300' : '' }}">
                                            <input type="radio" name="type" value="Specialist Clinic" class="sr-only" {{ request('type') == 'Specialist Clinic' ? 'checked' : '' }}>
                                            <i class="fas fa-user-md text-blue-600 mr-3"></i>
                                            <span class="text-gray-700 dark:text-gray-300">@lang("Specialist Clinic")</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- District Filter -->
                                <div>
                                    <label class="block font-medium text-gray-700 dark:text-gray-300 mb-2">@lang("District")</label>
                                    <select class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" name="district" id="districtSelect">
                                        <option value="">@lang("All Districts")</option>
                                        @foreach($districts as $district)
                                            <option value="{{ $district }}" {{ request('district') == $district ? 'selected' : '' }}>
                                                {{ $district }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Sub-district Filter -->
                                <div>
                                    <label class="block font-medium text-gray-700 dark:text-gray-300 mb-2">@lang("Sub-district")</label>
                                    <select class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" name="sub_district" id="subDistrictSelect">
                                        <option value="">@lang("All Sub-districts")</option>
                                    </select>
                                </div>

                                <!-- Sort Options -->
                                <div>
                                    <label class="block font-medium text-gray-700 dark:text-gray-300 mb-2">@lang("Sort By")</label>
                                    <select class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" name="sort">
                                        <option value="">@lang("Default")</option>
                                        <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>@lang("Most Recent")</option>
                                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>@lang("Oldest")</option>
                                    </select>
                                </div>

                                <!-- Action Buttons -->
                                <div class="space-y-3">
                                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                                        <i class="fas fa-search mr-2"></i>@lang("Apply Filters")
                                    </button>
                                    <a href="{{ route('frontend.medicalcenters.index') }}" class="w-full bg-white hover:bg-gray-50 text-blue-600 border border-blue-600 font-medium py-3 px-4 rounded-lg transition-colors text-center block">
                                        <i class="fas fa-undo mr-2"></i>@lang("Clear Filters")
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tips Box -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                        <h6 class="font-bold text-blue-600 mb-3">
                            <i class="fas fa-lightbulb mr-2"></i>@lang("Search Tips")
                        </h6>
                        <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                            <li>• @lang("Use specific center names for better results")</li>
                            <li>• @lang("Filter by type to narrow down options")</li>
                            <li>• @lang("Select district for location-based search")</li>
                            <li>• @lang("Use keyboard shortcuts: Alt+1 (Masonry), Alt+2 (List)")</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="w-full lg:w-3/4">
                <!-- Results Header -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                    <div>
                        <h4 class="text-2xl font-bold text-gray-900 dark:text-white">
                            @if(request()->hasAny(['search', 'type', 'district', 'sub_district']))
                                @lang("Search Results")
                            @else
                                @lang("All Medical Centers")
                            @endif
                            <span class="inline-flex items-center px-3 py-1 ml-2 text-sm font-medium text-white bg-blue-600 rounded-full">{{ $medicalcenters->total() }}</span>
                        </h4>
                        @if(request()->hasAny(['search', 'type', 'district', 'sub_district']))
                            <p class="text-gray-500 dark:text-gray-400 mt-1">
                                @if(request('search'))
                                    @lang("Search for"): "{{ request('search') }}"
                                @endif
                                @if(request('type'))
                                    • @lang("Type"): {{ request('type') }}
                                @endif
                                @if(request('district'))
                                    • @lang("District"): {{ request('district') }}
                                @endif
                            </p>
                        @endif
                    </div>
                    <div class="flex gap-2 mt-4 sm:mt-0">
                        <button class="p-3 rounded-lg border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white transition-colors view-toggle active" data-view="masonry" title="@lang('Masonry View')">
                            <i class="fas fa-th"></i>
                        </button>
                        <button class="p-3 rounded-lg border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white transition-colors view-toggle" data-view="list" title="@lang('List View')">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>

                <!-- Medical Centers Grid -->
                <div class="centers-container" id="centersContainer">
                    <div class="masonry-grid columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6" id="masonryGrid">
                        @forelse($medicalcenters as $medicalcenter)
                            @php
                                $details_url = route("frontend.medicalcenters.show", [encode_id($medicalcenter->id), $medicalcenter->slug]);
                            @endphp
                            
                            <div class="masonry-item break-inside-avoid animate-fade-in-up" style="animation-delay: {{ $loop->index * 0.1 }}s">
                                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl hover:transform hover:-translate-y-2 transition-all duration-300 border border-blue-100 dark:border-blue-900">
                                    @if($medicalcenter->image)
                                        <div class="relative overflow-hidden">
                                            <img src="{{ asset($medicalcenter->image) }}" 
                                                 class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300" 
                                                 alt="{{ $medicalcenter->name }}"
                                                 loading="lazy">
                                            <div class="absolute top-4 left-4">
                                                @if($medicalcenter->type == 'Hospital')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium text-white bg-blue-600 backdrop-blur-sm">
                                                        <i class="fas fa-hospital mr-1"></i>{{ $medicalcenter->type }}
                                                    </span>
                                                @elseif($medicalcenter->type == 'Medical Center')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium text-white bg-blue-400 backdrop-blur-sm">
                                                        <i class="fas fa-building mr-1"></i>{{ $medicalcenter->type }}
                                                    </span>
                                                @elseif($medicalcenter->type == 'Specialist Clinic')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium text-white bg-blue-800 backdrop-blur-sm">
                                                        <i class="fas fa-user-md mr-1"></i>{{ $medicalcenter->type }}
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium text-white bg-blue-600 backdrop-blur-sm">
                                                        <i class="fas fa-hospital mr-1"></i>{{ $medicalcenter->type }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <div class="p-6 flex flex-col h-full">
                                        <h5 class="text-xl font-bold text-gray-900 dark:text-white mb-3">{{ $medicalcenter->name }}</h5>
                                        
                                        @if($medicalcenter->intro)
                                            <p class="text-gray-600 dark:text-gray-400 mb-4 flex-grow">
                                                {{ Str::limit($medicalcenter->intro, 120) }}
                                            </p>
                                        @endif

                                        <!-- Location Info -->
                                        @if($medicalcenter->district || $medicalcenter->sub_district)
                                            <div class="flex items-center text-blue-600 mb-3">
                                                <i class="fas fa-map-marker-alt mr-2"></i>
                                                <span class="text-sm text-gray-600 dark:text-gray-400">
                                                    @if($medicalcenter->sub_district)
                                                        {{ $medicalcenter->sub_district }},
                                                    @endif
                                                    {{ $medicalcenter->district }}
                                                </span>
                                            </div>
                                        @endif

                                        <!-- Contact Info -->
                                        @if($medicalcenter->contact)
                                            <div class="flex items-center text-blue-600 mb-4">
                                                <i class="fas fa-phone mr-2"></i>
                                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($medicalcenter->contact, 20) }}</span>
                                            </div>
                                        @endif

                                        <div class="flex gap-2 mt-auto">
                                            <a href="{{ $details_url }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded-lg transition-colors text-sm font-medium">
                                                <i class="fas fa-eye mr-1"></i>@lang("View Details")
                                            </a>
                                            <div class="relative">
                                                <button class="p-2 border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white rounded-lg transition-colors" onclick="toggleDropdown('dropdown-{{ $loop->index }}')">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                </button>
                                                <div id="dropdown-{{ $loop->index }}" class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 z-10">
                                                    @if($medicalcenter->maps)
                                                        <a href="{{ $medicalcenter->maps }}" target="_blank" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                            <i class="fas fa-map mr-2"></i>@lang("Directions")
                                                        </a>
                                                    @endif
                                                    <button class="w-full text-left block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 share-btn" 
                                                           data-url="{{ $details_url }}"
                                                           data-title="{{ $medicalcenter->name }}">
                                                        <i class="fas fa-share mr-2"></i>@lang("Share")
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full">
                                <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-2xl shadow-lg">
                                    <div class="text-6xl text-gray-400 mb-6">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <h4 class="text-2xl font-bold text-gray-500 dark:text-gray-400 mb-4">@lang("No Medical Centers Found")</h4>
                                    <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-md mx-auto">
                                        @if(request()->hasAny(['search', 'type', 'district', 'sub_district']))
                                            @lang("No centers match your search criteria. Try adjusting your filters.")
                                        @else
                                            @lang("No medical centers are available at the moment.")
                                        @endif
                                    </p>
                                    @if(request()->hasAny(['search', 'type', 'district', 'sub_district']))
                                        <a href="{{ route('frontend.medicalcenters.index') }}" class="inline-flex items-center px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-colors">
                                            <i class="fas fa-undo mr-2"></i>@lang("Clear Filters")
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Pagination -->
                @if($medicalcenters->hasPages())
                    <div class="mt-12 flex justify-center">
                        {{ $medicalcenters->links() }}
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

@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-down {
    animation: fade-in-down 1s ease-out;
}

.animate-fade-in-up {
    animation: fade-in-up 0.6s ease-out forwards;
    opacity: 0;
}

/* View toggle active state */
.view-toggle.active {
    background-color: rgb(5 150 105);
    color: white;
}

/* List view adjustments */
.list-view .masonry-grid {
    columns: 1 !important;
}

.list-view .masonry-item {
    break-inside: initial;
    margin-bottom: 1.5rem;
}

/* Responsive masonry */
@media (max-width: 768px) {
    .masonry-grid {
        columns: 1 !important;
    }
}

/* Note: Using standard Tailwind emerald colors */

/* Dropdown positioning fix */
.relative {
    position: relative;
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
    background: linear-gradient(135deg, rgb(5 150 105), rgb(6 78 59));
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, rgb(6 78 59), rgb(4 120 87));
}
</style>
@endpush

@push('after-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize components
    initializeFilters();
    initializeViewToggle();
    initializeKeyboardNavigation();
    initializeDropdowns();
    initializeShareButtons();
    
    /**
     * Initialize district/sub-district filtering
     */
    function initializeFilters() {
        const districtSelect = document.getElementById('districtSelect');
        const subDistrictSelect = document.getElementById('subDistrictSelect');
        const subDistricts = @json($sub_districts);

        if (districtSelect && subDistrictSelect) {
            districtSelect.addEventListener('change', function() {
                const selectedDistrict = this.value;
                subDistrictSelect.innerHTML = '<option value="">@lang("All Sub-districts")</option>';

                if (selectedDistrict && subDistricts[selectedDistrict]) {
                    subDistricts[selectedDistrict].forEach(subDistrict => {
                        const option = document.createElement('option');
                        option.value = subDistrict;
                        option.textContent = subDistrict;
                        if (subDistrict === '{{ request("sub_district") }}') {
                            option.selected = true;
                        }
                        subDistrictSelect.appendChild(option);
                    });
                }
            });

            // Set initial sub-district if district is already selected
            if (districtSelect.value) {
                districtSelect.dispatchEvent(new Event('change'));
            }
        }

        // Radio button handling
        const radioButtons = document.querySelectorAll('input[type="radio"][name="type"]');
        radioButtons.forEach(radio => {
            radio.addEventListener('change', function() {
                // Update visual states
                radioButtons.forEach(r => {
                    const label = r.closest('label');
                    if (r.checked) {
                        label.classList.add('bg-emerald-50', 'dark:bg-emerald-900/20', 'border-emerald-300');
                    } else {
                        label.classList.remove('bg-emerald-50', 'dark:bg-emerald-900/20', 'border-emerald-300');
                    }
                });
            });
        });
    }

    /**
     * Initialize view toggle functionality
     */
    function initializeViewToggle() {
        const viewToggles = document.querySelectorAll('.view-toggle');
        const centersContainer = document.getElementById('centersContainer');
        const masonryGrid = document.getElementById('masonryGrid');

        // Load saved view preference
        const savedView = localStorage.getItem('medicalcenter_view_preference') || 'masonry';
        setView(savedView);

        viewToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const view = this.getAttribute('data-view');
                setView(view);
                localStorage.setItem('medicalcenter_view_preference', view);
            });
        });

        function setView(view) {
            viewToggles.forEach(toggle => {
                toggle.classList.remove('active');
                if (toggle.getAttribute('data-view') === view) {
                    toggle.classList.add('active');
                }
            });

            if (view === 'list') {
                centersContainer.classList.add('list-view');
            } else {
                centersContainer.classList.remove('list-view');
            }
        }
    }

    /**
     * Initialize keyboard navigation
     */
    function initializeKeyboardNavigation() {
        document.addEventListener('keydown', function(e) {
            // Alt + 1: Switch to Masonry view
            if (e.altKey && e.key === '1') {
                e.preventDefault();
                const masonryToggle = document.querySelector('[data-view="masonry"]');
                if (masonryToggle) masonryToggle.click();
            }
            
            // Alt + 2: Switch to List view
            if (e.altKey && e.key === '2') {
                e.preventDefault();
                const listToggle = document.querySelector('[data-view="list"]');
                if (listToggle) listToggle.click();
            }
            
            // Escape: Clear search
            if (e.key === 'Escape') {
                const searchInput = document.querySelector('input[name="search"]');
                if (searchInput && searchInput.value) {
                    searchInput.value = '';
                    searchInput.focus();
                }
            }
        });
    }

    /**
     * Initialize dropdown menus
     */
    function initializeDropdowns() {
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.relative')) {
                document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
                    dropdown.classList.add('hidden');
                });
            }
        });
    }

    /**
     * Initialize share buttons
     */
    function initializeShareButtons() {
        const shareButtons = document.querySelectorAll('.share-btn');
        
        shareButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                
                const url = this.getAttribute('data-url');
                const title = this.getAttribute('data-title');
                
                if (navigator.share) {
                    navigator.share({
                        title: title,
                        url: url
                    }).catch(console.error);
                } else {
                    navigator.clipboard.writeText(url).then(() => {
                        showToast('@lang("Link copied to clipboard!")', 'success');
                    }).catch(() => {
                        window.open(`https://wa.me/?text=${encodeURIComponent(title + ' - ' + url)}`, '_blank');
                    });
                }
            });
        });
    }

    /**
     * Show toast notification
     */
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg ${type === 'success' ? 'bg-green-500' : 'bg-blue-500'} text-white`;
        toast.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} mr-2"></i>
                ${message}
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            if (toast.parentElement) {
                toast.remove();
            }
        }, 3000);
    }
});

// Global function for dropdown toggle
function toggleDropdown(dropdownId) {
    const dropdown = document.getElementById(dropdownId);
    
    // Close all other dropdowns
    document.querySelectorAll('[id^="dropdown-"]').forEach(d => {
        if (d.id !== dropdownId) {
            d.classList.add('hidden');
        }
    });
    
    // Toggle current dropdown
    dropdown.classList.toggle('hidden');
}
</script>
@endpush
