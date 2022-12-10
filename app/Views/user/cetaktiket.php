<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>E-Tiket(<?php echo $cetak[0]['kd_order']; ?>)</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inconsolata&display=swap');
    </style>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400&display=swap');
    </style>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }
    </style>
    <style type="text/css">
        ::selection {
            background-color: #E13300;
            color: white;
        }

        ::-moz-selection {
            background-color: #E13300;
            color: white;
        }

        body {
            background-color: #fff;
            margin: 40px;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
        }

        a {
            color: #003399;
            background-color: transparent;
            font-family: 'Inconsolata', monospace;

            font-weight: normal;
        }

        h1 {
            color: #444;
            background-color: transparent;
            font-family: 'Inconsolata', monospace;
            border-bottom: 1px solid #D0D0D0;
            font-size: 40px;
            font-weight: normal;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 15px;
        }

        h2 {
            color: #444;
            background-color: transparent;
            font-family: 'Inconsolata', monospace;
            border-bottom: 1px solid #D0D0D0;
            font-size: 25px;
            font-weight: normal;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 15px;
        }

        h3 {
            color: #444;
            background-color: transparent;
            font-family: 'Inconsolata', monospace;
            border-bottom: 1px solid #D0D0D0;
            font-size: 13px;
            font-weight: bold;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 15px;
        }

        #body {
            margin: 0 15px 0 15px;
        }

        p.footer {
            text-align: right;
            font-size: 11px;
            border-top: 1px solid #D0D0D0;
            line-height: 32px;
            padding: 0 10px 0 10px;
            margin: 20px 0 0 0;
        }

        #container {
            margin: 10px;
            border: 1px solid #D0D0D0;
            box-shadow: 0 0 8px #D0D0D0;
            font-family: 'Inconsolata', monospace;


        }

        li {
            font-family: 'Roboto Slab', serif;
            font-size: 18px;
        }

        img {
            float: left;
            padding-right: 10px;
        }
    </style>

</head>

<body onload="window.print()">
    <table width="100%">
        <tr style="padding: 5px;">

            <td align="right">
                <div class="code">
                    <h1>E-TICKET</h1>
                    <pre>
                <b><span>Detail Pesanan </span></b>
                <p>
                Kode Order : <?php echo $cetak[0]['kd_order']; ?> <br>
                Kode Pertandingan : <?php echo $cetak[0]['kd_pertandingan']; ?> <br>
                Tanggal Beli : <?php echo $cetak[0]['tgl_order']; ?><br> 
                Jadwal : <?php echo hari_indo(date('N', strtotime($cetak[0]['tanggal']))) . ', ' . tanggal_indo(date('Y-m-d', strtotime('' . $cetak[0]['tanggal'] . ''))); ?> <br>
                Stadion : <?php echo $cetak[0]['nama_stadion']; ?> <br>
                Alamat Stadion : <?php echo $cetak[0]['alamat_stadion']; ?></p>
                </div>
                
            </pre>
            </td>
        </tr>
    </table>
    <br />
    <table width="100%">
        <thead style="background-color: lightgray; ">
            <tr>
                <th>
                    Nomor Tiket
                </th>
                <th>
                    Email
                </th>
                <th>
                    Jumlah Tiket
                </th>
                <th align="center" colspan="2">
                    Kategori Tribun
                </th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="row">
                    <h3><?php echo $cetak[0]['kd_tiket']; ?></h3>
                </td>
                <td>
                    <h3><?php echo $cetak[0]['email']; ?></h3>
                </td>
                <td align="center">
                    <h3><?php echo $cetak[0]['jml_tiket']; ?></h3>
                </td>
                <td align="center" colspan="2">
                    <h3><?php echo $cetak[0]['tribun']; ?></h3>
                </td>


                <td align="right"></td>
            <tr>
        </tbody>
        <tfoot>

            <tr>
                <td colspan="2"></td>
                <td colspan="2" align="right">
                    <h3>Total Rp</h3>
                </td>

                <td align="right" class="gray">
                    <h3>
                        <?php $total =
                            $cetak[0]['jml_tiket'] * $cetak[0]['harga_awal'];
                        echo number_format($total) . ',-'; ?>
                    </h3>
                </td>
            </tr>
        </tfoot>
    </table>
    <div id="container">
        <h2>Syarat dan ketentuan</h2>

        <div id="body">
            <ol type="1">
                <li>Tiket yang sudah dibeli tidak dapat dipindahtangan.</li>
                <li>Tiket yang sudah dibeli tidak dapat dikembalikan.</li>
                <li>Tiket yang sudah dibeli tidak dapat ditukar dengan tiket lain.</li>
                <li>Tiket yang sudah dibeli tidak dapat ditukar dengan uang tunai.</li>
                <li>Tanggung jawab Tiket Liga1-Tix meliputi:
                    (1) Mengeluarkan tiket yang valid (tiket yang akan diterima oleh penyelenggara)
                    (2) Memberikan pengembalian dana dan dukungan jika terjadi pembatalan
                    (3) Memberikan dukungan dan informasi pelanggan jika ada penundaan /
                    kerepotan
                </li>
                <li>Saran persiapan keberangkatan menonton pertandingan :
                    (1) Wajib minimal vaksin booster
                    (2) Wajib hadir dua jam sebelum kick-off
                    (3) Wajib membawa KTP/SIM asli dan tidak boleh fotocopy atau via HP
                    (4) Wajib memakai masker, mencuci tangan, menghindari kerumunan, menjaga jarak, dan membatasi mobilitas.***</li>
            </ol>
        </div>
    </div>

</body>

</html>