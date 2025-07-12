@extends('backend.layouts.app')

@section('title') @lang("Dashboard") @endsection

@section('breadcrumbs')
<x-backend.breadcrumbs />
@endsection

@section('content')
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm welcome-card">
                <div class="welcome-background"></div>
                <div class="welcome-overlay"></div>
                <div class="card-body text-center text-white py-5 position-relative">
                    <h1 class="h2 mb-3 fw-bold">@lang("Welcome to JogjaCare Admin Dashboard")</h1>
                    <p class="mb-0 fs-6">@lang("Kelola layanan kesehatan dan pantau aktivitas sistem di Yogyakarta")</p>
                    <small class="d-block mt-2 opacity-75">@lang("Manage medical services and monitor system activities in Yogyakarta")</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Service Cards -->
    <div class="row">
        <!-- Medical Care -->
        <div class="col-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: var(--cui-primary);">
                                <i class="fas fa-heartbeat fa-lg"></i>
                            </div>
                        </div>
                        <div class="ms-3 flex-grow-1">
                            <div class="fs-4 fw-bold" style="color: var(--cui-primary);">{{ $serviceData['medical_care'] }}</div>
                            <div class="text-body-secondary small">@lang("Medical Care")</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0">
                    @can('view_medicalcares')
                        <a href="{{ route('backend.medicalcares.index') }}" class="btn btn-outline-primary btn-sm w-100">
                            <i class="fas fa-eye me-1"></i> @lang("View Details")
                        </a>
                    @else
                        <button class="btn btn-outline-secondary btn-sm w-100" disabled>
                            <i class="fas fa-lock me-1"></i> @lang("No Permission")
                        </button>
                    @endcan
                </div>
            </div>
        </div>

        <!-- Medical Center -->
        <div class="col-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: var(--cui-success);">
                                <i class="fas fa-hospital fa-lg"></i>
                            </div>
                        </div>
                        <div class="ms-3 flex-grow-1">
                            <div class="fs-4 fw-bold" style="color: var(--cui-success);">{{ $serviceData['medical_center'] }}</div>
                            <div class="text-body-secondary small">@lang("Medical Centers")</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0">
                    @can('view_medicalcenters')
                        <a href="{{ route('backend.medicalcenters.index') }}" class="btn btn-outline-success btn-sm w-100">
                            <i class="fas fa-eye me-1"></i> @lang("View Details")
                        </a>
                    @else
                        <button class="btn btn-outline-secondary btn-sm w-100" disabled>
                            <i class="fas fa-lock me-1"></i> @lang("No Permission")
                        </button>
                    @endcan
                </div>
            </div>
        </div>

        <!-- Medical Point -->
        <div class="col-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: var(--cui-info);">
                                <i class="fas fa-map-marker-alt fa-lg"></i>
                            </div>
                        </div>
                        <div class="ms-3 flex-grow-1">
                            <div class="fs-4 fw-bold" style="color: var(--cui-info);">{{ $serviceData['medical_point'] }}</div>
                            <div class="text-body-secondary small">@lang("Medical Points")</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0">
                    @can('view_medicalpoints')
                        <a href="{{ route('backend.medicalpoints.index') }}" class="btn btn-outline-info btn-sm w-100">
                            <i class="fas fa-eye me-1"></i> @lang("View Details")
                        </a>
                    @else
                        <button class="btn btn-outline-secondary btn-sm w-100" disabled>
                            <i class="fas fa-lock me-1"></i> @lang("No Permission")
                        </button>
                    @endcan
                </div>
            </div>
        </div>

        <!-- Medical Alter -->
        <div class="col-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: var(--cui-warning);">
                                <i class="fas fa-user-md fa-lg"></i>
                            </div>
                        </div>
                        <div class="ms-3 flex-grow-1">
                            <div class="fs-4 fw-bold" style="color: var(--cui-warning);">{{ $serviceData['medical_alter'] }}</div>
                            <div class="text-body-secondary small">@lang("Medical Alters")</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0">
                    @can('view_medicalalters')
                        <a href="{{ route('backend.medicalalters.index') }}" class="btn btn-outline-warning btn-sm w-100">
                            <i class="fas fa-eye me-1"></i> @lang("View Details")
                        </a>
                    @else
                        <button class="btn btn-outline-secondary btn-sm w-100" disabled>
                            <i class="fas fa-lock me-1"></i> @lang("No Permission")
                        </button>
                    @endcan
                </div>
            </div>
        </div>

        <!-- Medical Cost -->
        <div class="col-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: var(--cui-danger);">
                                <i class="fas fa-dollar-sign fa-lg"></i>
                            </div>
                        </div>
                        <div class="ms-3 flex-grow-1">
                            <div class="fs-4 fw-bold" style="color: var(--cui-danger);">{{ $serviceData['medical_cost'] }}</div>
                            <div class="text-body-secondary small">@lang("Medical Costs")</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0">
                    @can('view_medicalcosts')
                        <a href="{{ route('backend.medicalcosts.index') }}" class="btn btn-outline-danger btn-sm w-100">
                            <i class="fas fa-eye me-1"></i> @lang("View Details")
                        </a>
                    @else
                        <button class="btn btn-outline-secondary btn-sm w-100" disabled>
                            <i class="fas fa-lock me-1"></i> @lang("No Permission")
                        </button>
                    @endcan
                </div>
            </div>
        </div>

        <!-- Medical Treatment -->
        <div class="col-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: var(--cui-secondary);">
                                <i class="fas fa-stethoscope fa-lg"></i>
                            </div>
                        </div>
                        <div class="ms-3 flex-grow-1">
                            <div class="fs-4 fw-bold" style="color: var(--cui-secondary);">{{ $serviceData['medical_treatment'] }}</div>
                            <div class="text-body-secondary small">@lang("Medical Treatments")</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0">
                    @can('view_medicaltreatments')
                        <a href="{{ route('backend.medicaltreatments.index') }}" class="btn btn-outline-secondary btn-sm w-100">
                            <i class="fas fa-eye me-1"></i> @lang("View Details")
                        </a>
                    @else
                        <button class="btn btn-outline-secondary btn-sm w-100" disabled>
                            <i class="fas fa-lock me-1"></i> @lang("No Permission")
                        </button>
                    @endcan
                </div>
            </div>
        </div>

        <!-- Chatbot FAQs -->
        <div class="col-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="text-white rounded-circle d-flex align-items-center justify-content-center chatbot-icon" style="width: 60px; height: 60px;">
                                <i class="fas fa-robot fa-lg"></i>
                            </div>
                        </div>
                        <div class="ms-3 flex-grow-1">
                            <div class="fs-4 fw-bold chatbot-text">{{ $serviceData['chatbot_faqs'] }}</div>
                            <div class="text-body-secondary small">@lang("Chatbot FAQs")</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0">
                    @can('view_faqs')
                        <a href="{{ route('faqs.index') }}" class="btn btn-outline-chatbot btn-sm w-100">
                            <i class="fas fa-eye me-1"></i> @lang("View Details")
                        </a>
                    @else
                        <button class="btn btn-outline-secondary btn-sm w-100" disabled>
                            <i class="fas fa-lock me-1"></i> @lang("No Permission")
                        </button>
                    @endcan
                </div>
            </div>
        </div>

        <!-- Users -->
        <div class="col-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="text-white rounded-circle d-flex align-items-center justify-content-center gradient-users" style="width: 60px; height: 60px;">
                                <i class="fas fa-users fa-lg"></i>
                            </div>
                        </div>
                        <div class="ms-3 flex-grow-1">
                            <div class="fs-4 fw-bold text-users">{{ $serviceData['users'] }}</div>
                            <div class="text-body-secondary small">@lang("Total Users")</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0">
                    @can('view_users')
                        <a href="{{ route('backend.users.index') }}" class="btn btn-outline-users btn-sm w-100">
                            <i class="fas fa-eye me-1"></i> @lang("View Details")
                        </a>
                    @else
                        <button class="btn btn-outline-secondary btn-sm w-100" disabled>
                            <i class="fas fa-lock me-1"></i> @lang("No Permission")
                        </button>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt text-warning me-2"></i>@lang("Quick Actions")
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @can('view_notifications')
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('backend.notifications.index') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-bell me-2"></i>@lang("Notifications")
                            </a>
                        </div>
                        @endcan
                        
                        @can('edit_settings')
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('backend.settings') }}" class="btn btn-outline-success w-100">
                                <i class="fas fa-cog me-2"></i>@lang("Settings")
                            </a>
                        </div>
                        @endcan
                        
                        @can('view_backups')
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('backend.backups.index') }}" class="btn btn-outline-info w-100">
                                <i class="fas fa-download me-2"></i>@lang("Backups")
                            </a>
                        </div>
                        @endcan
                        
                        @can('view_logs')
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('log-viewer::dashboard') }}" class="btn btn-outline-warning w-100">
                                <i class="fas fa-chart-line me-2"></i>@lang("System Logs")
                            </a>
                        </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Welcome card with background image */
