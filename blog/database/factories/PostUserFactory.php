<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\PostUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostUser::class;

    protected $users = null;
    protected $posts = null;

    public function __construct() {
        parent::__construct();
        $this->users = User::all();
        $this->posts = Post::all();
    }
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'user_id' => $this->users->random()->id,
            'post_id' => $this->posts->random()->id,
            // 'user_id' => 1,
            // 'post_id' => 4,
        ];
    }
}
