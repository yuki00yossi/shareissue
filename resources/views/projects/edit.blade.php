<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Project Name') }}
        </h2>
    </x-slot>
    <x-form-card>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('projects.update', $project->id) }}">
            @method('PUT')
            @csrf
            <!-- Name -->
            <div>
                <x-label for="name" :value="__('name')" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $project->name }}" required autofocus />
            </div>
            <div class="mt-3">
                <x-button>
                    {{ __('Edit') }}
                </x-button>
            </div>
        </form>
    </x-form-card>
</x-app-layout>
