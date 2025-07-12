@extends('frontend.layouts.app')

@section('title') {{ $medicalpoint->name }} - {{ __($module_title) }} @endsection

@section('content')

<!-- Hero Section with Keraton Background -->
<section class="relative h-[500px] overflow-hidden">
    <!-- Keraton Background -->
    <div class="absolute inset-0">
        <img class="w-full h-full object-cover" src="{{ asset('img/Wallpaper/wallpaperkeraton.jpg') }}" alt="Keraton Yogyakarta">
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/80 via-blue-500/60 to-blue-700/80"></div>
    </div>
    
    <!-- Content -->
    <div class="relative z-10 h-full flex items-center">
        <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Content Column -->
                <div>
                    <nav class="mb-4">
                        <a href="{{ route('frontend.medicalpoints.index') }}" class="text-white/80 hover:text-white transition duration-200 inline-flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i>@lang('Back to Medical Points')
                        </a>
                    </nav>
                    
                    <div class="mb-3">
                        <span class="inline-block bg-white/20 backdrop-blur-sm text-white text-sm font-medium px-4 py-2 rounded-full">
                            {{ $medicalpoint->type }}
                        </span>
                    </div>
                    
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 leading-tight">
                        {{ $medicalpoint->name }}
                    </h1>
                    
                    <p class="text-lg text-gray-200 mb-4 leading-relaxed max-w-lg">
                        @if($medicalpoint->intro)
                            {{ $medicalpoint->intro }}
                        @else
                            @lang('Comprehensive medical point information and services in Yogyakarta')
                        @endif
                    </p>

                    <!-- Location Info -->
                    @if($medicalpoint->district || $medicalpoint->sub_district)
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2 mb-4">
                        <i class="fas fa-map-marker-alt text-blue-200 mr-3"></i>
                        <span class="text-white text-sm">
                            @if($medicalpoint->sub_district){{ $medicalpoint->sub_district }}, @endif
                            {{ $medicalpoint->district }}
                        </span>
                    </div>
                    @endif

                    <!-- Quick Stats -->
                    @php
                        $same_type_count = \Modules\MedicalPoint\Models\MedicalPoint::where('type', $medicalpoint->type)->count();
                        $total_points = \Modules\MedicalPoint\Models\MedicalPoint::count();
                    @endphp
                    <div class="grid grid-cols-2 gap-3 mb-6">
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3 text-center">
                            <div class="text-xl font-bold text-white">{{ $same_type_count }}</div>
                            <div class="text-xs text-blue-200">@lang('Similar Points')</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3 text-center">
                            <div class="text-xl font-bold text-white">{{ $total_points }}</div>
                            <div class="text-xs text-blue-200">@lang('Total Points')</div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="#details" class="bg-white text-blue-600 px-6 py-2 rounded-lg font-medium hover:bg-blue-50 transition duration-300 text-center text-sm">
                            <i class="fas fa-info-circle mr-2"></i>@lang('Read Details')
                        </a>
                        @if($medicalpoint->maps)
                            <a href="{{ $medicalpoint->maps }}" target="_blank" class="border border-white text-white px-6 py-2 rounded-lg font-medium hover:bg-white hover:text-blue-600 transition duration-300 text-center text-sm">
                                <i class="fas fa-map-marker-alt mr-2"></i>@lang('View Maps')
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Image Column -->
                <div class="relative">
                    @if($medicalpoint->image)
                        <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                            <img src="{{ asset($medicalpoint->image) }}" 
                                 alt="{{ $medicalpoint->name }}" 
                                 class="w-full h-80 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                        </div>
                    @else
                        <div class="bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl shadow-2xl h-80 flex items-center justify-center">
                            <i class="fas fa-map-marker-alt text-5xl text-white"></i>
                        </div>
                    @endif
                    
                    <!-- Floating Info Card -->
                    <div class="absolute -bottom-4 left-4 right-4 bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4">
                        <div class="flex items-center justify-between text-sm">
                            <div>
                                <div class="text-gray-600 dark:text-gray-400">@lang('Type')</div>
                                <div class="font-semibold text-gray-800 dark:text-gray-200">{{ $medicalpoint->type }}</div>
                            </div>
                            <div class="text-right">
                                <div class="text-gray-600 dark:text-gray-400">@lang('Location')</div>
                                <div class="font-semibold text-gray-800 dark:text-gray-200">{{ $medicalpoint->district ?? 'Yogyakarta' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('frontend.includes.messages')
</section>

<!-- Main Content -->
<section id="details" class="py-16 bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Description -->
                @if($medicalpoint->description)
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                        <div class="w-8 h-8 bg-indigo-500 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        @lang('Description')
                    </h2>
                    <div class="prose prose-lg max-w-none text-gray-600 dark:text-gray-300">
                        {{ $medicalpoint->description }}
                    </div>
                </div>
                @endif
                
                <!-- Location Details -->
                @if($medicalpoint->address)
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                        <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                        </div>
                        @lang('Location & Address')
                    </h2>
                    
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-gray-400 mt-1 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            <div>
                                <div class="font-medium text-gray-900 dark:text-white">@lang('Full Address')</div>
                                <div class="text-gray-600 dark:text-gray-300">{{ $medicalpoint->address }}</div>
                                @if($medicalpoint->maps)
                                <a href="{{ $medicalpoint->maps }}" target="_blank" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 text-sm font-medium mt-2">
                                    @lang('Open in Google Maps')
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                </a>
                                @endif
                            </div>
                        </div>
                        
                        @if($medicalpoint->district)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <div>
                                <span class="font-medium text-gray-900 dark:text-white">@lang('District'):</span>
                                <span class="text-gray-600 dark:text-gray-300 ml-2">{{ $medicalpoint->district }}</span>
                            </div>
                        </div>
                        @endif
                        
                        @if($medicalpoint->sub_district)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <div>
                                <span class="font-medium text-gray-900 dark:text-white">@lang('Sub District'):</span>
                                <span class="text-gray-600 dark:text-gray-300 ml-2">{{ $medicalpoint->sub_district }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                
                <!-- Contact Information -->
                @if($medicalpoint->contact)
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                        <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        @lang('Contact Information')
                    </h2>
                    
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <div>
                                <div class="font-medium text-gray-900 dark:text-white">{{ $medicalpoint->contact }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">@lang('Contact Number')</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Sidebar -->
            <div class="space-y-8">
                <!-- Quick Info Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg sticky top-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                        <div class="w-6 h-6 bg-yellow-500 rounded-lg flex items-center justify-center mr-2">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        @lang('Quick Info')
                    </h3>
                    
                    <div class="space-y-4">
                        <!-- Type -->
                        <div class="flex items-center justify-between py-3 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-600 dark:text-gray-400">@lang('Type')</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $medicalpoint->type }}</span>
                        </div>
                        
                        <!-- Published -->
                        <div class="flex items-center justify-between py-3 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-600 dark:text-gray-400">@lang('Published')</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $medicalpoint->created_at->format('M d, Y') }}</span>
                        </div>
                        
                        <!-- Last Updated -->
                        <div class="flex items-center justify-between py-3">
                            <span class="text-gray-600 dark:text-gray-400">@lang('Last Updated')</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $medicalpoint->updated_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="mt-6 space-y-3">
                        <a href="{{ route('frontend.medicalpoints.index') }}" class="w-full bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-medium py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            @lang('Back to List')
                        </a>
                        
                        @if($medicalpoint->maps)
                        <a href="{{ $medicalpoint->maps }}" target="_blank" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            @lang('Get Directions')
                        </a>
                        @endif
                    </div>
                </div>
                
                <!-- Related Points (if any) -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">@lang('Find Similar')</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">@lang('Looking for similar medical points?')</p>
                    <a href="{{ route('frontend.medicalpoints.index', ['type' => $medicalpoint->type]) }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium">
                        @lang('View all') {{ $medicalpoint->type }}
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('after-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Share functionality
    window.sharePoint = function() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $medicalpoint->name }}',
                text: '{{ $medicalpoint->intro ?? "Check out this medical point" }}',
                url: window.location.href
            }).catch(console.error);
        } else {
            // Fallback to copying URL
            navigator.clipboard.writeText(window.location.href).then(function() {
                // Show success message
                const toast = document.createElement('div');
                toast.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
                toast.textContent = '@lang("Link copied to clipboard!")';
                document.body.appendChild(toast);
                
                setTimeout(() => {
                    toast.remove();
                }, 3000);
            });
        }
    };
    
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
    
    // Image lazy loading with intersection observer
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.classList.add('loaded');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('img').forEach(img => {
            imageObserver.observe(img);
        });
    }
});
</script>
@endpush

