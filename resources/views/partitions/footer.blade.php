<!-- info section -->
<section class="info_section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="info_contact">
                    <h5>
                        <a href="{{ route('index') }}" class="navbar-brand">
                            <span>
                                {{ $parametres->site_name }}
                            </span>
                        </a>
                    </h5>
                    <p>
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        {{ $parametres->address }}
                    </p>
                    <p>
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        {{ $parametres->phone }}
                    </p>
                    <p>
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        {{ $parametres->email }}
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info_info">
                    <h5>
                        Information
                    </h5>
                    <p>
                        {{ $parametres->information }}
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info_links">
                    <h5>
                        Useful Link
                    </h5>
                    <ul>
                        <li>
                            <a href="{{ route('index') }}">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('index') }}">
                                About
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('index') }}">
                                Products
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('index') }}">
                                Why Us
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('index') }}">
                                Testimonial
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info_form">
                    <h5>
                        Newsletter
                    </h5>
                    <form action="{{ route('index') }}" method="POST">
                        @csrf
                        <input type="email" name="email" placeholder="Enter your email" required>
                        <button type="submit">
                            Subscribe
                        </button>
                    </form>
                    <div class="social_box">
                        <a href="{{ $parametres->facebook }}" target="_blank">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                        <a href="{{ $parametres->twitter }}" target="_blank">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                        </a>
                        <a href="{{ $parametres->instagram }}" target="_blank">
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                        </a>
                        <a href="{{ $parametres->youtube }}" target="_blank">
                            <i class="fa fa-youtube" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end info_section -->

<!-- footer section -->
<footer class="footer_section">
    <div class="container">
        <p>
            &copy; <span id="displayYear">{{ date('Y') }}</span> All Rights Reserved By
            <a href="{{ $parametres->website }}" target="_blank">{{ $parametres->site_name }}</a>
        </p>
    </div>
</footer>