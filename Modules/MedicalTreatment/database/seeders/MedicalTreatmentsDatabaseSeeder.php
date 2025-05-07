<?php

namespace Modules\MedicalTreatment\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\MedicalTreatment\Models\MedicalTreatment;

class MedicalTreatmentDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        /*
         * MedicalTreatments Seed
         * ------------------
         */

        // DB::table('medicaltreatments')->truncate();
        // echo "Truncate: medicaltreatments \n";

        MedicalTreatment::factory()->count(20)->create();
        $rows = MedicalTreatment::all();
        echo " Insert: medicaltreatments \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
