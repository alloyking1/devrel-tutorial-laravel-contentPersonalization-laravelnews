<?php

namespace App\Http\Controllers;

use App\Models\Post;
use MongoDB\BSON\ObjectId;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index($id)
    {

        // 1. Get current post
        $post = Post::findOrFail($id);

        // 2. Access native MongoDB collection
        $collection = DB::connection('mongodb')
            ->getMongoDB()
            ->selectCollection('posts');

        // 3. Run vector search (RAW MongoDB QUERY)
        $cursor = $collection->aggregate([
            [
                '$vectorSearch' => [
                    'index' => 'vector_index',
                    'queryVector' => $post->embedding,
                    'path' => 'embedding',
                    'numCandidates' => 100,
                    'limit' => 5,
                ]
            ]
        ]);

        // 4. Convert to Laravel collection
        $results = collect($cursor->toArray());

        // 5. Remove current post + format
        $recommendations = $results
            ->filter(fn ($item) => (string) $item['_id'] !== (string) $post->_id)
            ->map(fn ($item) => [
                'id' => (string) $item['_id'],
                'title' => $item['title'],
            ])
            ->values();

        // 6. Return response
        return response()->json([
            'post' => [
                'title' => $post->title,
                'body' => $post->body,
            ],
            'recommendations' => $recommendations,
        ]);

    }
}