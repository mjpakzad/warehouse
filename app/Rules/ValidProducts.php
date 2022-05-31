<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidProducts implements Rule
{
    /**
     * @var array $data
     */
    private $data;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Determine if the validation rule passes.
     *
     * The file must have the following structure:
     * ```json
     * {
            "products": [
                {
                    "name": "Dining Chair",
                    "price" : 1000,
                    "articles": [
                        {
                            "id": 1,
                            "amount": 4
                        }
                    ]
                },
            ]
        }
     * ```
     * This rule checks to determine if price of product and id and amount of articles are integer.
     * This rule also checks to determine if id of articles inside each product defined in products.json file.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $articles = file_get_contents($this->data['articles']->getRealPath());
        $products = file_get_contents($value->getRealPath());
        $articles = json_decode($articles, true);
        $products = json_decode($products, true);
        $articleIds = [];
        $articles = $articles['articles'];
        foreach ($articles as $article) {
            $articleIds[$article['id']] = $article['stock'];
        }
        if(!isset($products['products'])) {
            return false;
        }
        $products = $products['products'];

        foreach ($products as $product) {
            if(!isset($product['name'], $product['price'], $product['articles'])) {
                return false;
            }
            if(!is_int($product['price']) OR !is_array($product['articles'])) {
                return false;
            }
            foreach ($product['articles'] as $productArticle) {
                $articleIdKeys = array_keys($articleIds);
                if(!is_int($productArticle['id']) OR !is_int($productArticle['amount']) OR !in_array($productArticle['id'], $articleIdKeys)) {
                    return false;
                }
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
        return __('The products file is invalid.');
    }
}
