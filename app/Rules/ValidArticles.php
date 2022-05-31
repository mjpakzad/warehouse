<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidArticles implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * The file must have the following structure:
     * ```json
     * {
            "articles": [
                {
                    "id": 1,
                    "name": "leg",
                    "stock": 12
                }
            ]
        }
     * ```
     * This rule also checks to determine if id and stock are integer.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $articles = file_get_contents($value->getRealPath());
        $articles = json_decode($articles, true);
        if(!isset($articles['articles'])) {
            return false;
        }
        $articles = $articles['articles'];
        foreach ($articles as $article) {
            if(!isset($article['id'], $article['name'], $article['stock'])) {
                return false;
            }
            if(!is_int($article['id']) OR !is_int($article['stock'])) {
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('The articles file is invalid.');
    }
}
