@extends('admin.layouts.app')

@section('title', 'Editar usuário')

@section('content')
<div class="relative flex flex-col items-center justify-center selection:bg-[#4A89DC] selection:text-white">
    <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">

        <main class="mt-6">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
                
                <div class="flex justify-between">
                    <h4 class="justify-start mt-2 mr-2 mb-2 ml-2 text-xl italic text-neutral-500 dark:text-neutral-400"><i class="fas fa-users"></i> Editar usuário</h4>

                    <a href="{{ url('admin/users') }}" type="button" class="mt-2 mr-2 mb-2 ml-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        Voltar
                    </a>
                </div>
    
                <div class="mt-2 mr-2 mb-2 ml-2">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('put')
                        
                        <div>
                            <x-input-label for="name" :value="__('NOME *')" /> 
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$user->name}}" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        
             
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('E-MAIL *')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$user->email}}" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        
                        <div class="grid grid-cols-2 gap-2">  
                            <div class="mt-4">
                                @php
                                    if( $user->user_type == 1 )$type = 'ADMINISTRADOR';
                                    if( $user->user_type == 2 )$type = 'SECRETÁRIA';
                                    if( $user->user_type == 3 )$type = 'CLIENTE';
                                @endphp
                                <x-input-label for="user_type" :value="__('TIPO DO USUÁRIO *')" /> 
                                <x-text-input id="user_type" readonly class="block mt-1 w-full bg-white-900 even:bg-gray-50" name="user_type" value="{{$type}}" />
                                <x-input-error :messages="$errors->get('user_type')" class="mt-2" />
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-2">                        
                            <div class="mt-4">
                                <x-input-label for="cellphone" :value="__('CELULAR')" />
                                <x-text-input id="cellphone" class="block mt-1 w-full" name="cellphone" value="{{$user->cellphone}}" />
                                <x-input-error :messages="$errors->get('Celular')" class="mt-2" />
                            </div>
                            
                                                    
                            <div class="mt-4">
                                <x-input-label for="telephone" :value="__('TELEFONE')" />
                                <x-text-input id="telephone" class="block mt-1 w-full" name="telephone" value="{{$user->telephone}}" />
                                <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                            </div>
                        </div>                    
                        
                        <div class="grid grid-cols-2 gap-2">  
                            <div class="mt-4">
                                <x-input-label for="personal_id_primary" :value="__('CPF')" />
                                <x-text-input id="personal_id_primary" class="block mt-1 w-full" name="personal_id_primary" value="{{$user->personal_id_primary}}" />
                                <x-input-error :messages="$errors->get('personal_id_primary')" class="mt-2" />
                            </div>
                                                    
                            <div class="mt-4">
                                <x-input-label for="personal_id_secundary" :value="__('RG / PASSAPORTE')" />
                                <x-text-input id="personal_id_secundary" class="block mt-1 w-full" name="personal_id_secundary" value="{{$user->personal_id_secundary}}" />
                                <x-input-error :messages="$errors->get('personal_id_secundary')" class="mt-2" />
                            </div>
                        </div>
                                                
                        <div class="grid grid-cols-2 gap-2">  
                            <div class="mt-4">
                                <x-input-label for="driver_id" :value="__('CARTEIRA DE MOTORISTA')" />
                                <x-text-input id="driver_id" class="block mt-1 w-full" name="driver_id" value="{{$user->driver_id}}" />
                                <x-input-error :messages="$errors->get('driver_id')" class="mt-2" />
                            </div>
                        </div>
                        
                        @if ( session()->has('message') )
                            <div class="w-full items-center rounded-lg bg-info-100 px-6 py-5 text-base text-info-800 dark:bg-[#11242a] dark:text-info-500">
                                {{session('message')}}
                            </div>
                        @endif
                        
                        <div class="flex w-full">
                            <div class="flex items-center justify-start mt-4 mb-4 mr-4">
                                <x-primary-button class="">
                                    {{ __('Salvar') }}
                                </x-primary-button>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
            
            <br>
            
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white mt-4">
                <div class="flex justify-between">
                    <h4 class="justify-start mt-2 mr-2 mb-2 ml-2 text-xl italic text-neutral-500 dark:text-neutral-400"><i class="fas fa-map-marker-alt"></i> Contrato</h4>
                    
                    <form action="{{ route('upload.store', $user->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="reference_id" value="{{$user->id}}">
                    <input type="hidden" name="upload_type" value="6">
                    <button class="mt-2 mr-2 mb-2 ml-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        Incluir Contrato
                    </button>
                    </form>
                </div>
                
                <table whidth="100%" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-4">Data cadastro</th>
                            <th>Usuário</th>
                            <th>Arquivo</th>
                            <th>Alocado até</th>
                            <th>Aprovado?</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @forelse ($contracts as $contract)
                            <tr class="odd:bg-white text-center odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4">{{$contract->created_at}}</td>
                                <td class="px-6 py-4">{{$contract->uploads->user->name}}</td>
                                <td class="px-6 py-4">{{$contract->filename}}</td>
                                <td class="px-6 py-4">{{$contract->complement->allocated_at}}</td>
                                <td class="px-6 py-4">{{$contract->status.'<br>'.$contract->complement->user->name}}</td>
                            </tr>
                        @empty --}}
                            <tr><td class="px-6" colspan="100"> Nenhum contrato!</td></tr>
                        {{-- @endforelse --}}
                    </tbody>
                </table>
            </div>
            
            <br>
            
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white mt-4">
                <div class="flex justify-between">
                    <h4 class="justify-start mt-2 mr-2 mb-2 ml-2 text-xl italic text-neutral-500 dark:text-neutral-400"><i class="fas fa-map-marker-alt"></i> Endereço</h4>
                
                    <a href="#" type="button" class="mt-2 mr-2 mb-2 ml-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        Incluir endereço
                    </a>
                </div>
                
                <table whidth="100%" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-4">Endereço</th>
                            <th>Número</th>
                            <th>CEP</th>
                            <th>Cidade - UF</th>
                            <th>Complemento</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @forelse ($addresses as $address)
                            <tr class="odd:bg-white text-center odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4">{{$address->address}}</td>
                                <td class="px-6 py-4">{{$address->address_number}}</td>
                                <td class="px-6 py-4">{{$address->cep}}</td>
                                <td class="px-6 py-4">{{$address->city . ' - ' . $address->state}}</td>
                                <td class="px-6 py-4">{{$address->complement . '<br>' . $address->observation}}</td>
                            </tr>
                        @empty --}}
                            <tr><td class="px-6" colspan="100"> Nenhuma endereço cadastrado!</td></tr>
                        {{-- @endforelse --}}
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
@endsection