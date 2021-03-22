<?php

    namespace Database\Factories;

    use App\Models\Employee;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Carbon;

    class EmployeeFactory extends Factory {

        protected $model = Employee::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition()
        {
            return [
                'name'            => $this->faker->name,
                'mobile'          => $this->faker->phoneNumber,
                'email'           => $this->faker->unique()->safeEmail,
                'address'         => $this->faker->address,
                'city'            => $this->faker->city,
                'date_of_birth'   => null,
                'gender'          => $this->faker->word,
                'marital_status'  => $this->faker->word,
                'job_title'       => $this->faker->word,
                'cnic_passport'   => $this->faker->word,
                'qualification'   => $this->faker->word,
                'experience'      => $this->faker->word,
                'relegion'        => $this->faker->word,
                'earning_type'    => $this->faker->word,
                'basic_salary'    => $this->faker->randomFloat(),
                'medical'         => $this->faker->randomFloat(),
                'conveyance'      => $this->faker->randomFloat(),
                'deduction_leave' => $this->faker->randomFloat(),
                'deduction_loan'  => $this->faker->randomFloat(),
                'deduction_tax'   => $this->faker->randomFloat(),
                'deduction_other' => $this->faker->randomFloat(),
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
                'user_id' => $this->faker->randomElement([1,2,3,4])
            ];
        }
    }
