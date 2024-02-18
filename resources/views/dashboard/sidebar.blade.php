<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="{{ route('profile') }}" class="navbar-brand mx-4 mb-3">
            LuxMar
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="back/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ $manager->fullName }}</h6>
                <span>Manager</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ route('profile') }}" class="nav-item nav-link {{ request()->is('profile') ? 'active' : '' }}">
                <i class="fa fa-tachometer-alt me-2"></i>Dashboard
            </a>
            <a href="{{ route('commandes') }}"
                class="nav-item nav-link {{ request()->is('commandes') ? 'active' : '' }}">
                <i class="fas fa-list-alt me-2"></i>Commandes
            </a>
            <a href="{{ route('categories') }}"
                class="nav-item nav-link {{ request()->is('categories') ? 'active' : '' }}">
                <i class="fas fa-folder me-2"></i>Catégories
            </a>
            <a href="{{ route('produits') }}" class="nav-item nav-link {{ request()->is('produits') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart me-2"></i>Produits
            </a>
            <a href="{{ route('offres') }}" class="nav-item nav-link {{ request()->is('offres') ? 'active' : '' }}">
                <i class="fas fa-check-circle me-2"></i>
                Offres
            </a>
            <a href="{{ route('opinions') }}" class="nav-item nav-link {{ request()->is('opinions') ? 'active' : '' }}">
                <i class="fas fa-comments me-2"></i>Opinions
            </a>
            <a href="{{ route('partenaires') }}"
                class="nav-item nav-link {{ request()->is('partenaires') ? 'active' : '' }}">
                <i class="fa-solid fa-handshake me-2"></i>Partenaires
            </a>
            <a href="{{ route('parametres') }}"
                class="nav-item nav-link {{ request()->is('parametres') ? 'active' : '' }}">
                <i class="fas fa-cogs me-2"></i>Paramètres
            </a>
            <a href="{{ route('messages') }}" class="nav-item nav-link {{ request()->is('messages') ? 'active' : '' }}">
                <i class="fas fa-message me-2"></i>Messages
            </a>
        </div>

    </nav>
</div>