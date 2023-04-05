<?php

namespace App\Rules;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxPostsPerUser implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //Validat there are max 3 posts for one user
        $posts = Post::where('user_id', $value)->get();
        if (count($posts) >= 3) {
            $fail('You have reached your limit, you can post maximum 3 posts');
        }

    }
}
