<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class WangEditorResourcesController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        $urls = [];
        foreach ($data as $datum) {
            if ($datum instanceof UploadedFile) {
                $urls[] = Storage::disk('admin')->url($datum->store('wang-editor', 'admin'));
            }
        }

        return [
            'errno' => 0,
            'data' => $urls,
        ];
    }
}