.welcome-card {
    position: relative;
    overflow: hidden;
    min-height: 250px;
}

.welcome-background {
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

.welcome-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.8) 0%, rgba(118, 75, 162, 0.8) 100%);
    z-index: 2;
}

.welcome-card .card-body {
    z-index: 3;
}

/* Dark mode adjustments for welcome card */
[data-coreui-theme="dark"] .welcome-overlay {
    background: linear-gradient(135deg, rgba(55, 65, 81, 0.85) 0%, rgba(75, 85, 99, 0.85) 100%);
}

/* Custom styles for theme compatibility */
.gradient-users {
    background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%) !important;
}

.text-users {
    color: #f5576c !important;
}

.btn-outline-users {
    border: 1px solid #f5576c !important;
    color: #f5576c !important;
}

.btn-outline-users:hover {
    background-color: #f5576c !important;
    color: white !important;
}

/* Chatbot styles for better visibility in both themes */
.chatbot-icon {
    background: linear-gradient(45deg, #8B5CF6 0%, #A855F7 100%) !important;
}

.chatbot-text {
    color: #8B5CF6 !important;
}

.btn-outline-chatbot {
    border: 1px solid #8B5CF6 !important;
    color: #8B5CF6 !important;
}

.btn-outline-chatbot:hover {
    background-color: #8B5CF6 !important;
    color: white !important;
}

/* Dark mode adjustments */
[data-coreui-theme="dark"] .text-body-secondary {
    color: var(--cui-secondary-color) !important;
}

[data-coreui-theme="dark"] .gradient-users {
    background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%) !important;
}

