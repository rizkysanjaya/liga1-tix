<p>Seseorang telah melakukan permintaan reset password pada email ini di halaman <?= site_url() ?>.</p>

<p>Untuk reset password gunakan code atau URL dan ikuti instruksi.</p>

<p>Code Anda: <?= $hash ?></p>

<p>Kunjungi <a href="<?= url_to('reset-password') . '?token=' . $hash ?>">Reset Form</a>.</p>

<br>

<p>ika anda tidak melakukan permintaan reset, Anda dapat mengabaikan email ini.</p>