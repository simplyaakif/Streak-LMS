<?php

    namespace Database\Factories;

    use App\Models\Employee;
    use App\Models\Query;
    use App\Models\QueryInteractionType;
    use App\Models\QueryStatus;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Carbon;

    class QueryFactory extends Factory {

        protected $model = Query::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition()
        {
            return [
                'name'             => $this->faker->name,
                'mobile_number'    => $this->faker->phoneNumber,
                'email'            => $this->faker->unique()->safeEmail,
                'address'          => $this->faker->address,
                'comments_remarks' => $this->faker->word,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
                'dealt_by_id'         => $this->faker->randomElement([1,2,3,4]),
                'interaction_type_id' => 1,
                'status_id'           => 1,
            ];
        }
    }
