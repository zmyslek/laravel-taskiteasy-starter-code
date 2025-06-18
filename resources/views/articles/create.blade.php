<x-main>
    <div class="max-w-4xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Create New Article</h1>

        <form action="{{ route('articles.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                       placeholder="Enter title" required>
            </div>

            {{-- Excerpt --}}
            <div>
                <label for="excerpt" class="block text-sm font-medium text-gray-700">Excerpt</label>
                <textarea name="excerpt" id="excerpt" rows="3"
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                          placeholder="Write a short summary" required></textarea>
            </div>

            {{-- Image URL --}}
            <div>
                <label for="img_url" class="block text-sm font-medium text-gray-700">Image URL</label>
                <input type="url" name="img_url" id="img_url"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                       placeholder="https://example.com/image.jpg">
            </div>

            {{-- Body --}}
            <div>
                <label for="body" class="block text-sm font-medium text-gray-700">Body</label>
                <textarea name="body" id="body" rows="8"
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                          placeholder="Write the full content..." required></textarea>
            </div>

            {{-- Actions --}}
            <div class="flex gap-4 mt-6">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded shadow">
                    Save
                </button>
                <a href="{{ url()->previous() }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded shadow">
                    Cancel
                </a>
                <button type="reset"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded shadow">
                    Reset
                </button>
            </div>
        </form>
    </div>
</x-main>
