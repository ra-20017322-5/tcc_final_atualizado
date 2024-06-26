<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}">
                        <img src="../images/logo_unicesumar.svg" alt="ADM - Pagina inicial" height="40px" width="120px">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="space-x-8 sm:-my-px sm:ms-10 sm:flex items-center text-center">
                    <a href="{{ url('/') }}" >
                        <i class="fas fa-home"></i>
                        <br>
                        <b>Pagina Inicial</b>
                    </a>
                    
                    <a href="{{ url('cadeiraderodas') }}">
                        <i class="fas fa-wheelchair"></i>
                        <br>
                        <b>Cadeiras</b>
                    </a>
                    
                    <a href="{{ url('/') }}">
                        <i class="fab fa-whatsapp"></i>
                        <br>
                        <b>Contato</b>
                    </a>
                </div>
            </div>


            <!-- Login ---->
            @if (Route::has('login'))
                <nav class="-mx-3 flex flex-1 justify-end items-center">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#4A89DC] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                        <i class="fas fa-sign-in-alt"></i>
                            Painel
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#4A89DC] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            <i class="fas fa-sign-in-alt"></i>
                            Login
                        </a>
                    @endauth
                </nav>
            @endif
   
        </div>
    </div>

</nav>
