<?php

    namespace Database\Seeders;

    use App\Models\QueryInteractionType;
    use Illuminate\Database\Seeder;

    class QueryInteractionTypeSeeder extends Seeder {

        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $queryInteractionType = [
                [
                    'id'   => 1,
                    'title' => 'Campus Visit',
                ],
                [
                    'id'   => 2,
                    'title' => 'Call',
                ],
                [
                    'id'   => 3,
                    'title' => 'Online Chat',
                ],
            ];

            QueryInteractionType::insert($queryInteractionType);
        }
    }
