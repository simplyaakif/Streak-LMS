<?php

    namespace Database\Factories;

    use App\Models\Course;
    use App\Models\CourseDuration;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Carbon;

    class CourseFactory extends Factory {

        protected $model = Course::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition()
        {
            return [
                'title'           => $this->faker->word,
                'description'     => $this->faker->text,
                'fee'             => $this->faker->randomFloat(),
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
                'course_duration_id' => $this->faker->randomElement([1,2,3]),
            ];
        }
    }
