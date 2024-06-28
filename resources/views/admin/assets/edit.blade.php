@extends('admin/layouts/app')

@section('title', 'Editar cadeira')

@section('content')
<div class="relative flex flex-col items-center justify-center selection:bg-[#4A89DC] selection:text-white">
    <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">

        <main class="mt-6">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
                
                <div class="flex justify-between">
                    <h4 class="justify-start mt-2 mr-2 mb-2 ml-2 text-xl italic text-neutral-500 dark:text-neutral-400"><i class="fas fa-wheelchair"></i> Editando cadeira</h4>

                    <a href="{{ url('admin/assets') }}" type="button" class="mt-2 mr-2 mb-2 ml-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        Voltar
                    </a>
                </div>
    
                <div class="mt-2 mr-2 mb-2 ml-2">
                    <form action="{{ route('assets.update', $asset->id) }}" method="POST">
                        @csrf
                        @method('put')
                        
                        <div>
                            <x-input-label for="name" :value="__('NOME *')" /> 
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$asset->name}}" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        
                        <div class="grid grid-cols-2 gap-2">  
                            <div class="mt-4">
                                <x-input-label for="asset_categorie" :value="__('CATEGORIA *')" /> 
                                <select id="asset_categorie" name="asset_categorie" placeholder="Selecione" required value="{{$asset->asset_categorie}}" class="block mt-1 w-full  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Selecione</option>
                                    @foreach($categories as $categorie)
                                        <option value="{{$categorie->id}}" {{ ($asset->asset_categorie == $categorie->id) ? 'selected' :''}}>{{$categorie->name}} - {{$categorie->id}}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('asset_categorie')" class="mt-2" />
                            </div>
                        
                        
                            <div class="grid grid-cols-2 gap-2 grid-password">  
                                <div class="mt-4">
                                    <x-input-label for="asset_type" :value="__('TIPO *')" /> 
                                    <select id="asset_type" name="asset_type" placeholder="Selecione" required value="{{$asset->asset_type}}" class="block mt-1 w-full  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">Selecione</option>
                                        @foreach($types as $type)
                                            <option value="{{$type->id}}" {{ ($asset->asset_type == $type->id) ? 'selected' :''}}>{{$type->name}} - {{$type->id}}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('asset_type')" class="mt-2" />
                                </div>
                                
                                <div class="mt-4">
                                    <x-input-label for="avaiable_at" :value="__('DISPONÍVEL NA DATA')" />
                                    <x-text-input id="avaiable_at" class="block mt-1 w-full" name="avaiable_at" value="{{$asset->avaiable_at}}" />
                                    <x-input-error :messages="$errors->get('avaiable_at')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-2">                        
                            <div class="mt-4">
                                <x-input-label for="tag" :value="__('TAG')" />
                                <x-text-input id="tag" class="block mt-1 w-full" name="tag" value="{{$asset->tag}}" />
                                <x-input-error :messages="$errors->get('tag')" class="mt-2" />
                            </div>
                            
                                                    
                            <div class="mt-4">
                                <x-input-label for="serial_number" :value="__('NÚMERO DE SÉRIE')" />
                                <x-text-input id="serial_number" class="block mt-1 w-full" name="serial_number" value="{{$asset->serial_number}}" />
                                <x-input-error :messages="$errors->get('serial_number')" class="mt-2" />
                            </div>
                        </div>                    
                        
                        <div class="grid grid-cols-2 gap-2">  
                            <div class="mt-4">
                                <x-input-label for="patrimonial_id" :value="__('NÚMERO PATRIMONIAL')" />
                                <x-text-input id="patrimonial_id" class="block mt-1 w-full" name="patrimonial_id" value="{{$asset->patrimonial_id}}" />
                                <x-input-error :messages="$errors->get('patrimonial_id')" class="mt-2" />
                            </div>
                                                    
                            <div class="mt-4">
                                
                            </div>
                        </div>
                                                
                        <div class="">  
                            <div class="mt-4">
                                <x-input-label for="observation" :value="__('OBSERVAÇÂO')" />
                                <textarea id="observation" name="observation" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Digite mais informações sobre o item...">{{$asset->observation}}</textarea>
                            </div>
                        </div>

                        
                        @if ( isset($errors) )
                            <div class="w-full items-center rounded-lg bg-info-100 px-6 py-2 text-base text-info-800 dark:bg-[#11242a] dark:text-info-500">
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
                    
                    <form action="{{ route('assets_contract.index', $asset->id) }}" method="GET">
                        @csrf
                        <input type="hidden" name="reference_id" value="{{$asset->id}}">
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
                            <th>Status / Avaliador</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            use Carbon\Carbon;
                        @endphp
                        
                        @forelse ($contracts as $contract)
                            <tr id="tr_delete{{$contract->id}}" class="odd:bg-white text-center odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4">{{$contract->created_at}}</td>
                                <td class="px-6 py-4">{{$contract->user_upload}}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ Storage::disk('s3')->temporaryUrl('assets/'.$contract->file_name_uploaded, Carbon::now()->addHours(24)) }}" class="">
                                        {{$contract->file_name}}
                                    </a>
                                </td>
                                <td class="px-6 py-4">{{$contract->allocated_at}}</td>
                                <td class="px-6 py-4">{{$contract->up_status}} <br> {{$contract->user_approved}}</td>
                                <td class="px-6 py-4">
                                    <a href="#" id="{{$contract->id}}" data-id="{{$contract->id}}" class="action_delete">
                                        Excluir
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td class="px-6" colspan="100"> Nenhum contrato!</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <br>
            
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white mt-4">
                <div class="flex justify-between">
                    <h4 class="justify-start mt-2 mr-2 mb-2 ml-2 text-xl italic text-neutral-500 dark:text-neutral-400"><i class="fas fa-camera"></i> Galeria de fotos</h4>
                
                    <a href="{{ url('admin/assets_galery', $asset->id) }}" type="button" class="mt-2 mr-2 mb-2 ml-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        Incluir foto
                    </a>
                </div>
                
                <table whidth="100%" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-4">Data</th>
                            <th>Usuario</th>
                            <th>Arquivo</th>
                            <th width="">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($photosGalery as $photo)
                            <tr id="tr_delete{{$photo->id}}" class="odd:bg-white text-center odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4">{{$photo->created_at}}</td>
                                <td class="px-6 py-4">{{$photo->user_upload}}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ Storage::disk('s3')->temporaryUrl('assets/'.$photo->file_name_uploaded, Carbon::now()->addHours(24)) }}" class="">
                                        {{$photo->file_name}}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="#" id="{{$photo->id}}" data-id="{{$photo->id}}" class="action_delete">
                                        Excluir
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td class="px-6" colspan="100"> Nenhuma foto cadastrada!</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.action_delete').forEach((action_delete) => {
            action_delete.addEventListener('click', () => {
                const id_element = action_delete.getAttribute('data-id');
                
                Swal.fire({title:'Aguarde...', showConfirmButton: false });
                
                axios.delete( `{{ url('admin/assets_contract/delete') }}/${id_element}` )
                .then((response) => {
                    Swal.close()
                    
                    if(response.data.status==true){
                        $(`#tr_delete${id_element}`).hide('slow');
                        // Swal.fire(response.data.message);
                    }else
                        Swal.fire(response.data.message);
                })
            });
        });
    </script>
@endpush