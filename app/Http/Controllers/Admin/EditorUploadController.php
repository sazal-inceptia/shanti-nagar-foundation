<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EditorUploadController extends Controller
{
    /**
     * Handle image and media uploads from CKEditor.
     */
    public function upload(Request $request): JsonResponse
    {
        $request->validate([
            'upload' => 'required|file|mimes:jpeg,png,jpg,gif,webp,svg,pdf,doc,docx|max:10240',
        ]);

        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'_'.uniqid().'.'.$extension;
            $destinationPath = public_path('uploads/editor');

            if (! File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $file->move($destinationPath, $fileName);
            $url = asset('uploads/editor/'.$fileName);

            return response()->json([
                'url' => $url,
                'fileName' => $fileName,
                'uploaded' => 1,
            ]);
        }

        return response()->json([
            'uploaded' => 0,
            'error' => [
                'message' => 'No file was uploaded.',
            ],
        ], 400);
    }
}
