<?php

namespace App\Transformers;

class ItemTransformer extends Transformer
{

    public function transform($item)
    {
        return [
            'name'        => $item['name'],
            'description' => $item['description'],
            'active'      => !(boolean)$item['disabled'],
        ];
    }

}