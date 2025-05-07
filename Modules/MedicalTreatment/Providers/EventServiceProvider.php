<?php

namespace Modules\MedicalTreatment\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [

        /**
         * Backend
         */
        'Modules\MedicalTreatment\Events\Backend\MedicalTreatmentCreated' => [
            'Modules\MedicalTreatment\Listeners\Backend\MedicalTreatmentCreated\UpdateMedicalTreatmentOnCreate',
        ],

        'Modules\MedicalTreatment\Events\Backend\MedicalTreatmentUpdated' => [
            'Modules\MedicalTreatment\Listeners\Backend\MedicalTreatmentUpdated\UpdateMedicalTreatmentOnUpdate',
        ],

        'Modules\MedicalTreatment\Events\Backend\MedicalTreatmentDeleted' => [
            'Modules\MedicalTreatment\Listeners\Backend\MedicalTreatmentDeleted\UpdateMedicalTreatmentOnDelete',
        ],

        /**
         * Frontend
         */
    ];
}
