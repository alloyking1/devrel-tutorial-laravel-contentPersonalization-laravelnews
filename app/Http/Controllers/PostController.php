<?php

namespace App\Http\Controllers;

use App\Models\Post;
use MongoDB\BSON\ObjectId;

class PostController extends Controller
{
    public function index($id)
    {
        // 1. Get the current post
        $post = Post::findOrFail($id);

        // 2. Run vector search
        $results = Post::raw(function ($collection) use ($post) {
            return $collection->aggregate([
                [
                    '$vectorSearch' => [
                        'index' => 'vector_index', // your index name
                        'queryVector' => $post->embedding,
                        'path' => 'embedding',
                        'numCandidates' => 100,
                        'limit' => 5
                    ]
                ],
                [
                    '$match' => [
                        '_id' => [
                            '$ne' => new ObjectId($post->_id)
                        ]
                    ]
                ]
            ]);
        });

        // 3. Format recommendations
        $recommendations = collect($results)->map(function ($item) {
            return [
                'id' => (string) $item['_id'],
                'title' => $item['title'],
            ];
        });
    
        // 4. Return structured response
        return response()->json([
            'post' => [
                'title' => $post->title,
                'body' => $post->body,
            ],
            'recommendations' => $recommendations,
        ]);
    }
}
