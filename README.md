# Laravel Content Personalization Demo

An open source Laravel 13 demo application that shows how to build article recommendations with MongoDB vector search and AI-generated embeddings.

This repository accompanies a tutorial published on Laravel News. It demonstrates a minimal content-personalization workflow where article content is embedded with a Hugging Face model, stored in MongoDB, and queried through a vector index to return semantically similar posts.

## What This Project Does

- Stores article content in MongoDB.
- Generates embeddings for each article through the Hugging Face Inference API.
- Uses MongoDB vector search to find related posts.
- Exposes a simple Laravel API endpoint for fetching a post and its recommendations.

The current demo is intentionally small and API-first. The recommendation flow lives in the backend, and the main example endpoint is:

```text
GET /api/posts/{id}
```

## Tech Stack

- PHP 8.3+
- Laravel 13
- MongoDB with the Laravel MongoDB driver
- MongoDB Atlas Vector Search or another MongoDB deployment that supports `$vectorSearch`
- Hugging Face Inference API for embeddings
- Vite and Tailwind CSS 4 for frontend assets
- SQLite for Laravel framework tables such as sessions, cache, jobs, and personal access tokens

## How It Works

1. Seed content is defined in the post factory.
2. During seeding, the app sends each post's title and body to the configured Hugging Face embedding endpoint.
3. The returned embedding is stored alongside the post document in MongoDB.
4. When you request a post by ID, the app runs a MongoDB `$vectorSearch` query against the `embedding` field.
5. The API returns the selected post plus a list of recommended posts.

## Prerequisites

Before running the project locally, make sure you have:

- PHP 8.3 or newer
- Composer
- Node.js 20+ and npm
- A MongoDB database
- A Hugging Face API key
- A Hugging Face embedding model endpoint URL

## Local Setup

### 1. Clone and install dependencies

```bash
git clone <your-fork-or-repo-url>
cd devrel-tutorial-laravel-contentPersonalization-laravelnews
composer install
npm install
```

### 2. Create the environment file

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Create the SQLite database used by Laravel infrastructure

This project uses MongoDB for article data, but the default Laravel tables still use SQLite.

```bash
touch database/database.sqlite
```

### 4. Configure environment variables

Update `.env` with values like these:

```dotenv
APP_NAME="Laravel Content Personalization Demo"
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/this/project/database/database.sqlite

MONGODB_URI="your-mongodb-connection-string"
MONGODB_DATABASE="your-database-name"

HUGGINGFACE_API_KEY="your-hugging-face-api-key"
HUGGINGFACE_API_URL="https://api-inference.huggingface.co/pipeline/feature-extraction/<model-name>"
```

Notes:

- Keep `DB_CONNECTION=sqlite` unless you also rework the Laravel framework tables.
- `MONGODB_URI` and `MONGODB_DATABASE` are used by the `mongodb` connection configured in the app.
- `HUGGINGFACE_API_URL` must point to an embedding-capable endpoint that returns a numeric vector for the provided text.

### 5. Run migrations

```bash
php artisan migrate
```

### 6. Seed the demo content

Seeding generates embeddings through the Hugging Face API, so your MongoDB and Hugging Face settings must already be valid.

```bash
php artisan db:seed
```

### 7. Create the MongoDB vector index

The recommendation query expects a vector index named `vector_index` on the `embedding` field in the `posts` collection.

You need to create that index in MongoDB Atlas or your supported MongoDB deployment before recommendations will work.

The embedding dimensions in the index must match the length of the vectors returned by your configured Hugging Face model.

### 8. Start the application

For local development:

```bash
composer run dev
```

This starts:

- The Laravel development server
- The queue listener
- Laravel Pail log streaming
- The Vite dev server

If you only want the backend API, you can run:

```bash
php artisan serve
```

## API Usage

### Get a post with recommendations

```bash
curl http://127.0.0.1:8000/api/posts/<post-id>
```

Example response:

```json
{
    "post": {
        "title": "Getting Started with Laravel APIs",
        "body": "..."
    },
    "recommendations": [
        {
            "id": "67f...",
            "title": "Building REST APIs in Laravel"
        }
    ]
}
```

## Useful Commands

```bash
composer run dev
composer run test
php artisan migrate
php artisan db:seed
npm run dev
npm run build
```

## Project Structure

- `app/Http/Controllers/PostController.php`: Recommendation API endpoint
- `app/Models/Post.php`: MongoDB-backed post model
- `app/Services/EmbeddingService.php`: Hugging Face API integration
- `database/factories/PostFactory.php`: Demo content plus embedding generation during seeding
- `database/seeders/PostSeeder.php`: Seeds posts into MongoDB
- `routes/api.php`: API route definitions

## Troubleshooting

### `php artisan db:seed` fails

Check the following:

- Your Hugging Face API key is valid.
- Your Hugging Face endpoint URL is correct.
- Your MongoDB connection string and database name are valid.
- Your embedding endpoint returns a single numeric vector in the format expected by the app.

### Recommendation requests fail with a vector search error

Usually this means one of the following:

- The `vector_index` index does not exist.
- The index dimensions do not match your embedding size.
- Your MongoDB deployment does not support `$vectorSearch`.

### Migrations fail locally

Make sure `database/database.sqlite` exists and that `.env` still points `DB_CONNECTION` to `sqlite`.

## Contributing

Issues and pull requests are welcome. If you improve the setup, documentation, or recommendation flow, contributions are open.

## License

This project is open source software licensed under the MIT License.
