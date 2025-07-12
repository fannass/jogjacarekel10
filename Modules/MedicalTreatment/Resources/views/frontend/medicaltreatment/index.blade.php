@extends('frontend.layouts.app')

@section('title') {{ __($module_title) }} @endsection

@section('content')
<!-- Hero Section with Keraton Background -->
<section class="hero-section bg-blue-600 text-white relative overflow-hidden">
    <div class="hero-background"></div>
    <div class="hero-overlay"></div>
    <div class="container mx-auto px-4 py-20 relative z-10">
        <div class="text-center max-w-4xl mx-auto">
            <div class="mb-6">
                <span class="inline-block bg-blue-100 text-blue-800 text-sm font-semibold px-4 py-2 rounded-full mb-4">
                    <i class="fas fa-stethoscope mr-2"></i>Medical Services
                </span>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                Medical <span class="text-blue-300">Treatments</span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-blue-100 leading-relaxed">
                Discover comprehensive medical treatment options and wellness services in Yogyakarta. From traditional healing to modern medical procedures.
            </p>
            
            <!-- Hero Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-300">{{ $stats['total_treatments'] }}</div>
                    <div class="text-sm text-blue-200">Total Treatments</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-300">{{ $stats['treatment_types'] }}</div>
                    <div class="text-sm text-blue-200">Treatment Types</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-300">{{ number_format($stats['average_rating'], 1) }}</div>
                    <div class="text-sm text-blue-200">Avg Rating</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-300">{{ $stats['featured_treatments'] }}</div>
                    <div class="text-sm text-blue-200">Featured</div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#treatments" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition duration-300">
                    <i class="fas fa-search mr-2"></i>Browse Treatments
                </a>
                <a href="#filters" class="border border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300">
                    <i class="fas fa-filter mr-2"></i>Advanced Search
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Advanced Search & Filter Section -->
<section id="filters" class="bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">
                    <i class="fas fa-search text-blue-600 mr-2"></i>Find Your Perfect Treatment
                </h3>
                
                <form action="{{ route('frontend.medicaltreatments.index') }}" method="GET" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Search Input -->
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Search Treatments</label>
                            <div class="relative">
                                <input type="text" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Search by name, description..." 
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                                <i class="fas fa-search absolute left-3 top-4 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Type Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Treatment Type</label>
                            <select name="type" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                                <option value="">All Types</option>
                                @foreach($types as $type)
                                    <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Rating Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Minimum Rating</label>
                            <select name="rating" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                                <option value="">Any Rating</option>
                                <option value="4.5" {{ request('rating') == '4.5' ? 'selected' : '' }}>4.5+ Stars</option>
                                <option value="4.0" {{ request('rating') == '4.0' ? 'selected' : '' }}>4.0+ Stars</option>
                                <option value="3.5" {{ request('rating') == '3.5' ? 'selected' : '' }}>3.5+ Stars</option>
                                <option value="3.0" {{ request('rating') == '3.0' ? 'selected' : '' }}>3.0+ Stars</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Sort Options -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                            <select name="sort" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                                <option value="">Default</option>
                                <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Most Recent</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                                <option value="rating_high" {{ request('sort') == 'rating_high' ? 'selected' : '' }}>Highest Rated</option>
                                <option value="rating_low" {{ request('sort') == 'rating_low' ? 'selected' : '' }}>Lowest Rated</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name A-Z</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name Z-A</option>
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-end gap-3">
                            <button type="submit" class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                                <i class="fas fa-search mr-2"></i>Search
                            </button>
                            <a href="{{ route('frontend.medicaltreatments.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition duration-200">
                                <i class="fas fa-undo mr-2"></i>Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Results Section -->
