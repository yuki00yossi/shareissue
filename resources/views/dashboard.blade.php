<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-xl">Issue List</h3>
                    <div class="my-3 mb-5">
                        <a href="{{ route('issues.create') }}" class="bg-blue-400 hover:bg-blue-300 text-white rounded px-4 py-2 mb-3">{{ __('Add Issue') }}</a>
                    </div>
                    @forelse($issues as $issue)
                        <div>
                        <p class="my-3 text-blue-500 hover:text-blue-800"><a href="{{ route('departments.show', $issue->id) }}">{{ $issue->title }}</a></p>
                        </div>
                        
                        <hr>
                    @empty
                    <p>issueが登録されていません。</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
