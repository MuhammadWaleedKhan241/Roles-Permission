<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Articles') }}
            </h2>
            <a href="{{route('articles.create')}}"
                class="bg-slate-700 text-sm rounded-md text-white px-3 py-3">Create</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message></x-message>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr class="border-b">
                                <th class="px-6 py-3 text-left" width="">#</th>
                                <th class="px-6 py-3 text-left">Name</th>
                                <th class="px-6 py-3 text-left">Author</th>
                                <th class="px-6 py-3 text-left" width="">Created</th>
                                <th class="px-6 py-3 text-center" width="">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse ($articles as $article)
                            <tr class="border-b">
                                <td class="px-6 py-3 text-left">{{ $article->id }}</td>

                                <td class="px-6 py-3 text-left">{{ $article->title }}</td>
                                <td class="px-6 py-3 text-left">{{ $article->author }}</td>
                                <td class="px-6 py-3 text-left">{{
                                    \carbon\carbon::parse($article->created_at)->format('d, M, Y') }}</td>
                                <td class="px-6 py-3 text-center">
                                    @can('edit articles')
                                    <a href="{{route('articles.edit',$article->id)}}"
                                        class="bg-yellow-400 text-sm rounded-md text-white px-3 py-3 hover:bg-yellow-600">Edit</a>
                                    @endcan
                                    <form action="{{ route('articles.delete', $article->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        @can('delete articles')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this Article?')"
                                            class="bg-red-700 text-sm rounded-md text-white px-3 py-3 hover:bg-red-600">
                                            Delete
                                        </button>
                                        @endcan
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-3 text-center">No permissions found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="my-3"> {{$articles->links()}} </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>