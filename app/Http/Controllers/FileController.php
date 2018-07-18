<?php

namespace App\Http\Controllers;

use App\File;
use App\Libraries\JDF;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function store(Request $request)
    {
        $name = $request->get('name');
        $jdf = new JDF();

        $file = new File();
        $file->name = $name;
        $file->create_date = $jdf->getTimestamp();
        $file->save();

        if ($file)
            return response()->json([
                'error' => false
            ], 200);

        else
            return response()->json([
                'error' => true,
                'error_msg' => 'درخواست شما انججام نشد!!'
            ], 200);

    }

    public function update(Request $request, $file)
    {
        $file = File::find($file);
        $file->update($request->all());

        return response()->json([
            'error' => false
        ], 200);
    }


    public function destroy($file)
    {
        $file = File::find($file);
        $file->delete();
        return response()->json([
            'error' => false
        ], 200);
    }
}
