<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Store Hassan | Admin</title>
</head>
<body>
    <section class="vh-100" style="background-color: #508bfc;">
    <form method="POST" action="{{ route('dashboord') }}">
        @csrf
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">
                    <h3 class="mb-5">Admin | Connexion</h3>
                    <div class="form-outline mb-4">
                    <input type="email" name="email" id="typeEmailX-2" class="form-control form-control-lg" placeholder="Email"/>
                    </div>
                    <div class="form-outline mb-4">
                    <input type="password" name="password" id="typePasswordX-2" class="form-control form-control-lg" placeholder="Password"/>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                    <hr class="my-4">
                    <!-- Section for returned errors :  -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <span>{{ $error }}</span> <br>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('failLogin'))
                        <div class="alert alert-danger">
                            <span>{{ session('failLogin') }}</span>
                        </div>
                    @endif
                </div>
                </div>
            </div>
            </div>
        </div>
    </form>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>