<header class="header_section">
    <div class="header_top">
        <div class="container-fluid">
            <div class="top_nav_container">
                <div class="contact_nav">
                    <a href="tel:{{ $parametres->whatsapp }}">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <span>
                            Télé : {{ $parametres->whatsapp }}
                        </span>
                    </a>
                    <a href="mailto:{{ $parametres->email }}">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <span>
                            Email : {{ $parametres->email }}
                        </span>
                    </a>
                </div>
                <form class="search_form">
                    <input type="text" class="form-control" placeholder="Chercher...">
                    <button class="" type="submit">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </form>
                <!-- Removed the "user_option_box" containing "My Account" and "Cart" links -->
            </div>
        </div>
    </div>
    <div class="header_bottom">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img src="{{ asset('storage/'.$parametres->logo) }}" alt="Logo" class="img-fluid rounded mb-2"
                        style="width:200px; height : 60px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class=""> </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto"> <!-- Align the menu to the right -->
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('index') }}">Accuiel <span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('index') }}"> About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('index') }}">Produits</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('index') }}">Why Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('index') }}">Testimonial</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>