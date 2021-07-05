<?php

namespace App\Http\Controllers\api\v1;

use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticlesController extends Controller
{
    public function index()
    {
        $article = Article::latest()->get();
        return response()->json([
            'success' => true,
            'message' => 'View all data article',
            'data' => $article
        ], 200);
    }

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
            $article = Article::create([
                'title' => $request->input('title'),
                'content' => $request->input('content')
            ]);

            // mengecek data yang dicreate
            if ($article) {
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

    public function show($id)
    {
        $article = Article::whereId($id)->first();

        if ($article) {
            return response()->json([
                'success' => true,
                'message' => 'Detail article',
                'data' => $article
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => ''
            ], 401);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required'
        ], [
            'title.required' => 'Input data title !',
            'content.required' => 'Input data content !'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Input data here!',
                'data' => $validator->errors()
            ], 401);
        } else {

            $article = Article::whereId($request->input('id'))->update([
                'title' => $request->input('title'),
                'content' => $request->input('content')
            ]);

            if ($article) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data updated successfully',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data failed to update'
                ], 401);
            }
        }
    }
}
