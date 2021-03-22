<?php

    namespace Database\Seeders;

    use App\Models\Batch;
    use App\Models\BatchStudent;
    use App\Models\Student;
    use App\Models\User;
    use Illuminate\Database\Seeder;

    class StudentSeeder extends Seeder {

        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            Student::factory()
                ->count(10)->create();
        }
    }
