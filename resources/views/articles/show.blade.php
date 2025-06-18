<x-article>
    <x-slot name="image">{{ $article->img_url }}</x-slot>
    <x-slot name="title">{{ $article->title }}</x-slot>
    <x-slot name="subtitle">{{ $article->excerpt }}</x-slot>

    <article class="content">
        {!! $article->body !!}
    </article>

    <div class="mt-4 flex space-x-2">
        <!-- Edit Button -->
        <a href="{{ route('articles.edit', $article->id) }}"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Edit
        </a>

        <!-- Delete Button -->
        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                Delete
            </button>
        </form>
    </div>
</x-article>
