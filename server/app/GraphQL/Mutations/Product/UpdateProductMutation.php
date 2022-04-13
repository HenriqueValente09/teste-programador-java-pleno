<?php

namespace App\GraphQL\Mutations\Product;

use App\Models\Product;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateProductMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateProduct',
        'description' => 'Updates a product'
    ];

    public function type(): Type
    {
        return GraphQL::type('Product');
    }

    public function args(): array
    {
        return [
            'code' => [
                'name' => 'code',
                'type' => Type::nonNull(Type::string()),
            ],
            'desc' => [
                'name' => 'desc',
                'type' => Type::nonNull(Type::string()),
            ],
            'units' => [
                'name' => 'units',
                'type' => Type::nonNull(Type::int()),
            ],
            'price' => [
                'name' => 'price',
                'type' => Type::nonNull(Type::string()),
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $product = Product::where('code', $args['code'])->first();
        $product->fill($args);
        $product->save();

        return $product;
    }
}