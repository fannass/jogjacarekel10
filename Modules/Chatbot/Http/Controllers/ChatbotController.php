<?php

namespace Modules\Chatbot\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('chatbot::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('chatbot::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('chatbot::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('chatbot::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Handle manual chatbot conversation (AJAX/JSON) - Hybrid with Tawk.to fallback
     */
    public function conversation(Request $request)
    {
        $step = $request->input('step', 1);
        $selectedMedical = $request->input('medical_type');
        $selectedDistrict = $request->input('district');
        $userInput = $request->input('user_input');
        $unstructuredCount = $request->input('unstructured_count', 0);

        // Check if user input is unstructured (not following the flow)
        if ($userInput && $this->isUnstructuredInput($userInput, $step)) {
            return $this->handleUnstructuredInput($userInput, $unstructuredCount);
        }

        // Step 1: Choose medical service
        if ($step == 1) {
            $medicalTypes = \Modules\Chatbot\Models\MedicalList::orderBy('name')->pluck('name');
            return response()->json([
                'step' => 1,
                'message' => 'Please select the type of medical service you are looking for:',
                'buttons' => $medicalTypes->map(function($type) {
                    return ['label' => $type, 'value' => $type];
                })->values(),
                'unstructured_count' => 0, // Reset counter when following structured flow
            ]);
        }

        // Step 2: Choose district
        if ($step == 2 && $selectedMedical) {
            $districts = $this->getDistrictsDIY();
            return response()->json([
                'step' => 2,
                'message' => 'Please select the district in Yogyakarta:',
                'buttons' => collect($districts)->map(function($district) {
                    return ['label' => $district, 'value' => $district];
                }),
                'medical_type' => $selectedMedical,
                'unstructured_count' => 0, // Reset counter when following structured flow
            ]);
        }

        // Step 3: Show FAQ answer
        if ($step == 3 && $selectedMedical && $selectedDistrict) {
            $faq = \Modules\Chatbot\Models\Faq::where('medical_type', $selectedMedical)
                ->where('question', 'like', "%$selectedDistrict%")
                ->first();
            if ($faq) {
                return response()->json([
                    'step' => 3,
                    'message' => $faq->answer,
                    'medical_type' => $selectedMedical,
                    'district' => $selectedDistrict,
                    'unstructured_count' => 0, // Reset counter when following structured flow
                ]);
            } else {
                // No FAQ found - redirect to live chat
                return $this->redirectToLiveChat("I couldn't find information about $selectedMedical in $selectedDistrict. Let me connect you with our support team.");
            }
        }

        // Default fallback
        return response()->json([
            'step' => 1,
            'message' => 'Please select the type of medical service you are looking for:',
            'unstructured_count' => 0,
        ]);
    }

    /**
     * Handle unstructured user input with counter
     */
    private function handleUnstructuredInput($userInput, $unstructuredCount = 0)
    {
        // Try to find FAQ based on user input
        $faq = $this->findFAQByUserInput($userInput);
        
        if ($faq) {
            return response()->json([
                'step' => 3,
                'message' => $faq->answer,
                'medical_type' => $faq->medical_type,
                'district' => $faq->question,
                'found_by_search' => true,
                'unstructured_count' => 0, // Reset counter when FAQ is found
            ]);
        }

        // Increment unstructured count
        $newUnstructuredCount = $unstructuredCount + 1;
        
        // If this is the first unstructured question
        if ($newUnstructuredCount == 1) {
            return response()->json([
                'step' => 'unstructured_first',
                'message' => "I understand you're asking about: \"$userInput\". Let me try to help you with that. If I can't find the answer, please try asking in a different way or I'll connect you with our support team.",
                'unstructured_count' => $newUnstructuredCount,
                'user_input' => $userInput,
            ]);
        }
        
        // If this is the second unstructured question - redirect to live chat
        if ($newUnstructuredCount >= 2) {
            return $this->redirectToLiveChat("I understand you're asking about: \"$userInput\". Since I couldn't find the answer after trying twice, let me connect you with our support team for a more detailed answer.");
        }

        // Fallback
        return response()->json([
            'step' => 1,
            'message' => 'Please select the type of medical service you are looking for:',
            'unstructured_count' => 0,
        ]);
    }

    /**
     * Check if user input is unstructured
     */
    private function isUnstructuredInput($userInput, $step)
    {
        $input = strtolower(trim($userInput));
        
        // If user types something that's not a button option, it's unstructured
        if ($step == 1) {
            $medicalTypes = \Modules\Chatbot\Models\MedicalList::orderBy('name')->pluck('name')->toArray();
            return !in_array($userInput, $medicalTypes);
        }
        
        if ($step == 2) {
            $districts = $this->getDistrictsDIY();
            return !in_array($userInput, $districts);
        }
        
        return true;
    }

    /**
     * Find FAQ by user input using fuzzy search
     */
    private function findFAQByUserInput($userInput)
    {
        $input = strtolower(trim($userInput));
        
        // Search in FAQ questions and answers
        $faq = \Modules\Chatbot\Models\Faq::where(function($query) use ($input) {
            $query->where('question', 'like', "%$input%")
                  ->orWhere('answer', 'like', "%$input%")
                  ->orWhere('medical_type', 'like', "%$input%");
        })->first();
        
        return $faq;
    }

    /**
     * Redirect to Tawk.to live chat
     */
    private function redirectToLiveChat($message)
    {
        $config = config('chatbot.tawkto');
        
        return response()->json([
            'step' => 'live_chat',
            'message' => $message,
            'redirect_to_live_chat' => true,
            'redirect_delay' => $config['auto_redirect_delay'],
            'tawkto_script' => $this->getTawkToScript()
        ]);
    }

    /**
     * Get Tawk.to script configuration
     */
    private function getTawkToScript()
    {
        $config = config('chatbot.tawkto');
        $widgetId = $config['widget_id'];
        
        if ($widgetId === 'YOUR_TAWKTO_WIDGET_ID') {
            // Return error message if not configured
            return null;
        }
        
        return "
        <!--Start of Tawk.to Script-->
        <script type=\"text/javascript\">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/{$widgetId}';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <!--End of Tawk.to Script-->
        ";
    }

    private function getDistrictsDIY()
    {
        return [
            'Bantul', 'Banguntapan', 'Bantul', 'Dlingo', 'Imogiri', 'Jetis', 'Kasihan', 'Kretek', 'Pajangan', 'Pandak', 'Piyungan', 'Pleret', 'Pundong', 'Sanden', 'Sedayu', 'Sewon', 'Srandakan',
            'Gunungkidul', 'Gedangsari', 'Girisubo', 'Karangmojo', 'Ngawen', 'Nglipar', 'Paliyan', 'Panggang', 'Patuk', 'Playen', 'Ponjong', 'Purwosari', 'Rongkop', 'Saptosari', 'Semanu', 'Semin', 'Tanjungsari', 'Tepus', 'Wonosari',
            'Kulon Progo', 'Galur', 'Girimulyo', 'Kalibawang', 'Kokap', 'Lendah', 'Nanggulan', 'Panjatan', 'Pengasih', 'Samigaluh', 'Sentolo', 'Temon', 'Wates',
            'Sleman', 'Berbah', 'Cangkringan', 'Depok', 'Gamping', 'Godean', 'Kalasan', 'Minggir', 'Mlati', 'Moyudan', 'Ngaglik', 'Ngemplak', 'Pakem', 'Prambanan', 'Seyegan', 'Sleman', 'Tempel', 'Turi',
            'Yogyakarta', 'Danurejan', 'Gedongtengen', 'Gondokusuman', 'Gondomanan', 'Jetis', 'Kotagede', 'Kraton', 'Mantrijeron', 'Mergangsan', 'Ngampilan', 'Pakualaman', 'Tegalrejo', 'Umbulharjo', 'Wirobrajan',
        ];
    }

    /**
     * Get Tawk.to configuration for frontend
     */
    public function getTawkToConfig()
    {
        // Hardcoded config for debugging
        return response()->json([
            'enabled' => true,
            'widget_id' => '68507566a1bfba190de84b28/1itt4l687',
            'auto_redirect_delay' => 3000,
        ]);
    }
} 