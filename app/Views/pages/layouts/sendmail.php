<!DOCTYPE html>
<html>

<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<style type="text/css">
		body,
		table,
		td,
		a {
			-webkit-text-size-adjust: 100%;
			-ms-text-size-adjust: 100%;
		}

		table,
		td {
			mso-table-lspace: 0pt;
			mso-table-rspace: 0pt;
		}

		img {
			-ms-interpolation-mode: bicubic;
		}

		img {
			border: 0;
			height: auto;
			line-height: 100%;
			outline: none;
			text-decoration: none;
		}

		table {
			border-collapse: collapse !important;
		}

		body {
			height: 100% !important;
			margin: 0 !important;
			padding: 0 !important;
			width: 100% !important;
		}


		a[x-apple-data-detectors] {
			color: inherit !important;
			text-decoration: none !important;
			font-size: inherit !important;
			font-family: inherit !important;
			font-weight: inherit !important;
			line-height: inherit !important;
		}

		@media screen and (max-width: 480px) {
			.mobile-hide {
				display: none !important;
			}

			.mobile-center {
				text-align: center !important;
			}
		}

		div[style*="margin: 16px 0;"] {
			margin: 0 !important;
		}
	</style>

<body style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" bgcolor="#eeeeee">



	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="center" style="background-color: #eeeeee;" bgcolor="#eeeeee">

				<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
					<tr>
						<td align="center" valign="top" style="font-size:0; padding: 35px;" bgcolor="#ea3c33">

							<div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;">
								<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
									<tr>
										<td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 800; line-height: 48px;" class="mobile-center">
											<h1 style="font-size: 36px; font-weight: 800; margin: 0; color: #ffffff;">Liga1-Tix</h1>
										</td>
									</tr>
								</table>
							</div>

							<div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;" class="mobile-hide">
								<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
									<tr>
										<td align="right" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; line-height: 48px;">
											<a href="#" target="_blank" style="color: #ffffff; text-decoration: none;"><img src="https://i.ibb.co/qrn6kqV/logo-ct.png" width="60" height="60" style="display: block; border: 0px;" /></a>
										</td>
									</tr>
								</table>
							</div>

						</td>
					</tr>
					<tr>
						<td align="center" style="padding: 35px 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">
							<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
								<tr>
									<td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
										<img src="https://img.icons8.com/carbon-copy/100/000000/checked-checkbox.png" width="125" height="120" style="display: block; border: 0px;" /><br>
										<h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">
											Thank You For Your Order!
										</h2>
									</td>
								</tr>
								<tr>
									<td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
										<p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">
											Dear Customer Liga1-Tix,<br>
											Terima kasih telah menggunakan layanan kami. Silahkan lanjutkan pembayaran dengan cara transfer ke rekening berikut:
											<br>
											<br>
											Berikut Ringkasan Pembelian Anda:
										</p>
									</td>
								</tr>
								<tr>
									<td align="left" style="padding-top: 20px;">
										<table cellspacing="0" cellpadding="0" border="0" width="100%">
											<tr>
												<td width="55%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;">
													Kode Order
												</td>
												<td width="45%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;">
													<?= $sendmail->kd_order ?>
												</td>
											</tr>
											<tr>
												<td width="55%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
													Manual Transfer Nomor Rekening
												</td>
												<td width="45%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
													<?= $sendmail->no_rekening ?>
												</td>
											</tr>
											<tr>
												<td width="55%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
													Atas Nama
												</td>
												<td width="45%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
													<?= $sendmail->atas_nama ?>
												</td>
											</tr>
											<tr>
												<td width="55%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
													Bank Penerima
												</td>
												<td width="45%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
													<?= $sendmail->nama_bank ?>
												</td>
											</tr>
											<tr>
												<td width="55%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
													Nominal yang dibayarkan
												</td>
												<td width="45%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
													<?php $total = $sendmail->jml_tiket * $sendmail->harga_awal ?>
													<strong>Rp <?= number_format((float)($total), 0, ",", "."); ?></strong>
												</td>
											</tr>
											<tr>
												<td width="55%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
													Deskprisi Pembelian
												</td>
												<td width="45%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
													<strong>Kode Order <?= $sendmail->kd_order ?></strong><br>
													<strong>Tanggal Pembelian <?= hari_indo(date('N', strtotime($sendmail->tgl_order))) . ', ' . tanggal_indo(date('Y-m-d', strtotime('' . $sendmail->tgl_order))); ?></strong><br>
													<strong><?= $sendmail->jml_tiket; ?> Tiket</strong>
												</td>
											</tr>
											<tr>
												<td width="55%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
													Tanggal Beli
												</td>
												<td width="45%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
													<?= $sendmail->tgl_order ?>
												</td>
											</tr>
											<tr>
												<td width="55%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
													Expired Order
												</td>
												<td width="45%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
													<strong><?php $tgl_expired = hari_indo(date('N', strtotime($sendmail->expired))) . ', ' . tanggal_indo(date('Y-m-d', strtotime('' . $sendmail->expired . ''))) . ', ' . date('H:i', strtotime($sendmail->expired));
															echo $tgl_expired; ?></strong>
												</td>
											</tr>

										</table>
									</td>
								</tr>

							</table>

						</td>
					</tr>
					<tr>
						<td align="center" height="100%" valign="top" width="100%" style="padding: 0 35px 35px 35px; background-color: #ffffff;" bgcolor="#ffffff">
							<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:660px;">
								<tr>
									<td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
										<p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">
											Simpan bukti pembayaran ini sebagai bukti pembayaran anda. Jika anda tidak melakukan pembayaran dalam 1x24 jam, maka transaksi anda akan dibatalkan.

										</p>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td align="center" style=" padding: 35px; background-color: #ff7361;" bgcolor="#1b9ba3">
							<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
								<tr>
									<td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 20px;">
										<h2 style="font-size: 24px; font-weight: 800; line-height: 10px; color: #ffffff; margin: 0;">
											Cara Transfer Pembayaran <?= $sendmail->nama_bank ?>
										</h2>
									</td>
								</tr>
								<tr>
									<td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 20px;">
										<div class="col-md-12 col-xs-12">

											<div style="padding:10px;"></div>
											<div class="row">
												<div style="padding: 0 35px 35px 35px;">
													<div style="border:3px solid #000000;margin:2px;padding:5px; border-radius:3px;">
														<center>
															<h4>ATM</h4>
														</center>

														<ol style="padding:10;">
															<li>Panduan Bayar</li>
															<li>Pilih Menu <span class="label">Transaksi Lainnya</span></li>
															<li>Pilih <span class="label">Transfer</span></li>
															<li>Pilih <span class="label">Ke rekening <?= $sendmail->nama_bank ?> </span></li>
															<li>Input Nomor Rekening <span class="label"><?= $sendmail->no_rekening ?></span></li>
															<li>Pilih <span class="label">Benar</span></li>
															<li>Pilih <span class="label">Ya</span></li>
															<li>Ambil bukti bayar anda</li>
															<li>Selesai</li>
														</ol>
													</div>
												</div>
												<div style="padding: 0 35px 35px 35px;">
													<div style="border:3px solid #000000;margin:2px;padding:5px; border-radius:3px;">
														<center>
															<h4>MOBILE BANKING</h4>
														</center>

														<ol style="padding:10;">
															<li>Login Mobile Banking</li>
															<li>Pilih <span class="label">m-Transfer</span></li>
															<li>Pilih <span class="label"><?= $sendmail->nama_bank ?> Rekening</span></li>
															<li>Input Nomor Rekening <span class="label"><?= $sendmail->no_rekening ?></span></li>
															<li>Klik <span class="label">Send</span></li>
															<li>Informasi VA akan ditampilkan</li>
															<li>Klik <span class="label">OK</span></li>
															<li>Input <span class="label">PIN</span></li>
															<li>Mobile Banking</li>
															<li>Bukti bayar ditampilkan</li>
															<li>Selesai</li>
														</ol>
													</div>
												</div>
												<div style="padding: 0 35px 35px 35px;">
													<div style="border:3px solid #000000;margin:2px;padding:5px; border-radius:3px;">
														<center>
															<h4>INTERNET BANKING</h4>
														</center>

														<ol style="padding:10;">
															<li>Pilih <span class="label">Transaksi Dana</span></li>
															<li>Pilih <span class="label">Transfer Ke <?= $sendmail->nama_bank ?> Rekening</span></li>
															<li>Input Nomor Rekening <span class="label"><?= $sendmail->no_rekening ?></span></li>

															<li>Klik <span class="label">Lanjutkan</span></li>
															<li>Input Respon <span class="label">KeyBCA Appli 1</span></li>
															<li>Klik <span class="label">Kirim</span></li>
															<li>Bukti bayar ditampilkan</li>
															<li>Selesai</li>
														</ol>
													</div>
												</div>
											</div>
										</div>
									</td>

							</table>
						</td>
					</tr>
					<tr>
						<td align="center" style="padding: 35px; background-color: #ffffff;" bgcolor="#ffffff">
							<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
								<tr>
									<td align="center">
										<img src="https://i.ibb.co/qrn6kqV/logo-ct.png" width="60" height="60" style="display: block; border: 0px;" />
									</td>
								</tr>
								<tr>
									<td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px; padding: 5px 0 10px 0;">
										<p style="font-size: 14px; font-weight: 800; line-height: 18px; color: #333333;">
											Liga1-Tix<br>
											Team
										</p>
									</td>
								</tr>
								<tr>
									<td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px;">
										<p style="font-size: 14px; font-weight: 400; line-height: 20px; color: #777777;">
											Email dikirim secara otomatis, jika Anda tidak memakai email ini tolong hubungi staff Admin <a href="#" target="_blank" style="color: #777777;">report</a>.
										</p>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

</body>

</html>