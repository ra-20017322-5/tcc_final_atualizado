@extends('admin/layouts/app')

@section('title', 'Uploads')

@section('content')
<div class="relative flex flex-col items-center justify-center selection:bg-[#4A89DC] selection:text-white">
    <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">

        <main class="mt-6">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
                
                <div class="flex justify-between">
                    <h4 class="justify-start mt-2 mr-2 mb-2 ml-2 text-xl italic text-neutral-500 dark:text-neutral-400"><i class="fas fa-upload"></i> Upload de fotos</h4>

                    <a href="{{url('admin/assets/edit',$reference_id)}}" type="button" class="mt-2 mr-2 mb-2 ml-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        Voltar
                    </a>
                </div>
    
                <div class="mt-2 mr-2 mb-2 ml-2">
                    <form action="{{ route('assets_galery.store', $reference_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <input type="hidden" name="reference_id" value="{{$reference_id}}">
                        <input type="hidden" name="upload_type" value="9">
                        
                        <input type="file" id="file" class="mb-2 file" name="file" placeholder="Selecione um arquivo">

                        @if ( isset($error) )
                            <div class="return_message w-full items-center rounded-lg bg-info-100 px-6 py-5 text-base text-info-800 dark:bg-[#11242a] dark:text-info-500" style="background-color: rgb(251, 243, 203)">
                                {{$return_error}}
                            </div>
                        @endif
                        
                        @if ( isset($return_success) )
                            <div class="return_message w-full items-center rounded-lg bg-info-100 px-6 py-5 text-base text-info-800 dark:bg-[#11242a] dark:text-info-500" style="background-color: rgb(203, 239, 251)">
                                {{$return_success}}
                            </div>
                        @endif
                        
                        <div class="flex w-full mt-2">
                            <div class="flex items-center justify-start mb-4 mr-4">
                                <x-primary-button class="">
                                    {{ __('Enviar') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>

                <br>
                
                <div class="mt-2 mr-2 mb-2 ml-2">
                    <table whidth="100%" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-4">Data</th>
                                <th>Usuário</th>
                                <th>Arquivo</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                use Carbon\Carbon;
                            @endphp
                            
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
            </div>
        </main>
        
        <br>
        
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