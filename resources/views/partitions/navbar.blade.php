<header class="header_section">
    <div class="header_top">
        <div class="container-fluid">
            <div class="top_nav_container">
                <div class="contact_nav justify-content-center">
                    <a href="tel:{{ $parametres->whatsapp }}" class="mx-2" target="_blanc">
                        <i class="fa fa-phone mx-1" aria-hidden="true"></i>
                        <span>
                            Téléphone
                        </span>
                    </a>
                    <a href="mailto:{{ $parametres->email }}" class="mx-2" target="_blanc">
                        <i class="fa fa-envelope mx-1" aria-hidden="true"></i>
                        <span>
                            Email
                        </span>
                    </a>
                    <a href="{{ $parametres->facebook }}" class="mx-2" target="_blanc">
                        <i class="fa fa-facebook mx-1" aria-hidden="true"></i>
                        <span>
                            Facebbok
                        </span>
                    </a>
                    <a href="{{ $parametres->address }}" class="mx-2" target="_blanc">
                        <i class="fa fa-envelope mx-1" aria-hidden="true"></i>
                        <span>
                            Adresse
                        </span>
                    </a>
                </div>
                <!-- Removed the "user_option_box" containing "My Account" and "Cart" links -->
            </div>
        </div>
    </div>
    <div class="header_top_prime" style="display:none;">
        <div class="container-fluid">
            <div class="top_nav_container">
                <div class="contact_nav">
                    <a href="tel:{{ $parametres->whatsapp }}" target="_blanc">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                    </a>
                    <a href="mailto:{{ $parametres->email }}" target="_blanc">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </a>
                    <a href="mailto:{{ $parametres->facebook }}" target="_blanc">
                        <i class="fa fa-facebbok" aria-hidden="true"></i>
                    </a>
                    <a href="mailto:{{ $parametres->insta }}" target="_blanc">
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                    </a>
                </div>
                <!-- Removed the "user_option_box" containing "My Account" and "Cart" links -->
            </div>
        </div>
    </div>
    <style>
        @media only screen and (max-width: 767px) {
            .header_top {
                display: none;
            }

            .header_top_prime {
                display: flex;
            }
        }
    </style>
    <div class="header_bottom" style="background-color:#EEEDED;">
        <div class="container-fluid ">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img src="{{ asset('storage/'.$parametres->logo) }}" alt="Logo" class="img-fluid rounded mb-2"
                        style="width:170px; height : 60px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class=""> </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto text-dark"> <!-- Align the menu to the right -->
                        <li class="nav-item active">
                            <a class="nav-link text-dark" href="{{ route('index') }}">Accuiel <span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('about') }}"> A Propos</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>