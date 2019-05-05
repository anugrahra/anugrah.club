<?php


/////////////////////////MAIN/////////////////////////
function escape($data){
	global $link;
	return mysqli_real_escape_string($link, $data);
}

function excerpt($string){
	$string = substr($string, 0, 250);
	return $string . "...";
}

function sistem_login($username, $password){
	$username = escape($username);
	$password = escape($password);

	$query = "SELECT * FROM akun WHERE username = '$username' AND password = '$password'";
	global $link;

	if($result = mysqli_query($link, $query)){
		if(mysqli_num_rows($result) > 0 ){
			$row_akun = mysqli_fetch_array($result);
			$_SESSION['id'] = $row_akun['id'];
			$_SESSION['user'] = $row_akun['username'];
			header('location: admin/home.php');
		}else{
			echo "Username / Password yang anda masukkan salah";
		}
	}
}

/////////////////////////BLOG/////////////////////////
function tampilkanBlog() {
	global $link;

	$query = "SELECT * FROM blogpost ORDER BY id DESC";
	$result = mysqli_query($link, $query) or die ('gagal nampilin data blog');

	return $result;
}

function tampilkanBlogLimit() {
	global $link, $start, $perPage;

	$query = "SELECT * FROM blogpost ORDER BY id DESC LIMIT $start, $perPage";
	$result = mysqli_query($link, $query) or die ('gagal nampilin data blog');

	return $result;
}

function runBlog($query){
	global $link;

	if(mysqli_query($link, $query)) return true;
	else return false;
}

function tambahTulisan($judul, $isi, $tag, $slug){
	$query = "INSERT INTO blogpost (judul, isi, tag, slug) VALUES ('$judul', '$isi', '$tag', '$slug')";

	return runBlog($query);
}

function editTulisan($judul, $isi, $tag, $slug, $id){
	$query = "UPDATE blogpost SET judul='$judul', isi='$isi', tag='$tag', slug='$slug' WHERE id=$id";
	
	return runBlog($query);
}

function tulisanPerId($id){
	global $link;

	$query = "SELECT * FROM blogpost WHERE id=$id";
	$result = mysqli_query($link, $query) or die ('gagal nampilin data blog');;

	return $result;
}

function tulisanPerSlug($slug){
	global $link;

	$query = "SELECT * FROM blogpost WHERE slug = '$slug'";
	$result = mysqli_query($link, $query) or die ('gagal nampilin data blog');;

	return $result;
}

function tulisanPerTag($tag){
	global $link;

	$query = "SELECT * FROM blogpost WHERE tag = '$tag' ORDER BY id DESC";
	$result = mysqli_query($link, $query) or die ('gagal nampilin data blog');;

	return $result;
}

function hapusTulisan($id){
	$query = "DELETE FROM blogpost WHERE id=$id";

	return runBlog($query);
}

/////////////////////////PODCAST/////////////////////////
function tampilkanPodcast() {
	global $linkpodcast;

	$query = "SELECT * FROM episode ORDER BY id ASC";
	$result = mysqli_query($linkpodcast, $query) or die ('gagal nampilin data podcast');

	return $result;
}

function tampilkanPodcastLimit() {
	global $linkpodcast, $start, $perPage;

	$query = "SELECT * FROM episode ORDER BY id DESC LIMIT $start, $perPage";
	$result = mysqli_query($linkpodcast, $query) or die ('gagal nampilin data podcast');

	return $result;
}

function runPodcast($query){
	global $linkpodcast;

	if(mysqli_query($linkpodcast, $query)) return true;
	else return false;
}

function tambahEpisode($no_episode, $judul, $anchor, $caption, $note, $slug){
	$query = "INSERT INTO episode (no_episode, judul, anchor, caption, note, slug) VALUES ($no_episode, '$judul', '$anchor', '$caption', '$note', '$slug')";
	return runPodcast($query);
}

function editEpisode($no_episode, $judul, $caption, $note, $anchor, $slug, $id){
	$query = "UPDATE episode SET no_episode=$no_episode, judul='$judul', anchor='$anchor', caption='$caption', note='$note', slug='$slug' WHERE id=$id";
	
	return runPodcast($query);
}

function episodePerId($id){
	global $linkpodcast;

	$query = "SELECT * FROM episode WHERE id=$id";
	$result = mysqli_query($linkpodcast, $query) or die ('gagal nampilin data podcast');;

	return $result;
}

function episodePerSlug($slug){
	global $linkpodcast;

	$query = "SELECT * FROM episode WHERE slug = '$slug'";
	$result = mysqli_query($linkpodcast, $query) or die ('gagal nampilin data podcast');;

	return $result;
}

function hapusEpisode($id){
	$query = "DELETE FROM episode WHERE id=$id";

	return runPodcast($query);
}