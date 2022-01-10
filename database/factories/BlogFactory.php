<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Location;
use App\Models\UserRecruitment;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->name(),
            "user_id" => UserRecruitment::all()->random()->id,
            "cate_id" => Category::all()->random()->id,
            "location_id" => Location::all()->random()->id,
            "image" => "uploads/blogs/" . 'image.png',
            "deadline" => "2021-10-22",
            "position" => "Nhân viên",
            "detail" => "
            abc
            abc
            abcanasj
            ",
            "slug" => $this->faker->name() . '-' . rand(100, 999),
            "salary_min" => rand(5000000, 10000000),
            "salary_max" => rand(10000000, 20000000),
            "quantity" => rand(1, 200),
            "working_time" => 'Full time',
            "quantity" => rand(5, 20),
            "exp" => 'Trên 1 năm',
            "gender" => 0,
            "enable" => 1
        ];
    }
}
