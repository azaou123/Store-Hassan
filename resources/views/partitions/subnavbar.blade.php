<nav class="navbar navbar-expand-lg bg-light navbar-light py-0 py-lg-0 px-0">
    <a class="" href="{{ route('index') }}" style="display:none;" id="subnavbarLogo">
        <img src="{{ asset('storage/'.$parametres->logo) }}" alt="Logo" class="img-fluid rounded mb-2"
            style="width:140px; height : 60px;">
    </a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <div class="navbar-nav mr-auto py-0">
            <a href="{{ route('index') }}" class="nav-item nav-link active">Accueil</a>
            <!-- <a href="" class="nav-item nav-link" data-bs-toggle="modal" data-bs-target="#myModal">Panier</a> -->
            <a href="{{ route('about') }}" class="nav-item nav-link">A Propos</a>
            <a href="{{ route('contactpage') }}" class="nav-item nav-link">Contact</a>
        </div>
        <div class="navbar-nav ml-auto py-0">
            <a href="{{ route('lesoffres') }}" class="nav-item nav-link">Les Promotions</a>
        </div>
    </div>
</nav>

<script>
    // Function to handle screen size changes
    function handleScreenSizeChange(mq) {
        var subnavbarLogo = document.getElementById('subnavbarLogo');
        if (mq.matches) {
            // If screen size is small (e.g., mobile), show logo
            subnavbarLogo.style.display = 'block';
        } else {
            // If screen size is large (e.g., desktop), hide logo
            subnavbarLogo.style.display = 'none';
        }
    }

    // Media query for small screens (e.g., max-width: 768px)
    const smallScreenQuery = window.matchMedia('(max-width: 990px)');

    // Initial check for screen size
    handleScreenSizeChange(smallScreenQuery);

    // Add event listener for screen size changes
    smallScreenQuery.addListener(handleScreenSizeChange);
</script>