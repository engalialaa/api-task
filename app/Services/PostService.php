<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;

class PostService
{

    public function getPosts(int $limit): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {

        return User::query()
            ->select(
                'posts.id as postId',
                'users.id as userId',
                'users.name as userName',
                'posts.title',
                'posts.body',
                'posts.created_at'
            )
            ->where('posts.deleted_at' , null)
            ->where(function($where) {
             $where->where('posts.is_hide', 0)
               ->orWhere('posts.user_id', auth()->user()->id);
            })
            ->join('posts', 'users.id', 'posts.user_id')
            ->orderBy('posts.created_at', 'desc')
            ->paginate($limit);
    }

    public function getMyPosts()
    {

        return User::query()
            ->select(
                'posts.id as postId',
                'users.id as userId',
                'posts.title',
                'posts.body'
            )
            ->where('posts.deleted_at' , null)
            ->where('users.id', '=', auth()->user()->id)
            ->join('posts', 'users.id', 'posts.user_id')
            ->orderBy('posts.created_at', 'desc')
            ->get();
    }

    public function createPost(string $title, string $body, $userId)
    {
        return Post::create([
            'title' => $title,
            'body' => $body,
            'user_id' => $userId ?? auth()->user()->id
        ]);
    }

    public function updatePost(int $id,  string $title, string $body)
    {
        Post::find($id)->update([
            'title' => $title,
            'body' => $body,
        ]);
    }

    public function deletePost(int $id) :void
    {
        $post = Post::query()->find($id)->delete();
    }

    public function hidePost(int $id) :void
    {
        Post::find($id)->update([
            'is_hide' => 1,
        ]);
    }
}
