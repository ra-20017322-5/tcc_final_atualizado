@extends('admin/layouts/app')

@section('title', 'Incluir usuário')

@section('content')
<div class="relative flex flex-col items-center justify-center selection:bg-[#4A89DC] selection:text-white">
    <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">

        <main class="mt-6">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
                
                <div class="flex justify-between">
                    <h4 class="justify-start mt-2 mr-2 mb-2 ml-2 text-xl italic text-neutral-500 dark:text-neutral-400">Incluir usuário</h4>

                    <a href="{{ url('admin/users') }}" type="button" class="mt-2 mr-2 mb-2 ml-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        Voltar
                    </a>
                </div>
    
                <div class="mt-2 mr-2 mb-2 ml-2">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        
                        <div>
                            <x-input-label for="name" :value="__('NOME *')" /> 
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$user->name ?? old('name')}}" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('E-MAIL *')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$user->email ?? old('email')}}" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        
                        <div class="grid grid-cols-2 gap-2">  
                            <div class="mt-4">
                                <x-input-label for="user_type" :value="__('TIPO DO USUÁRIO *')" /> 
                                {{-- <x-text-input id="user_type" class="block mt-1 w-full" type="text" name="user_type" value="{{$user->user_type ?? old('user_type')}}" required autofocus /> --}}
                                <select id="user_type" name="user_type" placeholder="Selecione" isRequired value="{{$user->user_type ?? old('user_type')}}" class="block mt-1 w-full  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="0">Selecione</option>
                                    @can('is_Admin')
                                    <option value="1">ADMINISTRADOR</option>
                                    @endcan
                                    <option value="2">SECRETÁRIA</option>
                                    <option value="3">CLIENTE</option>
                                </select>
                                <x-input-error :messages="$errors->get('user_type')" class="mt-2" />
                                
                            </div>
                        
                        
                            <div class="grid grid-cols-2 gap-2 grid-password">  
                                <!-- Password -->
                                <div class="mt-4">
                                    <x-input-label for="password" :value="__('Senha')" />
                                
                                    <x-text-input id="password" class="block mt-1 w-full"
                                                    type="password"
                                                    name="password"
                                                    required autocomplete="new-password" />
                                
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                                
                                <!-- Confirm Password -->
                                <div class="mt-4">
                                    <x-input-label for="password_confirmation" :value="__('Confirme a Senha')" />
                                
                                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                                    type="password"
                                                    name="password_confirmation" required autocomplete="new-password" />
                                
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-2">                        
                            <div class="mt-4">
                                <x-input-label for="cellphone" :value="__('CELULAR')" />
                                <x-text-input id="cellphone" class="block mt-1 w-full" name="cellphone" value="{{$user->cellphone ?? old('cellphone')}}" />
                                <x-input-error :messages="$errors->get('cellphone')" class="mt-2" />
                            </div>
                            
                                                    
                            <div class="mt-4">
                                <x-input-label for="telephone" :value="__('TELEFONE')" />
                                <x-text-input id="telephone" class="block mt-1 w-full" name="telephone" value="{{$user->telephone ?? old('telephone')}}" />
                                <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                            </div>
                        </div>                    
                        
                        <div class="grid grid-cols-2 gap-2">  
                            <div class="mt-4">
                                <x-input-label for="personal_id_primary" :value="__('CPF')" />
                                <x-text-input id="personal_id_primary" class="block mt-1 w-full" name="personal_id_primary" value="{{$user->personal_id_primary ?? old('personal_id_primary')}}" />
                                <x-input-error :messages="$errors->get('personal_id_primary')" class="mt-2" />
                            </div>
                                                    
                            <div class="mt-4">
                                <x-input-label for="personal_id_secundary" :value="__('RG / PASSAPORTE')" />
                                <x-text-input id="personal_id_secundary" class="block mt-1 w-full" name="personal_id_secundary" value="{{$user->personal_id_secundary ?? old('personal_id_secundary')}}" />
                                <x-input-error :messages="$errors->get('personal_id_secundary')" class="mt-2" />
                            </div>
                        </div>
                                                
                        <div class="grid grid-cols-2 gap-2">  
                            <div class="mt-4">
                                <x-input-label for="driver_id" :value="__('CARTEIRA DE MOTORISTA')" />
                                <x-text-input id="driver_id" class="block mt-1 w-full" name="driver_id" value="{{$user->driver_id ?? old('driver_id')}}" />
                                <x-input-error :messages="$errors->get('driver_id')" class="mt-2" />
                            </div>
                        </div>
                        

                        
                        @if ( isset($errors) )
                            <div class="w-full items-center rounded-lg bg-info-100 px-6 py-5 text-base text-info-800 dark:bg-[#11242a] dark:text-info-500">
                                {{session('message')}}
                            </div>
                        @endif
                        
                        <div class="flex w-full">
                            <div class="flex items-center justify-start mt-4 mb-4 mr-4">
                                <x-primary-button class="">
                                    {{ __('Incluir') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection