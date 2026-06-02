<?php
// Memulai sesi PHP. Ini harus dipanggil di awal setiap halaman yang menggunakan sesi.
session_start();

	// Menginclude file 'connection.php' yang berisi detail koneksi database.
	include("connection.php");
	// Menginclude file 'functions.php' yang berisi fungsi-fungsi yang digunakan di aplikasi, seperti random_num.
	include("functions.php");


	// Memeriksa apakah permintaan HTTP adalah POST (yaitu, formulir telah disubmit).
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		// Komentar: Sesuatu telah diposting (formulir telah disubmit).
		// Mengambil nilai 'user_name' dari data POST.
		$user_name = $_POST['user_name'];
		// Mengambil nilai 'password' dari data POST.
		$password = $_POST['password'];

		// Memvalidasi input:
		// 1. Memastikan 'user_name' tidak kosong.
		// 2. Memastikan 'password' tidak kosong.
		// 3. Memastikan 'user_name' bukan angka (untuk mencegah pendaftaran dengan username numerik jika username seharusnya string).
		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{
			// Membuat user_id unik acak sepanjang 20 karakter menggunakan fungsi bawaan di functions.php
			$user_id = random_num(20); 

			// Masukkan variabel $user_id ke dalam query insert
			$query = "insert into users (user_id, user_name, password) values ('$user_id', '$user_name', '$password')";

			// Menjalankan query SQL pada koneksi database ($con).
			mysqli_query($con, $query);

			// Mengarahkan pengguna ke halaman 'login.php' setelah pendaftaran berhasil.
			header("Location: login.php");
			// Menghentikan eksekusi skrip setelah pengalihan.
			die;
		}else
		{
			// Komentar: Dimodifikasi untuk menyimpan pesan kesalahan dalam variabel untuk ditampilkan di HTML.
			$error_message = "Please enter some valid information!";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>BaliWeather</title>
	<style type="text/css">
	/* Universal box-sizing for easier layout */
	* {
		box-sizing: border-box; /* Mengatur box-sizing ke border-box untuk semua elemen, memudahkan perhitungan lebar dan tinggi. */
	}

	body {
		font-family: Arial, sans-serif; /* Mengatur font default menjadi Arial atau sans-serif generik. */
		margin: 0; /* Menghilangkan margin default body. */
		padding: 0; /* Menghilangkan padding default body. */
		background-color: #f0f2f5; /* Mengatur warna latar belakang halaman menjadi abu-abu muda. */
		display: flex; /* Mengatur body sebagai flex container. */
		justify-content: center; /* Memusatkan konten flex secara horizontal. */
		align-items: center; /* Memusatkan konten flex secara vertikal. */
		min-height: 100vh; /* Memastikan body mengambil tinggi penuh dari viewport (layar). */
	}

	/* Main Content Box Styling - This is your grey box */
	#box {
		background-color: #555555; /* Mengatur warna latar belakang kotak utama menjadi abu-abu gelap. */
		width: 750px; /* Menentukan lebar kotak utama (dibuat lebih lebar agar sesuai dengan halaman login). */
		padding: 40px; /* Menambahkan padding di dalam kotak. */
		border-radius: 10px; /* Memberikan sudut membulat pada kotak. */
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Menambahkan bayangan pada kotak. */
		color: #e0e0e0; /* Mengatur warna teks default di dalam kotak menjadi abu-abu muda. */
	}

	/* "Signup" Title Styling */
	#box .title {
		font-size: 36px; /* Mengatur ukuran font judul "Signup". */
		font-weight: bold; /* Mengatur ketebalan font menjadi bold. */
		margin-bottom: 30px; /* Menambahkan margin bawah di bawah judul. */
		color: #e0e0e0; /* Mengatur warna teks judul menjadi abu-abu muda. */
		text-align: left; /* Mengatur perataan teks judul ke kiri. */
	}

	/* Input Field Styling */
	#text {
		height: 50px; /* Mengatur tinggi kolom input. */
		border-radius: 25px; /* Memberikan sudut membulat yang lebih besar (membuat bentuk pill). */
		padding: 10px 20px; /* Menambahkan padding di dalam kolom input. */
		border: none; /* Menghilangkan border kolom input. */
		width: 100%; /* Mengatur lebar kolom input menjadi 100% dari parent-nya. */
		margin-bottom: 25px; /* Menambahkan margin bawah di bawah kolom input. */
		font-size: 18px; /* Mengatur ukuran font teks di dalam kolom input. */
		background-color: white; /* Mengatur warna latar belakang kolom input menjadi putih. */
		color: #333; /* Mengatur warna teks di dalam kolom input menjadi abu-abu gelap. */
		text-align: center; /* Memusatkan teks placeholder di dalam kolom input. */
		outline: none; /* Menghilangkan outline yang muncul saat kolom input fokus. */
	}

    /* Placeholder text styling (Webkit browsers like Chrome, Safari) */
    #text::-webkit-input-placeholder {
        color: #888; /* Mengatur warna teks placeholder menjadi abu-abu. */
        text-transform: uppercase; /* Mengubah teks placeholder menjadi huruf kapital. */
        font-weight: bold; /* Mengatur ketebalan font placeholder menjadi bold. */
    }
    /* Placeholder text styling (Mozilla Firefox) */
    #text:-moz-placeholder {
        color: #888; /* Mengatur warna teks placeholder untuk Firefox. */
        text-transform: uppercase; /* Mengubah teks placeholder menjadi huruf kapital untuk Firefox. */
        font-weight: bold; /* Mengatur ketebalan font placeholder untuk Firefox. */
    }
    /* Placeholder text styling (Microsoft Edge/IE) */
    #text::-ms-input-placeholder {
        color: #888; /* Mengatur warna teks placeholder untuk Edge/IE. */
        text-transform: uppercase; /* Mengubah teks placeholder menjadi huruf kapital untuk Edge/IE. */
        font-weight: bold; /* Mengatur ketebalan font placeholder untuk Edge/IE. */
    }


	/* Submit Button Styling */
	#button {
		padding: 15px 20px; /* Menambahkan padding pada tombol. */
		width: 150px; /* Menentukan lebar tombol. */
		color: white; /* Mengatur warna teks tombol menjadi putih. */
		background-color: #888888; /* Mengatur warna latar belakang tombol menjadi abu-abu muda. */
		border: none; /* Menghilangkan border tombol. */
		border-radius: 25px; /* Memberikan sudut membulat pada tombol. */
		font-size: 18px; /* Mengatur ukuran font teks tombol. */
		font-weight: bold; /* Mengatur ketebalan font tombol menjadi bold. */
		cursor: pointer; /* Mengubah kursor menjadi pointer saat diarahkan ke tombol. */
		transition: background-color 0.3s ease; /* Menambahkan efek transisi halus pada perubahan warna latar belakang. */
		margin-top: 5px; /* Menambahkan sedikit margin atas. */
		margin-bottom: 30px; /* Menambahkan margin bawah di bawah tombol. */
        display: block; /* Membuat tombol menjadi elemen block-level. */
        margin-left: 0; /* Mengatur margin kiri ke 0. */
        margin-right: auto; /* Mengatur margin kanan otomatis untuk mendorong tombol ke kiri (bersama dengan text-align: center di button, ini akan memusatkannya jika lebarnya lebih kecil dari parent, tetapi di sini dikombinasikan dengan text-align: center). */
        text-align: center; /* Memastikan teks di dalam tombol terpusat. */
        line-height: 1; /* Mengatur tinggi baris agar teks terpusat secara vertikal dalam tombol. */
	}

	#button:hover {
		background-color: #999999; /* Mengubah warna latar belakang tombol menjadi abu-abu sedikit lebih terang saat di-hover. */
	}

	/* Link Styling */
	.link-container {
		text-align: left; /* Mengatur perataan teks dalam kontainer link ke kiri. */
		margin-top: 15px; /* Menambahkan margin atas pada kontainer link. */
		font-size: 16px; /* Mengatur ukuran font teks dalam kontainer link. */
		color: #e0e0e0; /* Mengatur warna teks dalam kontainer link menjadi abu-abu muda. */
	}

	.link-container a {
		color: #e0e0e0; /* Mengatur warna link menjadi abu-abu muda. */
		text-decoration: underline; /* Menambahkan garis bawah pada link. */
		font-weight: bold; /* Mengatur ketebalan font link menjadi bold. */
	}

	.link-container a:hover {
		color: white; /* Mengubah warna link menjadi putih saat di-hover. */
	}

	/* Error Message Styling */
	.error-message {
		color: #ffcccc; /* Mengatur warna teks pesan kesalahan menjadi merah muda terang. */
		margin-bottom: 20px; /* Menambahkan margin bawah pada pesan kesalahan. */
		font-weight: bold; /* Mengatur ketebalan font pesan kesalahan menjadi bold. */
		font-size: 15px; /* Mengatur ukuran font pesan kesalahan. */
	}

	</style>
</head>
<body>
	<div id="box">

		<form method="post">
			<div class="title">Signup</div>

            <?php if (isset($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
                <?php endif; ?>

			<input id="text" type="text" name="user_name" placeholder="USERNAME">
            <input id="text" type="password" name="password" placeholder="PASSWORD">
            <input id="button" type="submit" value="SUBMIT">
            <div class="link-container">
				Already have an account? <a href="login.php">Login here!</a>
                </div>
		</form>
	</div>
</body>
</html>