[data-coreui-theme="dark"] .text-users {
    color: #f093fb !important;
}

[data-coreui-theme="dark"] .btn-outline-users {
    border: 1px solid #f093fb !important;
    color: #f093fb !important;
}

[data-coreui-theme="dark"] .btn-outline-users:hover {
    background-color: #f093fb !important;
    color: white !important;
}

/* Chatbot dark mode adjustments */
[data-coreui-theme="dark"] .chatbot-icon {
    background: linear-gradient(45deg, #C084FC 0%, #DDD6FE 100%) !important;
}

[data-coreui-theme="dark"] .chatbot-text {
    color: #C084FC !important;
}

[data-coreui-theme="dark"] .btn-outline-chatbot {
    border: 1px solid #C084FC !important;
    color: #C084FC !important;
}

[data-coreui-theme="dark"] .btn-outline-chatbot:hover {
    background-color: #C084FC !important;
    color: #1F2937 !important;
}

/* Card hover effects */
.card:hover {
    transform: translateY(-2px);
    transition: transform 0.2s ease-in-out;
}

/* Welcome card responsive */
@media (max-width: 768px) {
    .card-body.py-5 {
        padding-top: 2rem !important;
        padding-bottom: 2rem !important;
    }
    
    .welcome-card {
        min-height: 200px;
    }
}
</style>
@endsection