
<div class="top-container">
	<div class='top-logo-container'>
		<a href='./index.php'>
		<img class="logo" src="./images/GraceLogo.png" alt="Grace Logo">
		</a>
	</div>
	<div class='top-description'>Genomic Regression Analysis of Coordinated Expression</div>
</div>
<div id='top-nav-container'>
	<ol class='top-nav card'>
		<li><a href='./index.php' id='top-nav-home' class='fa fa-home' style='font-size: 2rem;' title='Home'></a></li>
		<li><a href='./Analysis.php' id='top-nav-analysis' title='Analysis of coordinately expressed genes'>Analysis</a></li>
		<li><a href='./FAQ.php' id='top-nav-faq' title='Frequently Asked Questions'>FAQ</a></li>
		<li><a href='./Resources.php' id='top-nav-resources' title='Useful websites'>Resources</a></li>
		<li><a href='./Credits.php' id='top-nav-credits' title='Acknowledgements'>Credits</a></li>
		<li><a href='./About.php' id='top-nav-about' title='Version history'>About</a></li>
		<li class="icon">
	    <a href="javascript:void(0);" onclick="toggleMenu()"><i class="fa fa-bars"></i></a>
	  </li>
	</ol>
</div>
<script>
function toggleMenu() {
    document.getElementsByClassName("top-nav")[0].classList.toggle("responsive");
}
function activatePage(activePage) {
	var page = document.getElementById(activePage);
	page.className += " active";
}
</script>