<section id="treatments" class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Results Header -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Available Treatments</h2>
                    <p class="text-gray-600">
                        Showing {{ $medicaltreatments->count() }} of {{ $medicaltreatments->total() }} treatments
                        @if(request('search'))
                            for "<strong>{{ request('search') }}</strong>"
                        @endif
                    </p>
                </div>
                <div class="text-sm text-gray-500">
                    Page {{ $medicaltreatments->currentPage() }} of {{ $medicaltreatments->lastPage() }}
                </div>
            </div>

            @if($medicaltreatments->count() > 0)
                <!-- Treatment Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach ($medicaltreatments as $treatment)
                        @php
                            $details_url = route("frontend.medicaltreatments.show", [encode_id($treatment->id), $treatment->slug]);
                        @endphp
                        
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group">
                            <!-- Treatment Image -->
                            <div class="relative overflow-hidden h-48">
                                @if($treatment->image)
                                    <img src="{{ asset($treatment->image) }}" 
                                         alt="{{ $treatment->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                                        <i class="fas fa-stethoscope text-4xl text-white"></i>
                                    </div>
                                @endif
                                
                                <!-- Treatment Type Badge -->
                                <div class="absolute top-4 left-4">
                                    <span class="bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                        {{ $treatment->type }}
                                    </span>
                                </div>

                                <!-- Rating Badge -->
                                @if($treatment->rating)
                                    <div class="absolute top-4 right-4 bg-white bg-opacity-90 rounded-lg px-2 py-1">
                                        <div class="flex items-center text-sm">
                                            <i class="fas fa-star text-yellow-500 mr-1"></i>
                                            <span class="font-semibold text-gray-800">{{ number_format($treatment->rating, 1) }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Treatment Content -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200">
                                    {{ $treatment->name }}
                                </h3>
                                
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                    {{ $treatment->intro }}
                                </p>

                                <!-- Benefits Preview -->
                                @if($treatment->benefits)
                                    <div class="mb-4">
                                        <p class="text-xs text-blue-600 font-medium mb-1">Key Benefits:</p>
                                        <p class="text-gray-600 text-xs line-clamp-2">{{ Str::limit($treatment->benefits, 100) }}</p>
                                    </div>
                                @endif

                                <!-- Action Button -->
                                <div class="flex items-center justify-between">
                                    <div class="text-xs text-gray-500">
                                        <i class="fas fa-calendar mr-1"></i>
                                        {{ $treatment->created_at->format('M d, Y') }}
                                    </div>
                                    <a href="{{ $details_url }}" 
                                       class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition duration-200 flex items-center">
                                        View Details
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    {{ $medicaltreatments->links() }}
                </div>
            @else
                <!-- No Results -->
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <i class="fas fa-search text-6xl text-gray-300 mb-6"></i>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">No Treatments Found</h3>
                        <p class="text-gray-600 mb-8">
                            We couldn't find any treatments matching your criteria. Try adjusting your search filters.
                        </p>
                        <a href="{{ route('frontend.medicaltreatments.index') }}" 
                           class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                            <i class="fas fa-undo mr-2"></i>Reset Search
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

@include('frontend.includes.messages')
@endsection

@push('after-styles')
<style>
/* Hero Background */
.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url('{{ asset('img/Wallpaper/wallpaperkeraton.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    filter: blur(2px);
    transform: scale(1.1);
    z-index: 1;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.9) 0%, rgba(37, 99, 235, 0.8) 100%);
    z-index: 2;
}

/* Line Clamp Utilities */
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

/* Custom Scrollbar for Filter Section */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #3b82f6;
    border-radius: 3px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #2563eb;
}

/* Hover Effects */
.treatment-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px rgba(59, 130, 246, 0.15);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .hero-section {
        padding: 60px 0;
    }
    
    .hero-section h1 {
        font-size: 2.5rem;
    }
    
    .hero-section p {
        font-size: 1.1rem;
    }
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
    .bg-gray-50 {
        background-color: #1f2937;
    }
    
    .bg-white {
        background-color: #374151;
    }
    
    .text-gray-800 {
        color: #f9fafb;
    }
    
    .text-gray-600 {
        color: #d1d5db;
    }
    
    .border-gray-300 {
        border-color: #4b5563;
    }
}
</style>
@endpush

@push('after-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Auto-submit form on filter change (optional)
    const filterInputs = document.querySelectorAll('select[name="type"], select[name="rating"], select[name="sort"]');
    filterInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Uncomment the line below to enable auto-submit
            // this.form.submit();
        });
    });
    
    // Loading animation for form submission
    const searchForm = document.querySelector('form');
    const submitButton = searchForm.querySelector('button[type="submit"]');
    
    searchForm.addEventListener('submit', function() {
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Searching...';
        submitButton.disabled = true;
    });
});
</script>
@endpush