<?php

namespace Modules\MedicalTreatment\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalTreatment\Models\MedicalTreatment;

class MedicalTreatmentsController extends Controller
{
    public function index(Request $request)
    {
        $module_title = 'Medical Treatments';
        $module_name = 'medicaltreatments';
        
        $query = MedicalTreatment::where('status', 1);
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('intro', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }
        
        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        
        // Filter by rating
        if ($request->filled('rating')) {
            $rating = floatval($request->rating);
            $query->where('rating', '>=', $rating);
        }
        
        // Sorting
        switch ($request->sort) {
            case 'recent':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'rating_high':
                $query->orderBy('rating', 'desc');
                break;
            case 'rating_low':
                $query->orderBy('rating', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }
        
        $medicaltreatments = $query->paginate(12)->appends(request()->query());
        
        // Get statistics for dashboard
        $stats = [
            'total_treatments' => MedicalTreatment::where('status', 1)->count(),
            'treatment_types' => MedicalTreatment::where('status', 1)->distinct('type')->count('type'),
            'average_rating' => MedicalTreatment::where('status', 1)->whereNotNull('rating')->avg('rating'),
            'featured_treatments' => MedicalTreatment::where('status', 1)->where('rating', '>=', 4.5)->count(),
        ];
        
        // Get treatment types for filter
        $types = MedicalTreatment::where('status', 1)->distinct()->pluck('type')->filter();
        
        return view('medicaltreatment::frontend.medicaltreatment.index', compact(
            'module_title', 
            'module_name', 
            'medicaltreatments', 
            'stats', 
            'types'
        ));
    }

    public function show($id)
    {
        $id = decode_id($id);
        $module_title = 'Medical Treatments';
        $module_name = 'medicaltreatments';
        
        $medicaltreatment = MedicalTreatment::where('status', 1)->findOrFail($id);
        
        // Get related treatments (same type or similar rating)
        $relatedTreatments = MedicalTreatment::where('status', 1)
            ->where('id', '!=', $medicaltreatment->id)
            ->where(function($query) use ($medicaltreatment) {
                $query->where('type', $medicaltreatment->type);
                if ($medicaltreatment->rating) {
                    $query->orWhereBetween('rating', [
                        max(0, $medicaltreatment->rating - 0.5), 
                        min(5, $medicaltreatment->rating + 0.5)
                    ]);
                }
            })
            ->orderBy('rating', 'desc')
            ->take(6)
            ->get();
            
        // Get stats for sidebar
        $sidebarStats = [
            'total_treatments' => MedicalTreatment::where('status', 1)->count(),
            'same_type_count' => MedicalTreatment::where('status', 1)->where('type', $medicaltreatment->type)->count(),
            'average_rating' => MedicalTreatment::where('status', 1)->whereNotNull('rating')->avg('rating'),
        ];
        
        return view('medicaltreatment::frontend.medicaltreatment.show', compact(
            'module_title', 
            'module_name', 
            'medicaltreatment', 
            'relatedTreatments',
            'sidebarStats'
        ));
    }
} 