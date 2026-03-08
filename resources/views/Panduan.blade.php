Team:
1. Ajis Saputra Hidaya, Informatika 23
2.
3. 



data admin:
'name' => 'Admin',
'email' => 'admin1@gmail.com',
'password' => Hash::make('SayaAdmin1')

sistem mengunakan:
laravel 12
telwindcss (Versi 4.1.16)
Php (Versi 8.3.12)
Alpine js


Terbagi menjadi 4 layouts:
1. admin.blade.php : digunakan untuk tampilan admin

2. app.blade.php : digunakan pada tampilan froentend setelah login dengan menambahakan link halaman inventaris dan mengubah link login dan register (pade tampialan gust) menjadi logo user dan setting data diri.

3. auth.blade.php : Digunakan untuk tampilan login admin, login user, dan register anggota baru.

4. gust.blade.php : digunakan pada tampilan layouts sebelum masuk  mengunakan akun user dengan dibatasi fitur di headernya linkheadernya terdiri dari Beranda, Tentang, Blogs, Kontak. dan terdapat link login dan register.


fitur utama dalam sistem:
1. Mencatat dan mendata anggota uk dengan cara modern dalam sistem
2. Portofoli untuk organisasi dalam bentuk website secara profesional.
3. Menyediakan tempat untuk menampilkan blogs untuk agenda, acara, berita terbaru dalam sistem ini.
4. Pengarsipan data dokumen kedalam sistem agar lebih praktis.
5. Pengelolaan data inventaris lewat web. untuk memantau secara reallife.
6. Membuat sistem Pencatat keuangan organisasi yang simpel dan mudah.


