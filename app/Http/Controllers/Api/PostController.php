<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Services\PostService;

class PostController extends Controller
{
    public function __construct(
        private readonly PostService $postService
    ) {
    }


    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $limit = $request->limit ?? 10;
        $posts = $this->postService->getPosts($limit);
        return response()->json(['posts' => PostResource::collection($posts->items()) , 'totalCount' =>$posts->total()]);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $post = $this->postService->createPost($request->title, $request->body ,$request->userId, );

        return response()->json(['message' => 'Created successfully'] , 200);
    }

    public function update(int $id, Request $request): \Illuminate\Http\JsonResponse
    {

        $this->postService->updatePost($id, $request->title, $request->body);

        return response()->json(['message' => 'Updated successfully'], 200);
    }

    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {

        $this->postService->deletePost($id);

        return response()->json(['message' => 'Deleted successfully'], 200);
    }

    public function hidePost(int $id): \Illuminate\Http\JsonResponse
    {

        $this->postService->hidePost($id);

        return response()->json(['message' => 'Post successfully hide'], 200);
    }
}
