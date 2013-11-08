<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function generateHeader()
{
echo <<<ZZEOF
<header id="banner">
	<h1>University of Windsor Used Book Store</h1>
	<nav><ul>
		<li><a href="../index.php">Home</a></li>
		<li><a href="/upload_book/upload_book_form.php">Upload a textbook</a></li>
ZZEOF;

if($_SESSION['loggedinas']===null)
{
echo <<<ZZEOF
		<li><a href="/user_auth/user_signin.php">Login</a></li>
	</ul></nav>
	
ZZEOF;
}
else
{
echo <<<ZZEOF
		<li><a href="/user_profiles/profile.php?user={$_SESSION['user']}">
ZZEOF;
echo $_SESSION['loggedinas'];
echo <<<ZZEOF
                                </a> <a href="/user_auth/user_signout.php">(Sign Out)</a></li>
	</ul></nav>
	
ZZEOF;
}
echo <<<ZZEOF
<form method="post" action="/book_search/search_view.php">
	<input type="text" size="50" name="searchFor">
	<input type="submit" value="Search" >
</form>
</header>


ZZEOF;
}

?>