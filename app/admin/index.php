<?php 
session_start();
require_once "../core/config.php";
require_once "../templates/header.php";
require_once "../db/db.php";
require_once "../functions/functions.php";

if( isset($_COOKIE['login']) && isset($_COOKIE['loginus']) ){
	$login = $_COOKIE['login'];
	$loginus = $_COOKIE['loginus'];

	$result = mysqli_query($link, "SELECT username FROM akun WHERE id = $login");
	$row = mysqli_fetch_assoc($result);

	if ( $loginus === hash('sha256', $row['username']) ){
		$_SESSION['login'] = true;
	}
}

if(isset($_SESSION['login'])){
	header('location: admin/home.php');
	exit;
}

$eror='';
if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$remember = $_POST['remember'];

	if(!empty(trim($username) && !empty($password))){
	 	sistem_login($username, $password, $remember);
	}else{
	  	$eror = 'nama dan password harus diisi';
	}

}
?>

<div class="homelink">
	<p><a href="<?=BASEURL;?>">&lt; home</a></p>
</div>

<div class="mainisi">
	<div>
		<h1>Selamat mencipta :)</h1>
	</div>
	<br>
	<?=$eror;?>
	<form method="post">
		<label for="username">Username</label><br>
		<input type="text" name="username"><br>
		<label for="password">Password</label><br>
		<input type="password" name="password" style="margin-bottom: 8px;"><br>
		<input type="checkbox" name="remember">
		<label for="remember">Inget aku dong beb</label><br><br>
		<input type="submit" name="submit" value="Log In">
	</form>
	<br>
	<div>
		<p><b>men•cip•ta</b> <i>v</i> memusatkan angan-angan demi menjadikan sesuatu ada, seburuk atau sebaik apapun.</p>
	</div>
</div>

<br>
<br>

<div class="homelink">
	<p><a href="<?=BASEURL;?>">&lt; home</a></p>
</div>

<?php require_once	"../templates/footer.php";?>