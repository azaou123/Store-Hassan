<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top text-light"
    style="background-color : #434f78 ; color:white; ">
    <div class="col-md-4 d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
            <svg class="bi" width="30" height="24">
                <use xlink:href="#bootstrap"></use>
            </svg>
        </a>
        <span class="mb-3 mb-md-0 text-light">© 2024 Luxmar, Casablanca</span>
    </div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
        <li class="ms-3"><a class="text-muted" href="{{ $parametres->insta }}" target="_blanc">
                <i class="fa-brands fa-instagram text-light fw-bol fs-4 mx-1"></i>
            </a></li>
        <li class="ms-3"><a class="text-muted" href="{{ $parametres->whatsapp }}" target="_blanc">
                <i class="fa-solid fa-phone text-light fw-bol fs-4 mx-1"></i>
            </a></li>
        <li class="ms-3"><a class="text-muted" href="{{ $parametres->facebook }}" target="_blanc">
                <i class="fa-brands fa-facebook-f text-light fw-bol fs-4 mx-1"></i>
            </a></li>
    </ul>
</footer>