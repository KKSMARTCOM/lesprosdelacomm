<!-- app-Header -->
<div class="">
    <div class="container mx-auto max-h-10 py-2 flex justify-end">
        <div class="flex items-center gap-4">
            <div>
                <form method="POST" action="{{ route('set.locale') }}">
                    @csrf
                    <select onchange="this.form.submit()"
                        class="border-gray-200 bg-[#ffff] border-1 py-1 px-1 outline-none" name="locale" id="">
                        <option value="fr" {{ app()->getLocale() === 'fr' ? 'selected' : '' }}>🇫🇷 FRA</option>
                        <option value="en" {{ app()->getLocale() === 'en' ? 'selected' : '' }}>🇬🇧 ENG</option>
                    </select>
                </form>
            </div>
            <div class="w-[8rem] relative md:w-full">
                <form method="POST" action="{{ route('view.search.store') }}">
                    @csrf
                    @method('GET')
                    <input value="{{ old('query') }}" name="query"
                        class="rounded-[15px] border-gray-200 border-1 py-1 px-4 outline-none w-full" type="text"
                        placeholder="@lang('static.rechercher')...">
                    <button onclick="this.form.submit()"
                        class="absolute z-30 inset-y-0 right-0 flex items-center pr-2 cursor-pointer">
                        <span class="fa fa-search text-2xl text-black"></span>
                    </button>
                </form>
            </div>
            <div class="flex items-center gap-4">
                <a target="_blank" href="https://web.facebook.com/lesprosdelacommdubenin" class="hover:text-[#098752]">
                    <span class="text-[1.25rem] fa fa-facebook"></span>
                </a>

                <a target="_blank" href="https://linkedin.com/company/lesprosdelacommdubenin"
                    class="hover:text-[#098752]">
                    <span class="text-[1.25rem] fa fa-linkedin"></span>
                </a>
            </div>
        </div>
    </div>

    <div class="bg-transparent absolute top-10 left-0 right-0 z-[100]" id="navbar">
        <div class="container mx-auto flex justify-between items-center">
            <a class="inline-block w-[6rem] h-[6rem] my-[-10px] overflow-hidden" href="#">
                <img src="{{ asset('assets/images/brand/logo1.png') }}" class="w-full h-full object-cover"
                    alt="logo">
            </a>
            <!-- LOGO -->
            <ul class="navbar-menu items-center gap-[1.5rem]">
                <li>
                    <a class="text-[1rem] text-[#FFFFFF] hover:text-[#098752] {{ Request::is('/') ? 'active-menu' : '' }}"
                        href="{{ route('view.home') }}">@lang('static.accueil')</a>
                </li>
                <li>
                    <a class="text-[1rem] text-[#FFFFFF] hover:text-[#098752] {{ Request::is('office') ? 'active-menu' : '' }}"
                        href="{{ route('view.office') }}">@lang('static.bureau')</a>
                </li>
                <li>
                    <a class="text-[1rem] text-[#FFFFFF] hover:text-[#098752] {{ Request::is('about') ? 'active-menu' : '' }}"
                        href="{{ route('view.about') }}">@lang('static.association')</a>
                </li>
                <li>
                    <a class="text-[1rem] text-[#FFFFFF] hover:text-[#098752] {{ Request::is('jobs*') || Request::is('job*') ? 'active-menu' : '' }}"
                        href="{{ route('view.jobs') }}">@lang('static.carriere')</a>
                </li>
                <li>
                    <a class="text-[1rem] text-[#FFFFFF] hover:text-[#098752] {{ Request::is('posts*') || Request::is('post*') || Request::is('search*') ? 'active-menu' : '' }}"
                        href="{{ route('view.posts') }}">@lang('static.actualites')</a>
                </li>
                <li>
                    <a class="text-[1rem] text-[#FFFFFF] hover:text-[#098752] {{ Request::is('contacts') ? 'active-menu' : '' }}"
                        href="{{ route('view.contacts') }}">@lang('static.contacts')</a>
                </li>
            </ul>
            {{-- MENU --}}
            <div class="flex items-center gap-4">
                <a href="{{ route('view.about') }}#membership"
                    class="px-[1.5rem] py-[.8rem] membership-button bg-[#FFFFFF] hover:bg-[#098752] hover:text-[#ffff] transition-all ease-in-out duration-300 rounded-md font-bold joign-button">@lang('static.rejoignez')</a>
                {{-- TOGGLE NAVBAR --}}
                <a href="javascript:void();" id="openSidebar" class="toggle-sidebar hover:text-[#ffffff]">
                    <i class="fa fa-bars text-[#ffffff] font-bold text-2xl"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- MOBILE SIDEBAR --}}
    <div
        class="fixed top-0 left-0 w-full h-screen z-[9999] sidebar-container hidden transition duration-300 ease-in-out">
        <div class="w-full h-full bg-black opacity-50 sidebar-overlay"></div>
        <div class="absolute top-0 right-0 w-[250px] md:w-[300px] h-full bg-white p-[2rem]">
            <div class="flex flex-col gap-[1rem]">
                <div class="flex justify-end">
                    <a href="javascript:void();" id="closeSidebar" class="hover:text-[#000000]">
                        <i class="fa fa-close text-2xl font-bold"></i>
                    </a>
                </div>

                <div class="w-[10rem] h-[10rem] overflow-hidden">
                    <img src="{{ asset('assets/images/brand/logo3.png') }}"
                        class="w-full h-full object-cover -ml-[2rem] -mt-[2rem]" alt="">
                </div>

                <ul class="flex flex-col gap-[1.5rem] -mt-[3rem]">
                    <li>
                        <a class="text-[1rem] text-[#000000] hover:text-[#098752] {{ Request::is('/') ? 'active-menu' : '' }}"
                            href="{{ route('view.home') }}">@lang('static.accueil')</a>
                    </li>
                    <li>
                        <a class="text-[1rem] text-[#000000] hover:text-[#098752] {{ Request::is('office') ? 'active-menu' : '' }}"
                            href="{{ route('view.office') }}">@lang('static.bureau')</a>
                    </li>
                    <li>
                        <a class="text-[1rem] text-[#000000] hover:text-[#098752] {{ Request::is('about') ? 'active-menu' : '' }}"
                            href="{{ route('view.about') }}">@lang('static.association')</a>
                    </li>
                    <li>
                        <a class="text-[1rem] text-[#000000] hover:text-[#098752] {{ Request::is('jobs') || Request::is('job') ? 'active-menu' : '' }}"
                            href="{{ route('view.jobs') }}">@lang('static.carriere')</a>
                    </li>
                    <li>
                        <a class="text-[1rem] text-[#000000] hover:text-[#098752] {{ Request::is('posts') || Request::is('post') ? 'active-menu' : '' }}"
                            href="{{ route('view.posts') }}">@lang('static.actualites')</a>
                    </li>
                    <li>
                        <a class="text-[1rem] text-[#000000] hover:text-[#098752] {{ Request::is('contacts') ? 'active-menu' : '' }}"
                            href="{{ route('view.contacts') }}">@lang('static.contacts')</a>
                    </li>
                </ul>

                <div class="flex sm:hidden justify-center">
                    <a href="{{ route('view.about') }}#membership"
                        class="px-[1.5rem] py-[.8rem] bg-[#000000] text-[#ffffff] hover:bg-[#098752] hover:text-[#ffff] transition-all ease-in-out duration-300 rounded-md font-bold">@lang('static.rejoignez')</a>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /app-Header -->
