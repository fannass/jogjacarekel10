@extends('frontend.layouts.app')

@section('title') {{ $medicalcenter->name }} - @lang("Medical Centers") @endsection

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
                        <a href="{{ route('frontend.medicalcenters.index') }}" class="text-white/80 hover:text-white transition duration-200 inline-flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i>@lang('Back to Medical Centers')
                        </a>
                    </nav>
                    
                    <div class="mb-3">
                        <span class="inline-block bg-white/20 backdrop-blur-sm text-white text-sm font-medium px-4 py-2 rounded-full">
                            {{ $medicalcenter->type ?? 'Medical Center' }}
                        </span>
                    </div>
                    
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 leading-tight">
                        {{ $medicalcenter->name }}
                    </h1>
                    
                    <p class="text-lg text-gray-200 mb-4 leading-relaxed max-w-lg">
                        @if($medicalcenter->intro)
                            {{ $medicalcenter->intro }}
                        @else
                            @lang('Comprehensive medical center information and healthcare services in Yogyakarta')
                        @endif
                    </p>

                    <!-- Location Info -->
                    @if($medicalcenter->district || $medicalcenter->sub_district)
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2 mb-4">
                        <i class="fas fa-map-marker-alt text-blue-200 mr-3"></i>
                        <span class="text-white text-sm">
                            @if($medicalcenter->sub_district){{ $medicalcenter->sub_district }}, @endif
                            {{ $medicalcenter->district }}
                        </span>
                    </div>
                    @endif

                    <!-- Quick Stats -->
                    @php
                        $same_type_count = \Modules\MedicalCenter\Models\MedicalCenter::where('type', $medicalcenter->type)->count();
                        $total_centers = \Modules\MedicalCenter\Models\MedicalCenter::count();
                    @endphp
                    <div class="grid grid-cols-2 gap-3 mb-6">
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3 text-center">
                            <div class="text-xl font-bold text-white">{{ $same_type_count }}</div>
                            <div class="text-xs text-blue-200">@lang('Similar Centers')</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3 text-center">
                            <div class="text-xl font-bold text-white">{{ $total_centers }}</div>
                            <div class="text-xs text-blue-200">@lang('Total Centers')</div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="#details" class="bg-white text-blue-600 px-6 py-2 rounded-lg font-medium hover:bg-blue-50 transition duration-300 text-center text-sm">
                            <i class="fas fa-info-circle mr-2"></i>@lang('Read Details')
                        </a>
                        @if($medicalcenter->contact)
                            <a href="tel:{{ $medicalcenter->contact }}" class="border border-white text-white px-6 py-2 rounded-lg font-medium hover:bg-white hover:text-blue-600 transition duration-300 text-center text-sm">
                                <i class="fas fa-phone mr-2"></i>@lang('Contact')
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Image Column -->
                <div class="relative">
                    @if($medicalcenter->image)
                        <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                            <img src="{{ asset($medicalcenter->image) }}" 
                                 alt="{{ $medicalcenter->name }}" 
                                 class="w-full h-80 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                        </div>
                    @else
                        <div class="bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl shadow-2xl h-80 flex items-center justify-center">
                            <i class="fas fa-hospital text-5xl text-white"></i>
                        </div>
                    @endif
                    
                    <!-- Floating Info Card -->
                    <div class="absolute -bottom-4 left-4 right-4 bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4">
                        <div class="flex items-center justify-between text-sm">
                            <div>
                                <div class="text-gray-600 dark:text-gray-400">@lang('Type')</div>
                                <div class="font-semibold text-gray-800 dark:text-gray-200">{{ $medicalcenter->type ?? 'Medical Center' }}</div>
                            </div>
                            <div class="text-right">
                                <div class="text-gray-600 dark:text-gray-400">@lang('Location')</div>
                                <div class="font-semibold text-gray-800 dark:text-gray-200">{{ $medicalcenter->district ?? 'Yogyakarta' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section id="details" class="py-12 bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content -->
            <div class="w-full lg:w-2/3">
                <div class="space-y-8">
                    <!-- Featured Image -->
                    @if($medicalcenter->image)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
                            <img src="{{ asset($medicalcenter->image) }}" 
                                 class="w-full h-96 object-cover"
                                 alt="{{ $medicalcenter->name }}">
                        </div>
                    @endif

                    <!-- Center Details -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                            <i class="fas fa-info-circle text-blue-600 mr-3"></i>
                            @lang("Center Information")
                        </h2>

                        @if($medicalcenter->intro)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">@lang("Introduction")</h3>
                                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ $medicalcenter->intro }}</p>
                            </div>
                        @endif

                        @if($medicalcenter->content)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">@lang("Description")</h3>
                                <div class="prose prose-blue max-w-none text-gray-600 dark:text-gray-400">
                                    {!! $medicalcenter->content !!}
                                </div>
                            </div>
                        @endif

                        <!-- Contact Information -->
                        @if($medicalcenter->contact)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">@lang("Contact Information")</h3>
                                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4">
                                    <div class="flex items-center text-blue-600">
                                        <i class="fas fa-phone mr-3"></i>
                                        <span class="text-gray-700 dark:text-gray-300">{{ $medicalcenter->contact }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Location Information -->
                        @if($medicalcenter->address || $medicalcenter->district || $medicalcenter->sub_district)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">@lang("Location & Address")</h3>
                                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4 space-y-2">
                                    @if($medicalcenter->address)
                                        <div class="flex items-start text-blue-600">
                                            <i class="fas fa-map-marker-alt mr-3 mt-1"></i>
                                            <span class="text-gray-700 dark:text-gray-300">{{ $medicalcenter->address }}</span>
                                        </div>
                                    @endif
                                    @if($medicalcenter->sub_district || $medicalcenter->district)
                                        <div class="flex items-center text-blue-600">
                                            <i class="fas fa-location-arrow mr-3"></i>
                                            <span class="text-gray-700 dark:text-gray-300">
                                                @if($medicalcenter->sub_district){{ $medicalcenter->sub_district }}, @endif
                                                {{ $medicalcenter->district }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- Facilities & Services -->
                        @if($medicalcenter->type)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">@lang("Services")</h3>
                                <div class="flex flex-wrap gap-2">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                        @if($medicalcenter->type == 'Hospital')
                                            <i class="fas fa-hospital mr-1"></i>
                                        @elseif($medicalcenter->type == 'Medical Center')
                                            <i class="fas fa-building mr-1"></i>
                                        @elseif($medicalcenter->type == 'Specialist Clinic')
                                            <i class="fas fa-user-md mr-1"></i>
                                        @else
                                            <i class="fas fa-hospital mr-1"></i>
                                        @endif
                                        {{ $medicalcenter->type }}
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Additional Information -->
                    @if($medicalcenter->meta_title || $medicalcenter->meta_description)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                                <i class="fas fa-clipboard-list text-blue-600 mr-3"></i>
                                @lang("Additional Information")
                            </h2>

                            @if($medicalcenter->meta_title)
                                <div class="mb-4">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">@lang("Title")</h3>
                                    <p class="text-gray-600 dark:text-gray-400">{{ $medicalcenter->meta_title }}</p>
                                </div>
                            @endif

                            @if($medicalcenter->meta_description)
                                <div class="mb-4">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">@lang("Summary")</h3>
                                    <p class="text-gray-600 dark:text-gray-400">{{ $medicalcenter->meta_description }}</p>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="w-full lg:w-1/3">
                <div class="sticky top-4 space-y-6">
                    <!-- Quick Info -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
                        <div class="bg-blue-600 text-white p-4">
                            <h3 class="font-bold text-lg">
                                <i class="fas fa-info mr-2"></i>@lang("Quick Info")
                            </h3>
                        </div>
                        <div class="p-6 space-y-4">
                            @if($medicalcenter->type)
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">@lang("Type")</span>
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $medicalcenter->type }}</span>
                                </div>
                                <hr class="border-gray-200 dark:border-gray-700">
                            @endif

                            @if($medicalcenter->district)
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">@lang("District")</span>
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $medicalcenter->district }}</span>
                                </div>
                                <hr class="border-gray-200 dark:border-gray-700">
                            @endif

                            @if($medicalcenter->sub_district)
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">@lang("Sub-district")</span>
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $medicalcenter->sub_district }}</span>
                                </div>
                                <hr class="border-gray-200 dark:border-gray-700">
                            @endif

                            <div class="flex items-center justify-between">
                                <span class="text-gray-600 dark:text-gray-400">@lang("Created")</span>
                                <span class="font-medium text-gray-900 dark:text-white">{{ $medicalcenter->created_at->format('M j, Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                        <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-4">
                            <i class="fas fa-tools text-blue-600 mr-2"></i>@lang("Actions")
                        </h3>
                        <div class="space-y-3">
                            @if($medicalcenter->maps)
                                <a href="{{ $medicalcenter->maps }}" 
                                   target="_blank"
                                   class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition-colors flex items-center justify-center">
                                    <i class="fas fa-map-marker-alt mr-2"></i>@lang("Get Directions")
                                </a>
                            @endif

                            <button class="w-full bg-white hover:bg-gray-50 text-blue-600 border border-blue-600 font-medium py-3 px-4 rounded-lg transition-colors flex items-center justify-center share-btn"
                                    data-url="{{ url()->current() }}"
                                    data-title="{{ $medicalcenter->name }}">
                                <i class="fas fa-share mr-2"></i>@lang("Share Center")
                            </button>

                            <a href="{{ route('frontend.medicalcenters.index') }}" 
                               class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-4 rounded-lg transition-colors flex items-center justify-center">
                                <i class="fas fa-arrow-left mr-2"></i>@lang("Back to Centers")
                            </a>
                        </div>
                    </div>

                    <!-- Contact Card -->
                    @if($medicalcenter->contact)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                            <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-4">
                                <i class="fas fa-phone text-blue-600 mr-2"></i>@lang("Contact")
                            </h3>
                            <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">@lang("Phone")</span>
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $medicalcenter->contact }}</span>
                                </div>
                            </div>
                            @if($medicalcenter->contact)
                                <a href="tel:{{ $medicalcenter->contact }}" 
                                   class="w-full mt-3 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors flex items-center justify-center">
                                    <i class="fas fa-phone mr-2"></i>@lang("Call Now")
                                </a>
                            @endif
                        </div>
                    @endif

                    <!-- Related Centers -->
                    @if(isset($relatedCenters) && $relatedCenters->count() > 0)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
                            <div class="bg-blue-600 text-white p-4">
                                <h3 class="font-bold text-lg">
                                    <i class="fas fa-hospital mr-2"></i>@lang("Related Centers")
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="space-y-4">
                                    @foreach($relatedCenters->take(3) as $related)
                                        @php
                                            $relatedUrl = route("frontend.medicalcenters.show", [encode_id($related->id), $related->slug]);
                                        @endphp
                                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:border-blue-300 dark:hover:border-blue-600 transition-colors">
                                            <h4 class="font-medium text-gray-900 dark:text-white mb-2">
                                                <a href="{{ $relatedUrl }}" class="hover:text-blue-600">{{ $related->name }}</a>
                                            </h4>
                                            @if($related->district)
                                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                                    <i class="fas fa-map-marker-alt mr-1"></i>{{ $related->district }}
                                                </p>
                                            @endif
                                            <a href="{{ $relatedUrl }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                                @lang("View Details") <i class="fas fa-arrow-right ml-1"></i>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
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

/* Note: Using standard Tailwind emerald colors */

/* Prose styling for content */
.prose {
    max-width: none;
}

.prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
    color: rgb(31 41 55);
    font-weight: 600;
}