@push('after-styles')
<style>
/* Enhanced animations */
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

.fade-in-up {
    animation: fadeInUp 0.6s ease-out;
}

/* Image loading effects */
img {
    transition: opacity 0.3s ease;
}

img.loaded {
    opacity: 1;
}

/* Custom hover effects */
.hover-lift {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.hover-lift:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Prose styling for better readability */
.prose {
    line-height: 1.7;
}

.prose p {
    margin-bottom: 1.25rem;
}

/* Enhanced card shadows */
.shadow-lg {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

/* Responsive design improvements */
@media (max-width: 768px) {
    .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    .text-4xl {
        font-size: 2rem;
    }
    
    .md\:text-5xl {
        font-size: 2.5rem;
    }
    
    .py-16 {
        padding-top: 3rem;
        padding-bottom: 3rem;
    }
    
    .p-8 {
        padding: 1.5rem;
    }
    
    .sticky {
        position: relative !important;
        top: auto !important;
    }
}

/* Print styles */
@media print {
    .no-print, button, .sticky {
        display: none !important;
    }
    
    body {
        background: white !important;
        color: black !important;
    }
    
    .bg-gradient-to-br {
        background: #6366F1 !important;
    }
}

/* High contrast mode support */
@media (prefers-contrast: high) {
    .bg-gradient-to-br {
        background: #000 !important;
    }
    
    .text-white\/80 {
        color: #fff !important;
    }
}

/* Reduced motion support */
@media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}
</style>
@endpush