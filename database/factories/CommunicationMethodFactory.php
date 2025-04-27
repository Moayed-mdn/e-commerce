<?php

namespace Database\Factories;

use App\Models\CommunicationMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommunicationMethod>
 */
class CommunicationMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word
        ];
    }

    public function createDefaultMethods(){
        $methods=['email','phone number'];
        foreach($methods as $method)
            CommunicationMethod::firstOrCreate([
                'name'=>$method
            ]);

    }

}
