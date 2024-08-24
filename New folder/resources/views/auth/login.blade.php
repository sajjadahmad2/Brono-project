<!DOCTYPE html>
<html lang="en">

<head>
    <title> Login - XMS Panel</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        aside {
            background: repeating-linear-gradient(35deg,
                    hsl(343 100% 50%) 0px 2px,
                    hsl(23 100% 50%) 0px 4px);
            mix-blend-mode: multiply;
            animation: none 40000ms infinite linear;
        }

        @keyframes move {
            100% {
                transform: translate(41px, 0px);
            }
        }


        .company-logo p{
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 6vmin;
            font-weight: 900;
        }

    </style>
    
    
        
      <script>
       
         if (window.top === window.self) {
            // If not in an iframe, redirect to an error page
            // window.location.href = "{{ route('not_allowed') }}"; 
        }
    </script>
    
</head>

<body id="kt_body" class="app-blank app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-theme-mode");
            } else {
                if (localStorage.getItem("data-theme") !== null) {
                    themeMode = localStorage.getItem("data-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-theme", themeMode);
        }
    </script>

    <div class="d-flex flex-column flex-root" id="kt_app_root">

        <style>
            body {
                background-image: url('assets/media/auth/bg4.jpg');
            }

            [data-theme="dark"] body {
                background-image: url('assets/media/auth/bg4-dark.jpg');
            }
        </style>
        <div class="d-flex flex-column flex-column-fluid flex-lg-row">

            <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">

                <div class="d-flex flex-center flex-lg-start flex-column">

                    <a href="{{ url('/') }}" class="mb-7 company-logo">
                        {{-- <img alt="Logo" src="{{ asset('assets/media/logos/custom-3.svg') }}" /> --}}
                        <p>XMS Panel</p>
                        <aside></aside>

                    </a>

                    <h2 class="text-white fw-normal m-0">Branding tools designed for
                        your business</h2>
                </div>
            </div>
            <div class="d-flex flex-center w-lg-50">
                <div class="card rounded-3 w-md-550px  p-10">
                    <div class="card-body p-10 p-lg-20">
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form"
                            data-kt-redirect-url="{{ url('/') }}" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="text-center mb-11">
                                <h1 class="text-dark fw-bolder mb-3">Sign In</h1>
                            </div>
                    </div>
                    <div class="fv-row mb-8">
                        <input type="email" class="form-control bg-transparent @error('email') is-invalid @enderror"
                            name="email" id="email" placeholder="Email" value="{{ old('email') }}"
                            autocomplete="off">
                        @error('email')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="fv-row mb-3">
                        <input type="password"
                            class="form-control bg-transparent @error('password') is-invalid @enderror" name="password"
                            id="password" placeholder="Enter password" autocomplete="off">
                        @error('password')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8" hidden>
                        <div></div>
                        <a href="#" class="link-primary" hidden>Forgot Password
                            ?</a>
                    </div>

                    <div class="d-grid mb-10">
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                            <span class="indicator-label">Sign In</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>

                        </button>
                    </div>

                    <div class="text-gray-500 text-center fw-semibold fs-6 d-none">
                        Not a Member yet?
                        <a href="../../demo1/dist/authentication/layouts/creative/sign-up.html"
                            class="link-primary">Sign up</a>
                    </div>
                    <!--end::Sign up-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-in-->
    </div>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>

    
    
</body>

</html>
