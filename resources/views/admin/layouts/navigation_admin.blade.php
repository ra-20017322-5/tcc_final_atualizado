<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700" style="background-color:rgb(215, 218, 227)">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @php 
                        $logo = route('dashboard')=='/' ? '../images/logo_unicesumar.svg' : '../../images/logo_unicesumar.svg';
                    @endphp
                    <a href="{{ route('dashboard') }}">
                        <img src="{{$logo}}" alt="ADM - Pagina inicial" height="40px" width="120px">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="space-x-8 sm:-my-px sm:ms-10 sm:flex items-center text-center">
                    <a href="{{ url('admin/users') }}">
                        <i class="fas fa-users"></i>
                        <br>
                        <b>Usuários</b>
                    </a>
                    
                    <a href="{{ url('admin/assets') }}">
                        <i class="fas fa-wheelchair"></i>
                        <br>
                        <b>Cadeiras</b><i class="fas fa-arrow-to-bottom"></i>
                    </a>
                    
                    <a href="{{ url('admin/contracts') }}">
                        <i class="fas fa-file-contract"></i>
                        <br>
                        <b>Contratos</b>
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div> {{ Auth::user()->name }} </div>
                            <svg class="w-2 h-2 ml-2 text-gray-100 dark:text-white" style="width: 14px; height:14px;" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1"></path>
                            </svg>
                        </button>
                    </x-slot>
                    
                    <!-- Menu ---->
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Meu perfil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Sair') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
