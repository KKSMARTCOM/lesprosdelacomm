<!doctype html>
<html lang="en" dir="ltr">

<head>
    <!-- META DATA FACEBOOK -->
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Accueil | Les pros de la Comm du Bénin" />
    <meta property="og:description" content="Bonjour ! Je vous invite à visiter le site" />
    <meta property="og:image" content="{{ asset('assets/images/brand/logo1.png') }}" />

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Le site officiel de la présentation de l'association Les pros de la comm du Bénin">
    <meta name="author" content="KKSMARTCOM">
    <meta name="keywords"
        content="association,les pros,association les pros,les pros comm,les pros de la comm du bénin,bénin,comm.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.inc.style')

</head>

<body class="bg-white h-full overflow-x-hidden">

    <!-- PAGE -->
    <div class="">
        <div class="">

            @include('layouts.inc.header')

            <!--app-content open-->
            <div class="">
                <div class="">
                    @yield('content')
                </div>
            </div>
            <!--app-content closed-->

            <div class="fixed top-1/2 -translate-y-1/2 left-0 w-[2rem] z-[9999]">
                <div class="relative">
                    <div id="share"
                        class="cursor-pointer w-full h-[2rem] bg-[#098752] flex justify-center items-center">
                        <span class="fa fa-share-alt text-[1rem] text-[#ffff]"></span>
                    </div>
                    <div
                        class="flex flex-col gap-4 items-center py-[1rem] bg-[#ffff] transition-all duration-300 social-links">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                            target="_blank">
                            <span class="fa fa-facebook text-[1rem] text-[#3b5998]"></span>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url('/')) }}"
                            target="_blank">
                            <span class="fa fa-linkedin text-[1rem] text-[#0e76a8]"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @include('shared.alert')

        @include('layouts.inc.footer')
    </div>

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    @include('layouts.inc.script')

</body>

</html>
