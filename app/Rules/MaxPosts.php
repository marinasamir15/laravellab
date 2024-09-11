<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Post;

class MaxPosts implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
      
        $userId = auth()->id();

       
        $postCount = Post::where('user_id', $userId)->count();

        
        return $postCount < 3;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You can only create up to 3 posts.';
    }
}
