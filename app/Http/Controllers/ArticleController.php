<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('articles.index', [
            'articles' => Article::orderBy('published_at', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'img_url' => 'nullable|url|max:255',
            'body' => 'required|string',
            'published_at' => 'nullable|date',
        ]);

        // Create article
        $article = Article::create($validated);

        // Redirect to the newly created article
        return redirect()->route('articles.show', $article)
            ->with('success', 'Article created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('articles.show', [
            'article' => $article,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        // Pass the article to the edit view
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        // Validate input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'img_url' => 'nullable|url|max:255',
            'body' => 'required|string',
            'published_at' => 'nullable|date',
        ]);

        // Update article with validated data
        $article->update($validated);

        // Redirect back to the article page with success message
        return redirect()->route('articles.show', $article)
            ->with('success', 'Article updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Article deleted successfully.');
    }
}
