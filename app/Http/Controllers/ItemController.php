<?php

namespace App\Http\Controllers;

use App\Item;
use App\Libraries\JDF;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $item = Item::all();

        return response()->json([

            'error' => false,
            'items' => $item

        ], 200);
    }

    public function show($item)
    {

        $item = Item::find($item);
        return response()->json([
            'error' => false,
            'item' => $item,
            'files' => $item->files
        ], 200);
    }

    public function store(Request $request)
    {
        $name = $request->get('name');

        $jdf = new JDF();

        $item = new Item();
        $item->name = $name;
        $item->create_date = $jdf->getTimestamp();
        $item->save();

        if ($item)
            return response()->json([
                'error' => false
            ], 200);
        else
            return response()->json([
                'error' => true,
                'error_msg' => 'درخواست انجام نشد!'
            ], 200);
    }

    public function update(Request $request, $item)
    {
        $item = Item::find($item);
        $item = update($request->all());

        return response()->json([
            'error' => false
        ], 200);
    }


    public function destroy($item){
        $item = Item::find($item);
        $item ->delete();

        return response()->json([
            'error'=>false
        ],200);
    }
}
