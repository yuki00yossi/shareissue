<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Issue') }}
        </h2>
    </x-slot>
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('issues.store') }}">
            @csrf
            <!-- title -->
            <div class="mb-5">
                <x-label for="title" :value="__('タイトル')" />
                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('name')" required autofocus />
            </div>
            <!-- detail -->
            <div class="mb-5">
                <x-label for="detail" :value="__('詳細')" />
                <textarea id="detail" name="detail" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="10">{{ old('detail') }}</textarea>
            </div>
            <!-- 担当者 -->
            <div class="mb-5">
                <x-label for="responsible_user" :value="__('担当者')" />
                <select name="responsible_user" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value=null selected>--</option>
                    @foreach($users as $key=> $user)
                        <option value="{{ $key }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- ステータス -->
            <div class="mb-5">
                <x-label for="status" :value="__('ステータス')" />
                <select name="status" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @foreach($status as $key=> $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <!-- 期限 -->
            <div class="mb-5">
                <x-label for="timelimit" :value="__('期限')" />
                <x-input id="timelimit" class="block mt-1 w-full" type="datetime-local" name="timelimit" :value="old('timelimit')"/>
            </div>
            <!-- プロジェクト -->
            <div class="mb-5">
                <x-label for="project" :value="__('プロジェクト')" />
                <select name="project" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @forelse($projects as $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @empty
                        <option></option>
                    @endforelse
                </select>
            </div>
            <div class="mt-3">
                <x-button>
                    {{ __('Add') }}
                </x-button>
            </div>
        </form>
    </div>
</x-app-layout>