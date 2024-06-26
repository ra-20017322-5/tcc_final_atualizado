@extends('admin/layouts/app')

@section('title', 'Listagem de cadeiras')

@section('content')
<div class="relative flex flex-col items-center justify-center selection:bg-[#4A89DC] selection:text-white">
    <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">

        <main class="mt-6">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
                
                <div class="flex justify-between">
                    <h4 class="justify-start mt-2 mr-2 mb-2 ml-2 text-xl italic text-neutral-500 dark:text-neutral-400"><i class="fas fa-wheelchair"></i> Listagem de cadeiras</h4>

                    <a href="{{ route('assets.create') }}" type="button" class="mt-2 mr-2 mb-2 ml-2 justify-end text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Novo
                    </a>
                </div>
    
                
                <table whidth="100%" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-4">Nome</th>
                            <th>Tipo</th>
                            <th>Categoria</th>
                            <th width="120px">Disponível em</th>
                            <th width="">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($assets as $asset)
                            <tr class="odd:bg-white text-center odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4">{{$asset->name}}</td>
                                <td >
                                    @php
                                        if( $asset->asset_type == 1 )echo 'CADEIRA DE RODAS';
                                        if( $asset->asset_type == 2 )echo 'ANDADOR';
                                    @endphp
                                </td>
                                <td >
                                    @php
                                        if( $asset->asset_categorie == 1 )echo 'CADEIRA DE RODAS SIMPLES';
                                        if( $asset->asset_categorie == 2 )echo 'CADEIRA DE RODAS ELÉTRICA';
                                    @endphp
                                </td>

                                <td >{{$asset->avaiable_at}}</td>
                                <td >
                                    <a href="{{route('assets.delete', $asset->id)}}">Excluir</a> | 
                                    <a href="{{route('assets.edit', $asset->id)}}">Editar</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td class="px-6" colspan="100"> Nenhuma cadeira cadastrada!</td></tr>
                        @endforelse
                    </tbody>
                </table>
                
                {{ $assets->links() }}
            </div>
        </main>
    </div>
</div>
@endsection
