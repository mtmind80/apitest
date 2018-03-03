<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Transformers\ItemTransformer;
use App\Item;
use App\Observers\ItemObserver;

class ItemsController extends ApiController
{

    protected $itemTransformer;

    public function __construct(ItemTransformer $itemTransformer)
    {
        Item::observe(new ItemObserver);

        $this->itemTransformer = $itemTransformer;
    }

    public function index()
    {
        $items = Item::all();

        $response = [
            'data' => $this->itemTransformer->transformCollection($items),
        ];

        return $this->respond($response);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make(
            [
                'name'        => $request->name,
                'description' => $request->description,
            ],
            [
                'name'        => 'required|string|min:6',
                'description' => 'required|string|min:20',
            ]
        );

        if ($validator->fails()) {
            $messages = [];

            foreach ($validator->errors()->all() as $error) {
                $messages[] = $error;
            }

            return $this->respondValidationFailed(implode(' ', $messages));
        }

        Item::create($request->all());

        return $this->respondCreated();
    }

    public function show($id)
    {
        $item = Item::find($id);

        if (empty($item)) {
            return $this->respondNotFound('Item does not exists.');
        }

        $response = [
            'data' => $this->itemTransformer->transform($item),
        ];

        return $this->respond($response);
    }

    public function status($id)
    {
        $item = Item::find($id);

        if (empty($item)) {
            return $this->respondNotFound('Item does not exists.');
        }

        $response = [
            'data' => [
                'status' => empty($item->disabled) ? 'enabled' : 'disabled',
            ]
        ];

        return $this->respond($response);
    }

    public function enable($id)
    {
        $item = Item::find($id);

        if (empty($item)) {
            return $this->respondNotFound('Item does not exists.');
        }

        $item->disabled = 0;
        $item->save();

        return $this->respondUpdated('Item enabled.');
    }

    public function disable($id)
    {
        $item = Item::find($id);

        if (empty($item)) {
            return $this->respondNotFound('Item does not exists.');
        }

        $item->disabled = 1;
        $item->save();

        return $this->respondUpdated('Item disabled.');
    }

    public function update(Request $request, $id)
    {
        $item = Item::find($id);

        if (empty($item)) {
            return $this->respondNotFound('Item does not exists.');
        }

        $validator = \Validator::make(
            [
                'name'        => $request->name,
                'description' => $request->description,
            ],
            [
                'name'        => 'required|string|min:6',
                'description' => 'required|string|min:20',
            ]
        );

        if ($validator->fails()) {
            $messages = [];

            foreach ($validator->errors()->all() as $error) {
                $messages[] = $error;
            }

            return $this->respondValidationFailed(implode(' ', $messages). ' name: '. $request->name);
        }

        $item->update($request->all());

        return $this->respondUpdated();
    }


}
