<?php

namespace App\Http\Controllers\api\v1;

use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticlesController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title'     => 'required',
                'content'   => 'required',
            ],
            [
                'title.required' => 'Input data title !',
                'content.required' => 'Input data content !',
            ]
        );

        // mengecek validator
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Input data here',
                'data'    => $validator->errors()
            ], 401);
        } else {
            // jika berhasil, lanjut create data
            $post = Article::create([
                'title' => $request->input('title'),
                'content' => $request->input('content')
            ]);

            // mengecek data yang dicreate
            if ($post) {
                // jika berhasil
                return response()->json([
                    'success' => true,
                    'message' => 'Data saved successfully'
                ], 200);
            } else {
                // jika gagal
                return response()->json([
                    'success' => false,
                    'message' => 'Data failed to save'
                ], 401);
            }
        }
    }
}
