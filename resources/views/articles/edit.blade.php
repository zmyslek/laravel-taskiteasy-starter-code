@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">

        <h1 class="text-2xl font-bold mb-6">Edit Article</h1>

        <form action="{{ route('articles.update', $article->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block font-semibold mb-1">Title</label>
                <input type="text" name="title" id="title"
                       value="{{ old('title', $article->title) }}"
                       class="w-full border rounded px-3 py-2 @error('title') border-red-500 @enderror" required>
                @error('title')
                <p class="text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Excerpt / Subtitle -->
            <div class="mb-4">
                <label for="excerpt" class="block font-semibold mb-1">Excerpt</label>
                <textarea name="excerpt" id="excerpt" rows="3"
                          class="w-full border rounded px-3 py-2 @error('excerpt') border-red-500 @enderror" required>{{ old('excerpt', $article->excerpt) }}</textarea>
                @error('excerpt')
                <p class="text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image URL -->
            <div class="mb-4">
                <label for="img_url" class="block font-semibold mb-1">Image URL</label>
                <input type="text" name="img_url" id="img_url"
                       value="{{ old('img_url', $article->img_url) }}"
                       class="w-full border rounded px-3 py-2 @error('img_url') border-red-500 @enderror">
                @error('img_url')
                <p class="text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Body -->
            <div class="mb-6">
                <label for="body" class="block font-semibold mb-1">Body</label>
                <textarea name="body" id="body" rows="8"
                          class="w-full border rounded px-3 py-2 @error('body') border-red-500 @enderror" required>{{ old('body', $article->body) }}</textarea>
                @error('body')
                <p class="text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-3">
                <button type="submit"
                        class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    Update
                </button>

                <a href="{{ route('articles.show', $article->id) }}"
                   class="px-6 py-2 bg-gray-300 rounded hover:bg-gray-400">
                    Cancel
                </a>
            </div>

        </form>
    </div>
@endsection
