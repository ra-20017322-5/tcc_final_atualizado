@extends('admin/layouts/app')

@section('title', 'Incluir cadeira')

@section('content')
<div class="relative flex flex-col items-center justify-center selection:bg-[#4A89DC] selection:text-white">
    <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">

        <main class="mt-6">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
                
                <div class="flex justify-between">
                    <h4 class="justify-start mt-2 mr-2 mb-2 ml-2 text-xl italic text-neutral-500 dark:text-neutral-400"><i class="fas fa-wheelchair"></i> Incluir cadeira</h4>

                    <a href="{{ url('admin/assets') }}" type="button" class="mt-2 mr-2 mb-2 ml-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        Voltar
                    </a>
                </div>
    
                <div class="mt-2 mr-2 mb-2 ml-2">
                    <form action="{{ route('assets.store') }}" method="POST">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('NOME *')" /> 
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{old('name')}}" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        
                        <div class="grid grid-cols-2 gap-2">  
                            <div class="mt-4">
                                <x-input-label for="asset_categorie" :value="__('CATEGORIA *')" /> 
                                <select id="asset_categorie" name="asset_categorie" placeholder="Selecione" required value="{{old('asset_categorie')}}" class="block mt-1 w-full  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Selecione</option>
                                    @foreach($categories as $categorie)
                                        <option value="{{$categorie->id}}">{{$categorie->name}} - {{$categorie->id}}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('asset_categorie')" class="mt-2" />
                            </div>
                        
                        
                            <div class="grid grid-cols-2 gap-2 grid-password">  
                                <div class="mt-4">
                                    <x-input-label for="asset_type" :value="__('TIPO *')" /> 
                                    <select id="asset_type" name="asset_type" placeholder="Selecione" required value="{{old('asset_type')}}" class="block mt-1 w-full  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">Selecione</option>
                                        @foreach($types as $type)
                                            <option value="{{$type->id}}">{{$type->name}} - {{$type->id}}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('asset_type')" class="mt-2" />
                                </div>
                                
                                <div class="mt-4">
                                    <x-input-label for="avaiable_at" :value="__('DISPONÍVEL NA DATA')" />
                                    <x-text-input id="avaiable_at" class="block mt-1 w-full" name="avaiable_at" value="{{old('avaiable_at')}}" />
                                    <x-input-error :messages="$errors->get('avaiable_at')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-2">                        
                            <div class="mt-4">
                                <x-input-label for="tag" :value="__('TAG')" />
                                <x-text-input id="tag" class="block mt-1 w-full" name="tag" value="{{old('tag')}}" />
                                <x-input-error :messages="$errors->get('tag')" class="mt-2" />
                            </div>
                            
                                                    
                            <div class="mt-4">
                                <x-input-label for="serial_number" :value="__('NÚMERO DE SÉRIE')" />
                                <x-text-input id="serial_number" class="block mt-1 w-full" name="serial_number" value="{{old('serial_number')}}" />
                                <x-input-error :messages="$errors->get('serial_number')" class="mt-2" />
                            </div>
                        </div>                    
                        
                        <div class="grid grid-cols-2 gap-2">  
                            <div class="mt-4">
                                <x-input-label for="patrimonial_id" :value="__('NÚMERO PATRIMONIAL')" />
                                <x-text-input id="patrimonial_id" class="block mt-1 w-full" name="patrimonial_id" value="{{old('patrimonial_id')}}" />
                                <x-input-error :messages="$errors->get('patrimonial_id')" class="mt-2" />
                            </div>
                                                    
                            <div class="mt-4">
                                
                            </div>
                        </div>
                                                
                        <div class="">  
                            <div class="mt-4">
                                <x-input-label for="observation" :value="__('OBSERVAÇÂO')" />
                                <textarea id="observation" name="observation" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Digite mais informações sobre o item...">{{old('observation')}}</textarea>
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