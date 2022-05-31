<?php

namespace App\Utilities;

class Assembler
{
    /**
     * @var array
     */
    private array $products;

    /**
     * @var array
     */
    private array $articles;

    /**
     * Assembler Constructor.
     * Get content from inputs and put them in properties.
     * @param array $request
     */
    public function __construct(array $request)
    {
        $articles       = $this->getContent($request['articles']);
        $articles       = $this->jsonDecode($articles);
        $this->articles = $articles['articles'];
        $products       = $this->getContent($request['products']);
        $products       = $this->jsonDecode($products);
        $this->products = $products['products'];
    }

    /**
     * Return products property.
     *
     * @return array
     */
    public function products(): array
    {
        return $this->products;
    }

    /**
     * Return articles property.
     *
     * @return array
     */
    public function articles(): array
    {
        return $this->articles;
    }

    /**
     * Build products based on inventory and sorted by price.
     *
     * It will reduce quantities used by products from article stocks.
     */
    public function build()
    {
        $this->sortByPrice();
        $this->IdAsKey();
        $this->make();
    }

    /**
     * @param $data
     * @return false|string
     */
    private function getContent($data)
    {
        return file_get_contents($data->getRealPath());
    }

    /**
     * @param $data
     * @return array
     */
    private function jsonDecode($data): array
    {
        return json_decode($data, true);
    }

    /**
     * Sort products array by price Desc.
     *
     * @return void
     */
    private function sortByPrice(): void
    {
        $products = collect($this->products);
        $sorted = $products->sortByDesc(function ($product) {
            return $product['price'];
        });
        $this->products = $sorted->values()->all();
    }

    /**
     * Change key of articles index to id of article.
     *
     * @return void
     */
    private function IdAsKey(): void
    {
        $articles = [];
        foreach ($this->articles as $article) {
            $articles[$article['id']] = $article;
        }
        $this->articles = $articles;
    }

    /**
     * This method make products based on inventory.
     */
    private function make()
    {
        $articles = $this->articles;
        $products = $this->products;
        foreach ($products as $key => $product) {
            unset($productsCount);
            foreach ($product['articles'] as $article) {
                $productsByArticleCount = (int) floor($articles[$article['id']]['stock'] / $article['amount']);
                if(!isset($productsCount)) {
                    $productsCount = $productsByArticleCount;
                    continue;
                }
                $productsCount = min($productsByArticleCount, $productsCount);
            }
            if (isset($productsCount) && $productsCount > 0) {
                foreach ($product['articles'] as $article) {
                    $articles[$article['id']]['stock'] = $articles[$article['id']]['stock'] - ($article['amount'] * $productsCount);
                }
            }
            $products[$key]['stock'] = $productsCount ?? 0;
        }
        $this->products = $products;
        $this->articles = $articles;
    }
}
