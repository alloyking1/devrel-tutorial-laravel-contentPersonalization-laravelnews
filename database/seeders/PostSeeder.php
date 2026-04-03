<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Data\PostData;
use App\Services\EmbeddingService;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $embeddingService = app(EmbeddingService::class);
        $postData = PostData::all();

        foreach ($postData as $post) {

            $text = $post['title'] . ' ' . $post['body'];
            $embedding = $embeddingService->generate($text);

            Post::factory()->create([
                'title' => $post['title'],
                'body' => $post['body'],
                'embedding' => $embedding,
            ]);
        }
    }
}
