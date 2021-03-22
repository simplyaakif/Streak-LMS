<?php

    namespace Database\Factories;

    use App\Models\Employee;
    use App\Models\Student;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Carbon;

    class StudentFactory extends Factory {

        protected $model = Student::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition()
        {
            return [
                'name'           => $this->faker->name,
                'father_name'    => $this->faker->name,
                'gender'         => $this->faker->randomElement(['Male','Female']),
                'nationality'    => $this->faker->word,
                'place_of_birth' => $this->faker->word,
                'first_language' => $this->faker->word,
                'date_of_birth'  => null,
                'cnic_passport'  => $this->faker->word,
                'mobile'         => $this->faker->phoneNumber,
                'email'          => $this->faker->unique()->safeEmail,
                'landline'       => $this->faker->word,
                'user_id'        => $this->faker->randomElement([1,2,3,4])
            ];
        }
    }
