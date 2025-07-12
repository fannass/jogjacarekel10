@extends('frontend.layouts.app')

@section('title') {{ $medicaltreatment->name }} - {{ __($module_title) }} @endsection

@section('content')
<!-- Hero Section -->
<section class="hero-section bg-blue-600 text-white relative overflow-hidden">
    <div class="hero-background"></div>
    <div class="hero-overlay"></div>
    <div class="container mx-auto px-4 py-16 relative z-10">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Content Column -->
                <div>
                    <nav class="mb-6">
                        <a href="{{ route('frontend.medicaltreatments.index') }}" class="text-blue-200 hover:text-white transition duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>Back to Treatments
                        </a>
                    </nav>
                    
                    <div class="mb-4">
                        <span class="inline-block bg-blue-100 text-blue-800 text-sm font-semibold px-4 py-2 rounded-full">
                            {{ $medicaltreatment->type }}
                        </span>
                    </div>
                    
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                        {{ $medicaltreatment->name }}
                    </h1>
                    
                    <p class="text-xl text-blue-100 mb-6 leading-relaxed">
                        {{ $medicaltreatment->intro }}
                    </p>

                    <!-- Rating Display -->
                    @if($medicaltreatment->rating)
                        <div class="flex items-center gap-4 mb-6">
                            <div class="flex items-center bg-white bg-opacity-20 rounded-lg px-4 py-2">
                                <div class="flex text-yellow-300 mr-3">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= round($medicaltreatment->rating) ? 'text-yellow-300' : 'text-gray-400' }}"></i>
                                    @endfor
                                </div>
                                <span class="text-white font-semibold">{{ number_format($medicaltreatment->rating, 1) }}/5</span>
                            </div>
                            <span class="text-blue-200 text-sm">
                                Highly rated treatment
                            </span>
                        </div>
                    @endif

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="bg-white bg-opacity-10 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-blue-300">{{ $sidebarStats['same_type_count'] }}</div>
                            <div class="text-sm text-blue-200">Similar Treatments</div>
                        </div>
                        <div class="bg-white bg-opacity-10 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-blue-300">{{ number_format($sidebarStats['average_rating'], 1) }}</div>
                            <div class="text-sm text-blue-200">Avg Rating</div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#details" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition duration-300 text-center">
                            <i class="fas fa-info-circle mr-2"></i>Read Details
                        </a>
                        @if($medicaltreatment->google_maps_embed)
                            <a href="#location" class="border border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300 text-center">
                                <i class="fas fa-map-marker-alt mr-2"></i>View Location
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Image Column -->
                <div class="relative">
                    @if($medicaltreatment->image)
                        <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                            <img src="{{ asset($medicaltreatment->image) }}" 
                                 alt="{{ $medicaltreatment->name }}" 
                                 class="w-full h-96 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        </div>
                    @else
                        <div class="bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl shadow-2xl h-96 flex items-center justify-center">
                            <i class="fas fa-stethoscope text-6xl text-white"></i>
                        </div>
                    @endif
                    
                    <!-- Floating Info Card -->
                    <div class="absolute -bottom-6 left-6 right-6 bg-white rounded-xl shadow-lg p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm text-gray-600">Published</div>
                                <div class="font-semibold text-gray-800">{{ $medicaltreatment->created_at->format('M d, Y') }}</div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-gray-600">Last Updated</div>
                                <div class="font-semibold text-gray-800">{{ $medicaltreatment->updated_at->format('M d, Y') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Main Content Column -->
                <div class="lg:col-span-2">
                    <!-- Treatment Details -->
                    <div id="details" class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                        <h2 class="text-3xl font-bold text-gray-800 mb-6">
                            <i class="fas fa-info-circle text-blue-600 mr-3"></i>Treatment Details
                        </h2>
                        
                        <div class="prose prose-lg max-w-none">
                            <div class="mb-8">
                                <h3 class="text-xl font-semibold text-gray-800 mb-4">Description</h3>
                                <p class="text-gray-600 leading-relaxed">{{ $medicaltreatment->description }}</p>
                            </div>

                            @if($medicaltreatment->benefits)
                                <div class="mb-8">
                                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Benefits</h3>
                                    <div class="bg-blue-50 border-l-4 border-blue-600 p-6 rounded-r-lg">
                                        <p class="text-gray-700 leading-relaxed">{{ $medicaltreatment->benefits }}</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Treatment Type Info -->
                            <div class="bg-gray-50 rounded-xl p-6">
                                <h3 class="text-xl font-semibold text-gray-800 mb-4">Treatment Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                            <i class="fas fa-tag text-blue-600"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-600">Treatment Type</div>
                                            <div class="font-semibold text-gray-800">{{ $medicaltreatment->type }}</div>
                                        </div>
                                    </div>
                                    
                                    @if($medicaltreatment->rating)
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                                                <i class="fas fa-star text-yellow-600"></i>
                                            </div>
                                            <div>
                                                <div class="text-sm text-gray-600">Rating</div>
                                                <div class="font-semibold text-gray-800">{{ number_format($medicaltreatment->rating, 1) }}/5 Stars</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Google Maps -->
                    @if($medicaltreatment->google_maps_embed)
                        <div id="location" class="bg-white rounded-2xl shadow-lg p-8">
                            <h2 class="text-3xl font-bold text-gray-800 mb-6">
                                <i class="fas fa-map-marker-alt text-blue-600 mr-3"></i>Location
                            </h2>
                            <div class="maps-container rounded-xl overflow-hidden shadow-lg">
                                {!! $medicaltreatment->google_maps_embed !!}
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Quick Stats -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Quick Stats</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Total Treatments</span>
                                <span class="font-semibold text-blue-600">{{ $sidebarStats['total_treatments'] }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Same Type</span>
                                <span class="font-semibold text-blue-600">{{ $sidebarStats['same_type_count'] }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Average Rating</span>
                                <span class="font-semibold text-blue-600">{{ number_format($sidebarStats['average_rating'], 1) }}/5</span>
                            </div>
                        </div>
                    </div>

                    <!-- Related Treatments -->
                    @if($relatedTreatments->count() > 0)
                        <div class="bg-white rounded-2xl shadow-lg p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-6">Related Treatments</h3>
                            <div class="space-y-4">
                                @foreach($relatedTreatments as $related)
                                    @php
                                        $related_url = route("frontend.medicaltreatments.show", [encode_id($related->id), $related->slug]);
                                    @endphp
                                    
                                    <div class="border border-gray-100 rounded-lg p-4 hover:shadow-md transition duration-200">
                                        <div class="flex items-start gap-3">
                                            @if($related->image)
                                                <img src="{{ asset($related->image) }}" 
                                                     alt="{{ $related->name }}" 
                                                     class="w-16 h-16 object-cover rounded-lg flex-shrink-0">
                                            @else
                                                <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                                    <i class="fas fa-stethoscope text-white"></i>
                                                </div>
                                            @endif
                                            
                                            <div class="flex-grow min-w-0">
                                                <h4 class="font-semibold text-gray-800 line-clamp-2 mb-1">
                                                    {{ $related->name }}
                                                </h4>
                                                <p class="text-sm text-gray-600 mb-2">{{ $related->type }}</p>
                                                
                                                @if($related->rating)
                                                    <div class="flex items-center text-xs text-yellow-600 mb-2">
                                                        <i class="fas fa-star mr-1"></i>
                                                        {{ number_format($related->rating, 1) }}
                                                    </div>
                                                @endif
                                                
                                                <a href="{{ $related_url }}" 
                                                   class="inline-flex items-center text-xs text-blue-600 hover:text-blue-800 font-medium">
                                                    View Details
                                                    <i class="fas fa-arrow-right ml-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <div class="mt-6 text-center">
                                <a href="{{ route('frontend.medicaltreatments.index', ['type' => $medicaltreatment->type]) }}" 
                                   class="bg-blue-600 text-white px-6 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition duration-200">
                                    <i class="fas fa-eye mr-2"></i>View All {{ $medicaltreatment->type }}
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
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

/* Maps Container */
.maps-container iframe {
    width: 100%;
    height: 400px;
    border: none;
    border-radius: 12px;
}

/* Line Clamp Utilities */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Prose Styling */
.prose h3 {
    color: #374151;
    font-weight: 600;
}

.prose p {
    margin-bottom: 1rem;
    line-height: 1.75;
}

/* Custom Scrollbar */
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

/* Responsive Adjustments */
@media (max-width: 768px) {
    .hero-section {
        padding: 60px 0;
    }
    
    .hero-section h1 {
        font-size: 2.5rem;
    }
    
    .maps-container iframe {
        height: 300px;
    }
    
    .grid.grid-cols-1.lg\\:grid-cols-2.gap-12 {
        gap: 2rem;
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
    
    .border-gray-100 {
        border-color: #4b5563;
    }
}

/* Floating Animation */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.floating-card {
    animation: float 6s ease-in-out infinite;
}

/* Rating Stars Animation */
.rating-stars i {
    transition: color 0.2s ease;
}

.rating-stars:hover i {
    color: #fbbf24;
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

    // Lazy loading for images
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('opacity-0');
                img.classList.add('opacity-100');
                imageObserver.unobserve(img);
            }
        });
    });

    images.forEach(img => imageObserver.observe(img));

    // Rating stars hover effect
    const ratingStars = document.querySelectorAll('.rating-stars');
    ratingStars.forEach(container => {
        const stars = container.querySelectorAll('i');
        stars.forEach((star, index) => {
            star.addEventListener('mouseenter', () => {
                stars.forEach((s, i) => {
                    if (i <= index) {
                        s.classList.add('text-yellow-400');
                        s.classList.remove('text-gray-400');
                    } else {
                        s.classList.add('text-gray-400');
                        s.classList.remove('text-yellow-400');
                    }
                });
            });
        });
        
        container.addEventListener('mouseleave', () => {
            // Reset to original rating
            const rating = parseInt(container.dataset.rating);
            stars.forEach((s, i) => {
                if (i < rating) {
                    s.classList.add('text-yellow-300');
                    s.classList.remove('text-gray-400');
                } else {
                    s.classList.add('text-gray-400');
                    s.classList.remove('text-yellow-300');
                }
            });
        });
    });

    // Maps iframe responsive behavior
    const mapsContainer = document.querySelector('.maps-container');
    if (mapsContainer) {
        const iframe = mapsContainer.querySelector('iframe');
        if (iframe) {
            // Add loading state
            iframe.addEventListener('load', function() {
                this.style.opacity = '1';
            });
        }
    }
});
</script>
@endpush