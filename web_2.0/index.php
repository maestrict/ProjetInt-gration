<!DOCKTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/logo.ico">
</head>
<body>
<nav class='navbar navbar-expand-sm navbar-light bg-light'>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item"><a class="nav-link" href="#">Acceuil</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Recherche terrain</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Recherche partenaire</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Mon Compte</a></li>
        </ul>
        <div class="btn-group dropleft">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
            </button>
            <div class="dropdown-menu">
                <form action="assets/php/request.php" class="px-4 py-3 form-signin" id="login" method="post">
                    <div class="form-group">
                        <label for="pseudo">pseudo</label>
                        <input type="text" name="pseudo" id="pseudo" class="form-control"  placeholder="pseudo" required>
                    </div>
                    <div class="form-group">
                        <label for="mdp">Password</label>
                        <input type="password" name="mdp" id="mdp" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="dropdownCheck">
                        <label class="form-check-label" for="dropdownCheck">
                            Remember me
                        </label>
                    </div>
                    <input type="submit" name="login" class="btn btn-primary" value="Sign in">
                </form>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="signup.php">New around here? Sign up</a>
                <a class="dropdown-item" href="login.php">Forgot password?</a>
            </div>
        </div>
    </div>
</nav>

<section id="banner">
    <div id="home" class="jumbotron">
        <h2>MooveGo</h2>
        <p>Une autre façon de pratiquer du sport<br> avec de nouvelles personnes</p>
        <a href="#one" class="more scrolly">En savoir plus</a>
    </div>
</section>

<div class="container">
    <!-- One -->
    <section id="one" class="wrapper style1 special">
        <div class="inner">
            <header class="major">
                <h2>Sport Share est une application de mise en relation de personnes, ayant pour but<br> de promouvoir les activitées sportives à plusieurs.</h2>
                <p>Sport Share est une application de mise en relation de personnes, ayant pour but de promouvoir les activitées sportives à plusieurs.</p>
            </header>
            <ul class="icons major">
                <li><span class="icon fa-diamond major style1"><span class="label">Lorem</span></span></li>
                <li><span class="icon fa-heart-o major style2"><span class="label">Ipsum</span></span></li>
                <li><span class="icon fa-code major style3"><span class="label">Dolor</span></span></li>
            </ul>
        </div>
    </section>

    <!-- Two -->
    <section id="two" class="row">
        <div class="col-md-4 bg-light">
                <h2>Activité</h2>
                <p>Aliquam ut ex ut augue consectetur interdum. Donec hendrerit imperdiet. Mauris eleifend fringilla nullam aenean mi ligula.</p>
            <a class="btn btn-secondary" href="#" role="button">View details »</a>
        </div>
        <div class="col-md-4 bg-light">
                <h2>Reserver des terrains</h2>
                <p>Aliquam ut ex ut augue consectetur interdum. Donec hendrerit imperdiet. Mauris eleifend fringilla nullam aenean mi ligula.</p>
            <a class="btn btn-secondary" href="#" role="button">View details »</a>
        </div>
        <div class="col-md-4 bg-light">
                <h2>Evenements</h2>
                <p>Aliquam ut ex ut augue consectetur interdum. Donec hendrerit imperdiet. Mauris eleifend fringilla nullam aenean mi ligula.</p>
            <a class="btn btn-secondary" href="#" role="button">View details »</a>
        </div>
    </section>

    <!-- Three -->
    <section id="three" class="wrapper style3 special">
        <div class="inner">
            <header class="major">
                <h2>Accumsan mus tortor nunc aliquet</h2>
                <p>Aliquam ut ex ut augue consectetur interdum. Donec amet imperdiet eleifend<br />
                    fringilla tincidunt. Nullam dui leo Aenean mi ligula, rhoncus ullamcorper.</p>
            </header>
            <ul class="features">
                <li class="icon fa-paper-plane-o">
                    <h3>Arcu accumsan</h3>
                    <p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
                </li>
                <li class="icon fa-laptop">
                    <h3>Ac Augue Eget</h3>
                    <p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
                </li>
                <li class="icon fa-code">
                    <h3>Mus Scelerisque</h3>
                    <p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
                </li>
                <li class="icon fa-headphones">
                    <h3>Mauris Imperdiet</h3>
                    <p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
                </li>
                <li class="icon fa-heart-o">
                    <h3>Aenean Primis</h3>
                    <p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
                </li>
                <li class="icon fa-flag-o">
                    <h3>Tortor Ut</h3>
                    <p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
                </li>
            </ul>
        </div>
    </section>
</div>
    <footer class="footer bg-light">
        <ul class="icons">
            <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
            <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
            <li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
            <li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
        </ul>
    </footer>
</body>
</html>