@extends('admin.layouts.app')

@section('title', 'Alterar senha do usuário')

@section('content')
<div class="relative flex flex-col items-center justify-center selection:bg-[#4A89DC] selection:text-white">
    <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
        <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                                    
            <form method="POST" action="{{ route('users.resetPassword', $user->id) }}">
                @csrf
                @method('put')
                
                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Nova Senha')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
        
                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirmar Nova Senha')" />
        
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password" />
        
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
        
                <div class="flex items-center justify-end mt-4">
                    <a href="{{ url('admin/users') }}" type="button" class="mt-2 mr-2 mb-2 ml-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        Voltar
                    </a>
                    
                    <x-primary-button>
                        {{ __('Alterar Senha') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection