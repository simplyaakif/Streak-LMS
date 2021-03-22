<?php

    namespace Database\Seeders;

    use App\Models\QueryStatus;
    use Illuminate\Database\Seeder;

    class QueryStatusSeeder extends Seeder {

        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $queryStatus = [
                [
                    'id'   => 1,
                    'title' => 'Information Given',
                ],[
                    'id'   => 2,
                    'title' => 'Converted',
                ],
            ];

            QueryStatus::insert($queryStatus);
        }
    }
