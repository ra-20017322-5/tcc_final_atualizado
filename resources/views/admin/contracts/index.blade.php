@extends('admin.layouts.app')

@section('title', 'Listagem de Contratos')

@section('content')
<div class="relative flex flex-col items-center justify-center selection:bg-[#4A89DC] selection:text-white">
    <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">

        <main class="mt-6">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
                
                <div class="flex justify-between">
                    <h4 class="justify-start mt-2 mr-2 mb-2 ml-2 text-xl italic text-neutral-500 dark:text-neutral-400"><i class="fas fa-file-contract"></i> Listagem de Contratos</h4>
                </div>
                
              
                <table whidth="100%" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-4">Data cadastro</th>
                            <th>Usuário</th>
                            <th>Arquivo</th>
                            <th>Alocado até</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contracts as $contract)
                            <tr class="odd:bg-white text-center odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4">{{$contract->created_at}}</td>
                                <td class="px-6 py-4">{{$contract->user_upload}}</td>
                                <td class="px-6 py-4">
                                    @if (env('APP_ENV')!='Production')
                                        <a href="#"  class="">
                                    @else
                                        <a href="{{ Storage::disk('s3')->url('tcc-final/assets/'.$contract->file_name_uploaded) }}">
                                    @endif
                                        {{$contract->file_name}}
                                    </a>
                                </td>
                                <td class="px-6 py-4">{{$contract->allocated_at}}</td>
                            </tr>
                        @empty
                            <tr><td class="px-6" colspan="100"> Nenhum contrato!</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
@endsection