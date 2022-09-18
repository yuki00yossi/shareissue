<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        @if (session('added'))
            <div id="alertArea" class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                <div class="flex">
                    <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                    <div>
                        <p class="font-bold">
                            {{ session('added') }}
                            <span id="closeNoticeBtn" class="">
                                <svg style="display: inline" class="h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                            </svg>
                        </span>
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </x-slot>
    <form id="searchForm" style="display: none;" method="get" action="{{ route('dashboard') }}"></form>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-xl">Issue List</h3>
                    <div class="my-3 mb-6">
                        <a href="{{ route('issues.create') }}" class="bg-blue-400 hover:bg-blue-300 text-white rounded px-4 py-2 mb-3">{{ __('Add Issue') }}</a>
                    </div>
                    <p>検索条件で絞り込む</p>
                    <div class="grid grid-cols-12">
                        <div class="col-span-3">プロジェクト</div>
                    </div>
                    <form action="{{ route('dashboard') }}" method="GET">
                    <div class="grid grid-cols-12">   
                        <div class="col-span-3">
                            <select name="projectId" class="block appearance-none bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                <option value="0">--</option>
                                @forelse($projects as $project)
                                    @if(array_key_exists('projectId', $queries))
                                    {{-- プロジェクト検索時にオプションにselected属性を付与 --}}
                                        @if($project->id == $queries['projectId'])
                                        <option value="{{ $project->id }}" selected>{{ $project->name }}</option>
                                        @else
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                        @endif
                                    @else 
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endif
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="col-span-2">
                            <input type="submit" id="searchSubmit" onclick="searchSubmit" class="bg-blue-400 hover:bg-blue-300 text-white rounded px-4 py-2 mb-3" value="検索">
                        </div>
                    </div>
</form>
                    <div class="grid grid-cols-12 gap-4 p-3 border-b-2 border-indigo-500">
                        <div class="col-span-4">タイトル</div>
                        <div class="col-span-2">プロジェクト</div>
                        <div class="col-span-2">登録者</div>
                        <div class="col-span-2">期限</div>
                        <div class="col-span-2">ステータス</div>
                    </div>
                    @forelse($issues as $issue)
                        <div class="grid grid-cols-12 gap-4 p-3 border-b-2">
                            <div class="col-span-4 text-blue-500 hover:text-blue-800"><a href="{{ route('issues.show', $issue->id) }}">{{ $issue->title }}</a></div>
                            <div class="col-span-2">{{ $issue->projects->name }}</div>
                            <div class="col-span-2">{{ $issue->assign_user->name }}</div>
                            <div class="col-span-2">{{ $issue->timelimit }}</div>
                            <div class="col-span-2">{{ $status[$issue->status] }}</div>
                        </div>                       
                        <hr>
                    @empty
                    <p>issueが登録されていません。</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <script>
        const closeNoticeBtn = document.getElementById('closeNoticeBtn');
        if (closeNoticeBtn) {
            closeNoticeBtn.addEventListener('click', ()=> {
                document.getElementById('alertArea').style = 'display: none;';
            });
        }

        const searchSubmitBtn = document.getElementById('searchSubmit');
        searchSubmitBtn.addEventListener('click', ()=> {
            
        })
    </script>
</x-app-layout>
