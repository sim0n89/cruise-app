<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function fileStore(Request $request)
    {
        $this->validate($request, [
            'file' => ['required', 'mimes:jpeg,gif,bmp,png', 'max:2048']
        ]);
        $file = request()->file('file');
        $path = '/storage/'.$file->store('','public');
        return response()->json(['file' =>  $path ]);
    }
}
