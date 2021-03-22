<?php

    namespace Database\Factories;

    use App\Models\SmsTemplate;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Carbon;

    class SmsTemplateFactory extends Factory {

        protected $model = SmsTemplate::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition()
        {
            return [
                'title'        => $this->faker->word,
                'sms_template' => $this->faker->word,
                'active'       => $this->faker->boolean,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ];
        }
    }
