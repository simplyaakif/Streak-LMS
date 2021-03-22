<?php

    namespace Database\Seeders;

    use App\Models\BatchStudent;
    use Illuminate\Database\Seeder;

    class BatchStudentSeeder extends Seeder {

        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            BatchStudent::factory()->count(20)->create();
        }
    }
