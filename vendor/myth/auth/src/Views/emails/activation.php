<p>Ini adalah email untuk mengaktivasi akun pada laman <?= site_url() ?>.</p>

<p>Untuk mengaktivasi akun Anda kunjungi URL berikut.</p>

<p><a href="<?= url_to('activate-account') . '?token=' . $hash ?>">Aktivasi akun</a>.</p>

<br>

<p>Jika anda tidak mendaftar di website ini, Anda dapat mengabaikan email ini.</p>