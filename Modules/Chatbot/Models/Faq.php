<?php

namespace Modules\Chatbot\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Chatbot\Database\Factories\FaqFactory;

class Faq extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'medical_type',    // Jenis medical (hospital, clinic, pharmacy, dll)
        'question',        // Pertanyaan default
        'answer',          // Jawaban default
        'location_type',   // Tipe lokasi (kecamatan, kelurahan, dll)
        'is_active'        // Status aktif/nonaktif
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Relasi dengan tabel medical (jika diperlukan)
    public function medical()
    {
        return $this->belongsTo('App\Models\Medical', 'medical_type', 'type');
    }

    // protected static function newFactory(): FaqFactory
    // {
    //     // return FaqFactory::new();
    // }
} 