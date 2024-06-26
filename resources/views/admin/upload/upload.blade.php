@extends('admin/layouts/app')

@section('title', 'Editar cadeira')

@section('content')
<div class="relative flex flex-col items-center justify-center selection:bg-[#4A89DC] selection:text-white">
    <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">

        <main class="mt-6">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
                
                <div class="flex justify-between">
                    <h4 class="justify-start mt-2 mr-2 mb-2 ml-2 text-xl italic text-neutral-500 dark:text-neutral-400"><i class="fas fa-upload"></i> Uploads</h4>

                    <a href="{{ back() }}" type="button" class="mt-2 mr-2 mb-2 ml-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        Voltar
                    </a>
                </div>
    
                <div class="mt-2 mr-2 mb-2 ml-2">
                    <form action="{{ route('upload.store', $asset->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <input type="hidden" name="reference_id" value="">
                        <input type="hidden" name="upload_type" value="">
                        
                        <input type="file" name="file" placeholder="Selecione um ou mais arquivos">
                        
                        @if ( isset($errors) )
                            <div class="w-full items-center rounded-lg bg-info-100 px-6 py-5 text-base text-info-800 dark:bg-[#11242a] dark:text-info-500">
                                {{session('message')}}
                            </div>
                        @endif
                        
                    </form>
                </div>
            </div>
           
        </main>
    </div>
</div>
@endsection