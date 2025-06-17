<?php

namespace Modules\Chatbot\App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use Modules\MedicalTreatment\Models\MedicalTreatment;
use Modules\MedicalAlter\Models\MedicalAlter;
use Modules\MedicalCenter\Models\MedicalCenter;
use Modules\MedicalPoint\Models\MedicalPoint;
use Modules\MedicalCost\Models\MedicalCost;
use Modules\MedicalCare\Models\MedicalCare;
use Modules\Chatbot\Models\Faq;
use Modules\Chatbot\Models\MedicalList;

class MedicalServiceConversation extends Conversation
{
    protected $serviceType;
    protected $medicalList = [];

    public function run()
    {
        $this->showMedicalList();
    }

    public function showMedicalList()
    {
        $this->medicalList = $this->getAllMedicalList();
        $message = "Selamat datang di Layanan Kesehatan Jogja! Silakan pilih layanan yang Anda butuhkan:\n";
        foreach ($this->medicalList as $i => $item) {
            $message .= ($i+1) . ". " . $item['label'] . "\n";
        }
        $message .= "(Ketik angka sesuai pilihan)";
        $this->ask($message, function($answer) {
            $choice = intval(trim($answer->getText()));
            if ($choice >= 1 && $choice <= count($this->medicalList)) {
                $this->serviceType = $this->medicalList[$choice-1];
                $this->askDistrict();
            } else {
                $this->say('Pilihan tidak valid. Silakan ketik angka sesuai daftar.');
                $this->repeat();
            }
        });
    }

    public function askDistrict()
    {
        $this->ask('Sekarang Anda berada di kecamatan mana di wilayah Yogyakarta?', function($answer) {
            $district = trim($answer->getText());
            $results = $this->getMedicalByTypeAndDistrict($this->serviceType, $district);

            if (count($results)) {
                $list = '';
                foreach ($results as $item) {
                    $list .= "- {$item->name}\n";
                }
                $this->say("Berikut adalah fasilitas *{$this->serviceType['label']}* yang tersedia di Kecamatan {$district}:\n{$list}");
            } else {
                $this->say("Maaf, belum ada data {$this->serviceType['label']} di Kecamatan {$district}.");
            }
        });
    }

    public function getAllMedicalList()
    {
        $list = [];
        $types = MedicalList::pluck('name');
        foreach ($types as $type) {
            $list[] = ['type' => 'medical_list', 'label' => $type];
        }
        return $list;
    }

    public function getMedicalByTypeAndDistrict($serviceType, $district)
    {
        return Faq::where('medical_type', $serviceType['label'])
            ->where(function($q) use ($district) {
                $q->where('location_type', 'like', "%{$district}%")
                  ->orWhere('question', 'like', "%{$district}%");
            })
            ->get();
    }
} 