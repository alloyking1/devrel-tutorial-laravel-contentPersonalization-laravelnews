<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $content = [
            [
                'title' => 'Getting Started with Laravel APIs',
                'body' => "Laravel provides a clean and expressive way to build APIs. With built-in routing, controllers, and request handling, developers can quickly expose endpoints that return structured JSON responses. This makes Laravel a strong choice for building both small services and large-scale backend systems.\n\nIn this guide, we explore how to define API routes, structure controllers, and return consistent responses. We also touch on best practices such as separating business logic from controllers and organizing your API for long-term maintainability.",
            ],
            [
                'title' => 'Building REST APIs in Laravel',
                'body' => "REST APIs follow a resource-based architecture that relies on HTTP verbs such as GET, POST, PUT, and DELETE. Laravel makes it easy to implement RESTful APIs using resource controllers and route definitions that map cleanly to application logic.\n\nThis article walks through designing RESTful endpoints, structuring controllers, and returning proper status codes. It also highlights common pitfalls developers face when building APIs and how to avoid tightly coupled or inconsistent designs.",
            ],
            [
                'title' => 'Laravel API Authentication with Sanctum',
                'body' => "Authentication is a critical part of any API. Laravel Sanctum provides a lightweight solution for issuing API tokens and authenticating requests without the complexity of OAuth. It is especially useful for SPAs and mobile applications.\n\nIn this article, we walk through installing Sanctum, generating tokens, and protecting routes. We also explore how to manage token permissions and ensure secure communication between clients and your API.",
            ],
            [
                'title' => 'JWT Authentication in Laravel',
                'body' => "JSON Web Tokens (JWT) are widely used for stateless authentication in modern applications. They allow servers to verify requests without storing session data, making them ideal for distributed systems and APIs.\n\nThis guide explains how JWT works and how to implement it in Laravel. We cover token creation, validation, expiration handling, and how to integrate JWT into middleware for protecting API routes.",
            ],
            [
                'title' => 'Securing Laravel APIs with Middleware',
                'body' => "Middleware acts as a filter for incoming HTTP requests and is essential for securing APIs. In Laravel, middleware can be used to enforce authentication, validate input, and apply rate limiting.\n\nThis article demonstrates how to create custom middleware, register it, and apply it to routes. It also explains how middleware contributes to cleaner and more maintainable API architecture.",
            ],
            [
                'title' => 'Understanding API Rate Limiting in Laravel',
                'body' => "Rate limiting helps protect your API from abuse and ensures fair usage among clients. Laravel includes built-in support for throttling requests based on IP address or authenticated user.\n\nIn this guide, we explore how rate limiting works, how to configure limits, and how to customize responses when limits are exceeded. We also discuss strategies for balancing performance and user experience.",
            ],
            [
                'title' => 'Versioning Your Laravel APIs',
                'body' => "As your API evolves, maintaining backward compatibility becomes important. Versioning allows you to introduce changes without breaking existing clients that rely on older endpoints.\n\nThis article covers different versioning strategies such as URL versioning and header-based versioning. It also explains how to structure your Laravel application to support multiple API versions cleanly.",
            ],
            [
                'title' => 'Error Handling in Laravel APIs',
                'body' => "Consistent error handling improves the developer experience for anyone consuming your API. Laravel provides powerful exception handling tools that allow you to standardize error responses.\n\nIn this guide, we explore how to customize exception handling, return structured JSON errors, and ensure that your API communicates failures clearly and consistently.",
            ],
            [
                'title' => 'Optimizing Database Queries in Laravel',
                'body' => "Database performance is a key factor in application speed. Inefficient queries can quickly become bottlenecks as your application grows.\n\nThis article explores techniques such as eager loading, indexing, and query optimization. We also discuss how to identify slow queries and improve performance using Laravel's built-in tools.",
            ],
            [
                'title' => 'Caching Strategies for Laravel Applications',
                'body' => "Caching reduces the need to repeatedly compute expensive operations or query the database. Laravel provides a flexible caching system that supports multiple drivers including Redis and file-based storage.\n\nIn this article, we explore different caching strategies, when to cache data, and how to invalidate cache effectively. Proper caching can significantly improve application performance and scalability.",
            ],
            [
                'title' => 'Using Queues for Background Jobs in Laravel',
                'body' => "Queues allow you to defer time-consuming tasks such as sending emails or processing uploads. This helps keep your application responsive while handling heavy workloads in the background.\n\nThis guide explains how to dispatch jobs, configure queue workers, and monitor job execution. We also cover retry mechanisms and failure handling.",
            ],
            [
                'title' => 'Scaling Laravel Applications for High Traffic',
                'body' => "As your application grows, you need to handle increased traffic efficiently. Scaling involves optimizing both your application and infrastructure.\n\nThis article explores load balancing, database scaling, caching layers, and horizontal scaling techniques. It also highlights common challenges developers face when scaling Laravel applications.",
            ],
            [
                'title' => 'Introduction to MongoDB with Laravel',
                'body' => "MongoDB is a NoSQL database designed for flexibility and scalability. Unlike relational databases, it stores data in documents, making it suitable for dynamic data structures.\n\nIn this guide, we explore how to integrate MongoDB with Laravel, define models, and perform CRUD operations. We also discuss when to choose MongoDB over traditional databases.",
            ],
            [
                'title' => 'Using MongoDB for API Data Storage',
                'body' => "MongoDB is a strong choice for APIs that require flexible schemas and rapid iteration. Its document-based structure allows developers to store complex data without rigid constraints.\n\nThis article explains how to use MongoDB as the primary database for Laravel APIs, including schema design considerations and performance implications.",
            ],
            [
                'title' => 'Indexing Strategies in MongoDB',
                'body' => "Indexes play a crucial role in improving database performance. Without proper indexing, queries can become slow and inefficient.\n\nThis guide explains how MongoDB indexes work, how to create them, and how to design indexes that match your query patterns for optimal performance.",
            ],
            [
                'title' => 'Introduction to AI Embeddings',
                'body' => "AI embeddings transform text into numerical vectors that capture semantic meaning. These vectors allow systems to understand relationships between pieces of content beyond simple keyword matching.\n\nIn this article, we explain how embeddings are generated and why they are essential for building modern search and recommendation systems.",
            ],
            [
                'title' => 'How Vector Search Works in MongoDB',
                'body' => "Vector search enables applications to find similar content based on meaning rather than exact matches. MongoDB supports this through vector indexes and similarity search queries.\n\nThis guide explains how vector search works, how to configure indexes, and how to query for similar documents using embeddings.",
            ],
            [
                'title' => 'Building a Recommendation Engine with Embeddings',
                'body' => "Recommendation engines use embeddings to identify similar content and suggest it to users. This approach improves engagement by surfacing relevant information automatically.\n\nIn this article, we walk through generating embeddings, storing them, and performing similarity searches to build a simple recommendation system.",
            ],
            [
                'title' => 'Combining Keyword Search with Vector Search',
                'body' => "Keyword search is fast and precise, but it lacks semantic understanding. Vector search, on the other hand, captures meaning but may miss exact matches.\n\nThis article explores how to combine both approaches into a hybrid search system that delivers more accurate and relevant results.",
            ],
            [
                'title' => 'Real-Time Content Recommendations in Laravel',
                'body' => "Real-time recommendations enhance user engagement by surfacing relevant content instantly. This requires efficient querying and caching strategies.\n\nIn this guide, we explore how to generate recommendations on the fly, cache results, and optimize performance for real-time delivery in Laravel applications.",
            ],
        ];

        return fake()->randomElement($content);
    }

}




