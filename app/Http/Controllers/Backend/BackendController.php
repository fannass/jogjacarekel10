<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class BackendController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Get counts for each medical service
        $serviceData = [];
        
        // MedicalCare
        if (class_exists('\Modules\MedicalCare\Models\MedicalCare')) {
            $serviceData['medical_care'] = \Modules\MedicalCare\Models\MedicalCare::count();
        } else {
            $serviceData['medical_care'] = 0;
        }
        
        // MedicalCenter
        if (class_exists('\Modules\MedicalCenter\Models\MedicalCenter')) {
            $serviceData['medical_center'] = \Modules\MedicalCenter\Models\MedicalCenter::count();
        } else {
            $serviceData['medical_center'] = 0;
        }
        
        // MedicalPoint
        if (class_exists('\Modules\MedicalPoint\Models\MedicalPoint')) {
            $serviceData['medical_point'] = \Modules\MedicalPoint\Models\MedicalPoint::count();
        } else {
            $serviceData['medical_point'] = 0;
        }
        
        // MedicalAlter
        if (class_exists('\Modules\MedicalAlter\Models\MedicalAlter')) {
            $serviceData['medical_alter'] = \Modules\MedicalAlter\Models\MedicalAlter::count();
        } else {
            $serviceData['medical_alter'] = 0;
        }
        
        // MedicalCost
        if (class_exists('\Modules\MedicalCost\Models\MedicalCost')) {
            $serviceData['medical_cost'] = \Modules\MedicalCost\Models\MedicalCost::count();
        } else {
            $serviceData['medical_cost'] = 0;
        }
        
        // MedicalTreatment
        if (class_exists('\Modules\MedicalTreatment\Models\MedicalTreatment')) {
            $serviceData['medical_treatment'] = \Modules\MedicalTreatment\Models\MedicalTreatment::count();
        } else {
            $serviceData['medical_treatment'] = 0;
        }
        
        // Chatbot FAQs
        if (class_exists('\Modules\Chatbot\Models\Faq')) {
            $serviceData['chatbot_faqs'] = \Modules\Chatbot\Models\Faq::count();
        } else {
            $serviceData['chatbot_faqs'] = 0;
        }
        
        // Users count
        $serviceData['users'] = \App\Models\User::count();
        
        return view('backend.index', compact('serviceData'));
    }
}
