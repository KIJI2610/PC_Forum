<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function topics($topic_id)
    {
        $topic = Topic::find($topic_id);
        $posts = $topic->posts()->orderBy('created_at')->paginate(3);
        return view('post.show', compact('topic', 'posts'));
    }

    public function create($topic_id)
    {
        $topic = Topic::find($topic_id);
        return view('post.create', compact('topic'));
    }

    public function store(Request $request, $topicId)
    {
        $request->validate([
            'post_content' => 'required|min:3',
        ]);

        $post = new Post([
            'content' => request('post_content'),
            'user_id' => Auth::id(),
            'topic_id' => $topicId,
        ]);
        $post->save();
        return redirect()->route('posts', ['topicId' => $topicId])->with('success', 'Сообщение опубликовано!');
    }

    public function edit($postId)
    {
        $post = Post::find($postId);
        return view('post.edit', compact('post'));
    }

    public function storeEdit(Request $request, $postId)
    {
        $request->validate([
            'post_content' => 'required|min:3',
        ]);
        $post = Post::find($postId);
        $post->content = request('post_content');
        $post->save();
        return redirect()->route('posts', [
            'topicId' => $post->topic->id
        ])
            ->with('success', 'Сообщение изменено!');
    }

    public function softDel($postId)
    {
        $topicId = Post::find($postId)->topic_id;
        Post::destroy($postId);
        return redirect()->route('posts', [
            'topicId' => $topicId
        ])->with('success', 'Сообщение удалено!');
    }
}
