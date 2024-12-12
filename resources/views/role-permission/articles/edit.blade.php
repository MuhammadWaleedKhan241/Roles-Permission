<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Articles / Edit
            </h2>
            <a href="{{route('articles.index')}}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Add CSRF token for form protection --}}
                    <form action="{{ route('articles.update',$article->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="p-6">
                            {{-- Title Field --}}
                            <label for="title" class="text-lg font-medium">Title</label>
                            <div class="my-3">
                                <input placeholder="Enter title" name="title" type="text" id="title"
                                    value="{{ old('title',$article->title) }}" required
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg @error('title') border-red-500 @enderror">
                                @error('title')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Content Field --}}
                            <label for="text" class="text-lg font-medium">Content</label>
                            <div class="my-3">
                                <textarea name="text" id="text" cols="30" rows="10" placeholder="Enter content here"
                                    required
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg @error('text') border-red-500 @enderror">{{ old('text',$article->text) }}"</textarea>
                                @error('text')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Author Field --}}
                            <label for="author" class="text-lg font-medium">Author</label>
                            <div class="my-3">
                                <input placeholder="Author Name" name="author" type="text" id="author"
                                    value="{{ old('author',$article->text)}}" required
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg @error('author') border-red-500 @enderror">
                                @error('author')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Submit Button --}}
                            <button type="submit"
                                class="bg-slate-700 text-sm rounded-md text-white px-5 py-3 hover:bg-slate-800">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>