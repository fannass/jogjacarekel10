<?php

namespace Modules\MedicalTreatment\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalTreatment extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'medical_treatments';

    protected $fillable = ['name', 'slug', 'type', 'intro', 'description', 'benefits', 'meta_title', 'meta_description', 'meta_keywords', 'image', 'status', 'rating'];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\MedicalTreatment\database\factories\MedicalTreatmentFactory::new();
    }
}