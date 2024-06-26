@if (@session()->has('success'))
    <div class="">{{session('success')}}</div>
@endif

@if (@session()->has('warning'))
    <div class="">{{session('warning')}}</div>
@endif

@if (@session()->has('error'))
    <div class="">{{session('error')}}</div>
@endif

@if (@session()->has('message'))
    <div class="">{{session('message')}}</div>
@endif


@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li class="text-red-500">{{ $error }}</li>
        @endforeach
    </ul>
@endif

