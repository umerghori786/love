<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $timestamp = rand( strtotime("MAY 01 2026"), strtotime("MAY 31 2026") );
        return [
            'title'=>$this->faker->title(),
            'description' => $this->faker->paragraph(),
            'due_date' => date("Y-m-d", $timestamp ),
            'remiander_date' => date("Y-m-d", $timestamp ),
            'is_completed'  => rand(0,1),
        ];
    }
}