.prose p {
    margin-bottom: 1rem;
    line-height: 1.75;
}

.prose ul, .prose ol {
    margin-bottom: 1rem;
    padding-left: 1.5rem;
}

.prose li {
    margin-bottom: 0.5rem;
}

.prose a {
    color: rgb(5 150 105);
    text-decoration: underline;
}

.prose a:hover {
    color: rgb(4 120 87);
}

/* Dark mode prose */
[data-theme="dark"] .prose h1,
[data-theme="dark"] .prose h2,
[data-theme="dark"] .prose h3,
[data-theme="dark"] .prose h4,
[data-theme="dark"] .prose h5,
[data-theme="dark"] .prose h6 {
    color: rgb(243 244 246);
}

/* Smooth transitions */
* {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
}

/* Hover effects */
.hover\:shadow-xl:hover {
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
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
    
    .bg-emerald-600 {
        background-color: #10b981 !important;
        color: white !important;
    }
}

/* Accessibility improvements */
.focus\:ring-2:focus {
    outline: 2px solid transparent;
    outline-offset: 2px;
    box-shadow: 0 0 0 2px rgb(5 150 105);
}

/* Loading skeleton for images */
.image-loading {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
}

@keyframes loading {
    0% {
        background-position: 200% 0;
    }
    100% {
        background-position: -200% 0;
    }
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    .animate-fade-in-down,
    .animate-fade-in-up {
        animation: none !important;
    }
    
    * {
        transition: none !important;
    }
}
</style>
@endpush

@push('after-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize components
    initializeShareButtons();
    initializeImageLoading();
    initializeSmoothScrolling();
    
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
     * Initialize image loading with skeleton
     */
    function initializeImageLoading() {
        const images = document.querySelectorAll('img');
        
        images.forEach(img => {
            if (!img.complete) {
                img.classList.add('image-loading');
                
                img.addEventListener('load', function() {
                    this.classList.remove('image-loading');
                });
                
                img.addEventListener('error', function() {
                    this.classList.remove('image-loading');
                    this.classList.add('opacity-50');
                });
            }
        });
    }
    
    /**
     * Initialize smooth scrolling for anchor links
     */
    function initializeSmoothScrolling() {
        const links = document.querySelectorAll('a[href^="#"]');
        
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
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
    
    // Add fade-in animation delay to elements
    const animatedElements = document.querySelectorAll('.animate-fade-in-up');
    animatedElements.forEach((element, index) => {
        element.style.animationDelay = `${index * 0.1}s`;
    });
});

// Global functions for external use
window.showToast = function(message, type = 'info') {
    // Implementation same as above
};
</script>
@endpush