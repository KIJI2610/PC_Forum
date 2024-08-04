<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Section;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function topics($section_id)
    {
        $section = Section::find($section_id);
/*
    Темы из секции отсортированы так, чтобы первыми были те, в которых последнее сообщение создано позже.
    select * from topics
    where section_id = $section_id
    order by (
    select created_at
    from posts
    where posts.topic_id = topics.id
    order by created_at desc
    limit 1
    ) desc
*/
        $topics = Topic::where('section_id', $section_id)->orderByDesc(Post::select('created_at')
            ->whereColumn('posts.topic_id', '=', 'topics.id')
            ->latest()
            ->take(1)
        )->paginate(3);

        return view('topic.show', compact('section', 'topics'));
    }

    public function create($sectionId)
    {
        $section = Section::find($sectionId);
        return view('topic.create', compact('section'));
    }

    public function store(Request $request, $sectionId)
    {
        $request->validate([
            'topic_name' => 'required|min:3',
            'post_content' => 'required|min:3',
        ]);
        $topic = new Topic([
            'name' => request('topic_name'),
            'section_id' => $sectionId,
            'user_id' => Auth::id(),
        ]);
        $topic->save();
        $post = new Post([
            'content' => request('post_content'),
            'user_id' => Auth::id(),
        ]);
        //записываем пост в БД, используя метод отношения save, таким образом в таблицу post автоматически запишется topic_id
        $topic->posts()->save($post);
        $section = Section::find($sectionId);
        $topics = Topic::where('section_id', $sectionId)->paginate(2);
        return redirect()->route('topics', [
            'sectionId' => $sectionId,
            'section' => $section,
            'topics' => $topics,
        ])->with('success', 'Тема создана!');
    }

    public function edit($topicId)
    {
        return view('topic.edit', [
            'topic' => Topic::find($topicId),
        ]);
    }

    public function storeEdit(Request $request, $topicId)
    {
        $request->validate([
            'topic_name' => 'required|min:3',
        ]);
        $topic = Topic::find($topicId);
        $topic->name = request('topic_name');
        $topic->save();
        return redirect()->route('topics', [
            'sectionId' => $topic->section_id
        ])
            ->with('success', 'Тема изменена!');
    }

    public function softDel($topicId)
    {
        $sectionId = Topic::find($topicId)->section_id;
        Topic::find($topicId)->posts()->delete();
        Topic::destroy($topicId);
        return redirect()->route('topics', [
            'sectionId' => $sectionId,
        ])->with('success', 'Тема и все сообщения этой темы удалены!');
    }
}
