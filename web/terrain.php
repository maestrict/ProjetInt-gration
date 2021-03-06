<?php
session_start();
require_once('assets/php/utils.php');
terrain('get');
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Gestion des terrains</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="index.php">Gestion des terrains</a></h1>
						<nav id="nav">
							<ul>
								<li class="special">
									<a href="#menu" class="menuToggle"><span>Menu</span></a>
									<div id="menu">
										<ul>
											<li><a href="index.php">déconnection</a></li>
											<li><a href="compte.php">compte</a></li>
										</ul>
									</div>
								</li>
							</ul>
						</nav>
					</header>

				<!-- Main -->
					<article id="main">
						<section class="wrapper compte">
							<div id="tbTerrain" class="inner">
                                <form method="post" name="terrain">
                                    <table>
                                        <?php
                                        echo"<thead><tr>";
                                        foreach ($_SESSION['terrains'][0] as $cle => $value){
                                            if($cle == 'clubId' || $cle == 'tId'){

                                            }else{
                                                echo"<td>".$cle."</td>";
                                            }
                                        }
                                        echo"</tr></thead>";
                                        echo"<tbody><tr>";
                                        foreach ($_SESSION['terrains'] as $terrain => $test){
                                            foreach ($_SESSION['terrains'][$terrain] as $cle => $value){
                                                if($cle == 'clubId' || $cle == 'tId'){

                                                }else{
                                                    echo"<td>".$value."</td>";
                                                }
                                            }
                                            echo <<<EOT
<td><input type="button" name="suppTerrain" id="{$_SESSION['terrains'][$terrain]['tId']}" value="supprimer" onclick="ajax('suppTerrains',this.id);"></td>
EOT;
                                            echo "</tr>";
                                        }
                                        echo"</tr></tbody>";
                                        echo"<tfoot><tr>";
                                        foreach ($_SESSION['terrains'][0] as $cle => $value){
                                            if ($cle == 'clubId' || $cle == 'tId'){

                                            }elseif($cle == 'sId' || $cle == 'reserve'){
                                                echo "<td><input type='text' name='".$cle."'></td>";
                                            }else{
                                                echo "<td><input type='text' name='".$cle."' disabled></td>";
                                            }
                                        }
                                        echo"<td><input type='submit' name='ajoutTerrain' value='ajouter'></td>";
                                        echo "</tr></tfoot>";
                                        ?>
                                    </table>
                                </form>
							</div>
						</section>
					</article>

				<!-- Footer -->
					<footer id="footer">
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
							<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
						</ul>
						<ul class="copyright">
							<li>&copy; Untitled</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
						</ul>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
            <script src="assets/js/util.js"></script>
            <script src="assets/js/main.js"></script>
            <script src="assets/js/utils.js"></script>

	</body>
</html>