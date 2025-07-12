@extends('frontend.layouts.app')

@section('title') {{$$module_name_singular->name}} - {{ __($module_title) }} @endsection

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
                        <a href="{{ route('frontend.medicalcares.index') }}" class="text-white/80 hover:text-white transition duration-200 inline-flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i>@lang('Back to Medical Care')
                        </a>
                    </nav>
                    
                    <div class="mb-3">
                        <span class="inline-block bg-white/20 backdrop-blur-sm text-white text-sm font-medium px-4 py-2 rounded-full">
                            {{ $$module_name_singular->type }}
                        </span>
                    </div>
                    
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 leading-tight">
                        {{ $$module_name_singular->name }}
                    </h1>
                    
                    <p class="text-lg text-gray-200 mb-6 leading-relaxed max-w-lg">
                        @lang('Explore comprehensive healthcare services and facilities information')
                    </p>

                    <!-- Quick Stats -->
                    @php
                        $same_type_count = \Modules\MedicalCare\Models\MedicalCare::where('type', $$module_name_singular->type)->count();
                        $total_care_facilities = \Modules\MedicalCare\Models\MedicalCare::count();
                    @endphp
                    <div class="grid grid-cols-2 gap-3 mb-6">
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3 text-center">
                            <div class="text-xl font-bold text-white">{{ $same_type_count }}</div>
                            <div class="text-xs text-blue-200">@lang('Similar Facilities')</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3 text-center">
                            <div class="text-xl font-bold text-white">{{ $total_care_facilities }}</div>
                            <div class="text-xs text-blue-200">@lang('Total Facilities')</div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="#details" class="bg-white text-blue-600 px-6 py-2 rounded-lg font-medium hover:bg-blue-50 transition duration-300 text-center text-sm">
                            <i class="fas fa-info-circle mr-2"></i>@lang('Read Details')
                        </a>
                        <a href="{{ route('frontend.medicalcares.index') }}" class="border border-white text-white px-6 py-2 rounded-lg font-medium hover:bg-white hover:text-blue-600 transition duration-300 text-center text-sm">
                            <i class="fas fa-list mr-2"></i>@lang('View All')
                        </a>
                    </div>
                </div>

                <!-- Image Column -->
                <div class="relative">
                    @if($$module_name_singular->image)
                        <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                            <img src="{{ asset($$module_name_singular->image) }}" 
                                 alt="{{ $$module_name_singular->name }}" 
                                 class="w-full h-80 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                        </div>
                    @else
                        <div class="bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl shadow-2xl h-80 flex items-center justify-center">
                            <i class="fas fa-user-md text-5xl text-white"></i>
                        </div>
                    @endif
                    
                    <!-- Floating Info Card -->
                    <div class="absolute -bottom-4 left-4 right-4 bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4">
                        <div class="flex items-center justify-between text-sm">
                            <div>
                                <div class="text-gray-600 dark:text-gray-400">@lang('Published')</div>
                                <div class="font-semibold text-gray-800 dark:text-gray-200">{{ $$module_name_singular->created_at->format('M d, Y') }}</div>
                            </div>
                            <div class="text-right">
                                <div class="text-gray-600 dark:text-gray-400">@lang('Type')</div>
                                <div class="font-semibold text-gray-800 dark:text-gray-200">{{ $$module_name_singular->type }}</div>
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
<section id="details" class="bg-white dark:bg-gray-900 py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Main Content Column -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Featured Image -->
                    <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                        <img class="w-full h-96 object-cover" 
                             src="{{ asset($$module_name_singular->image) }}" 
                             alt="{{$$module_name_singular->name}}">
                        
                        <!-- Image Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                        
                        <!-- Image Caption -->
                        <div class="absolute bottom-4 left-4 right-4">
                            <p class="text-white text-sm bg-black bg-opacity-50 rounded-lg p-3">
                                {{$$module_name_singular->name}} - {{$$module_name_singular->type}}
                            </p>
                        </div>
                    </div>
                    
                    <!-- Description Section -->
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-8">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.569.58-6.593 1.609M12 3a9 9 0 100 18 9 9 0 000-18z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">About This Facility</h2>
                                <p class="text-gray-600 dark:text-gray-400">Detailed information and services</p>
                            </div>
                        </div>
                        
                        <div class="prose prose-lg dark:prose-invert max-w-none">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-lg">
                                {{$$module_name_singular->description}}
                            </p>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('frontend.medicalcares.index') }}" 
                           class="inline-flex items-center justify-center bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-semibold py-3 px-6 rounded-xl transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to Medical Care List
                        </a>
                        
                        <button onclick="shareContent()" 
                                class="inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
                            </svg>
                            Share This Facility
                        </button>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Quick Info Card -->
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 dark:from-gray-800 dark:to-gray-700 rounded-2xl p-6 border border-blue-100 dark:border-gray-600">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Quick Information
                        </h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-3 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                                <span class="text-gray-600 dark:text-gray-400 font-medium">Type:</span>
                                <span class="text-gray-900 dark:text-white font-semibold">{{$$module_name_singular->type}}</span>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                                <span class="text-gray-600 dark:text-gray-400 font-medium">Published:</span>
                                <span class="text-gray-900 dark:text-white font-semibold">{{ $$module_name_singular->created_at->format('M d, Y') }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                                <span class="text-gray-600 dark:text-gray-400 font-medium">Last Updated:</span>
                                <span class="text-gray-900 dark:text-white font-semibold">{{ $$module_name_singular->updated_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Related Information -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            Healthcare Types
                        </h3>
                        
                        <div class="space-y-3">
                            <div class="flex items-center p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                                <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                                <div>
                                    <div class="font-medium text-gray-900 dark:text-white">Primary Health Care</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">Basic medical services</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-3 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                                <div class="w-3 h-3 bg-purple-500 rounded-full mr-3"></div>
                                <div>
                                    <div class="font-medium text-gray-900 dark:text-white">Secondary Health Care</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">Specialized medical services</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-3 bg-pink-50 dark:bg-pink-900/20 rounded-lg">
                                <div class="w-3 h-3 bg-pink-500 rounded-full mr-3"></div>
                                <div>
                                    <div class="font-medium text-gray-900 dark:text-white">Tertiary Health Care</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">Advanced specialized care</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contact CTA -->
                    <div class="bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl p-6 text-white">
                        <h3 class="text-xl font-bold mb-2">Need More Information?</h3>
                        <p class="text-blue-100 mb-4">Contact us for detailed healthcare information and assistance.</p>
                        <button class="w-full bg-white bg-opacity-20 hover:bg-opacity-30 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 backdrop-blur-sm border border-white border-opacity-30">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Contact Support
                        </button>
                    </div>
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
    window.shareContent = function() {
        if (navigator.share) {
            navigator.share({
                title: '{{$$module_name_singular->name}}',
                text: '{{$$module_name_singular->intro ?? $$module_name_singular->name}}',
                url: window.location.href
            }).catch(console.error);
        } else {
            // Fallback for browsers that don't support native sharing
            copyToClipboard(window.location.href);
            showNotification('Link copied to clipboard!');
        }
    };
    
    // Copy to clipboard function
    function copyToClipboard(text) {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text);
        } else {
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
        }
    }
    
    // Show notification
    function showNotification(message) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-all duration-300 transform translate-x-full';
        notification.innerHTML = `
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                ${message}
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }
    
    // Smooth scroll behavior for internal links
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
    
    // Image lazy loading enhancement
    const images = document.querySelectorAll('img');
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.classList.add('fade-in');
                    observer.unobserve(img);
                }
            });
        });
        
        images.forEach(img => imageObserver.observe(img));
    }
    
    // Add loading states to buttons
    document.querySelectorAll('button').forEach(button => {
        if (!button.onclick && !button.getAttribute('onclick')) {
            button.addEventListener('click', function() {
                if (!this.disabled) {
                    const originalContent = this.innerHTML;
                    this.innerHTML = `
                        <svg class="w-5 h-5 inline mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Processing...
                    `;
                    this.disabled = true;
                    
                    // Reset after 2 seconds (adjust as needed)
                    setTimeout(() => {
                        this.innerHTML = originalContent;
                        this.disabled = false;
                    }, 2000);
                }
            });
        }
    });
});
</script>
@endpush

@push('after-styles')
<style>
/* Custom animations and styles */
.fade-in {
    animation: fadeIn 0.6s ease-in;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Enhanced focus states */
button:focus, a:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
}

/* Smooth transitions for interactive elements */
.transition-all {
    transition: all 0.3s ease;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(45deg, #3b82f6, #8b5cf6);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(45deg, #2563eb, #7c3aed);
}

/* Dark mode scrollbar */
@media (prefers-color-scheme: dark) {
    ::-webkit-scrollbar-track {
        background: #374151;
    }
}

/* Hover effects for cards */
.hover-lift:hover {
    transform: translateY(-4px);
}

/* Gradient text effect */
.gradient-text {
    background: linear-gradient(45deg, #3b82f6, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Image overlay effects */
.group:hover .image-overlay {
    opacity: 1;
}

.image-overlay {
    opacity: 0;
    transition: opacity 0.3s ease;
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    .grid.lg\\:grid-cols-3 {
        gap: 2rem;
    }
    
    h1.text-4xl.md\\:text-5xl {
        font-size: 2rem;
        line-height: 1.2;
    }
    
    .py-16 {
        padding-top: 3rem;
        padding-bottom: 3rem;
    }
}

/* Print styles */
@media print {
    .no-print {
        display: none !important;
    }
    
    body {
        color: #000 !important;
        background: #fff !important;
    }
    
    .shadow-lg, .shadow-xl, .shadow-2xl {
        box-shadow: none !important;
    }
}

/* Enhanced accessibility */
@media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

/* High contrast mode support */
@media (prefers-contrast: high) {
    .bg-gradient-to-r, .bg-gradient-to-br {
        background: #000 !important;
        color: #fff !important;
    }
    
    .text-gray-600, .text-gray-700 {
        color: #000 !important;
    }
    
    .border-gray-200, .border-gray-300 {
        border-color: #000 !important;
    }
}
</style>
@endpush