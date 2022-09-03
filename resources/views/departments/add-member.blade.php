<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Member for ' . $department[0]->name) }}
        </h2>
    </x-slot>
    <x-form-card>
        @if(session('alreadyStored'))
        <div class="font-medium text-red-600">
            {{ session('alreadyStored') }}
        </div>
        @endif
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('departments.storeMember', $department[0]->id) }}">
            @csrf
            <!-- Name -->
            <div>
                <x-label for="user" :value="__('name')" />
                <select name="user" class="block mt-1 w-full">
                    
                    @forelse ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @empty
                    <p>ユーザーがいません。</p>
                    @endforelse
                </select>
            </div>
            <div class="mt-3">
                <x-button>
                    {{ __('Add') }}
                </x-button>
            </div>
        </form>
    </x-form-card>
</x-app-layout>
