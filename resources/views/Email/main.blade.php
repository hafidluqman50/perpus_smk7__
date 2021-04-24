<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="x-apple-disable-message-reformatting">
  <title></title>
  <!--[if mso]>
  <style>
    table {border-collapse:collapse;border-spacing:0;border:none;margin:0;}
    div, td {padding:0;}
    div {margin:0 !important;}
  </style>
  <noscript>
    <xml>
      <o:OfficeDocumentSettings>
        <o:PixelsPerInch>96</o:PixelsPerInch>
      </o:OfficeDocumentSettings>
    </xml>
  </noscript>
  <![endif]-->
  <style>
    table, td, div, h1, p {
      font-family: Arial, sans-serif;
    }
    @media screen and (max-width: 530px) {
      .unsub {
        display: block;
        padding: 8px;
        margin-top: 14px;
        border-radius: 6px;
        background-color: #555555;
        text-decoration: none !important;
        font-weight: bold;
      }
      .col-lge {
        max-width: 100% !important;
      }
    }
    @media screen and (min-width: 531px) {
      .col-sml {
        max-width: 27% !important;
      }
      .col-lge {
        max-width: 73% !important;
      }
    }
  </style>
</head>
<body style="margin:0;padding:0;word-spacing:normal;">
  <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#2c3e50; ">
    <table role="presentation" style="width:100%;border:none;border-spacing:0;">
      <tr>
        <td align="center" style="padding:0;">
          <!--[if mso]>
          <table role="presentation" align="center" style="width:600px;">
          <tr>
          <td>
          <![endif]-->
          <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
            <tr>
              <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                <a href="http://www.example.com/" style="text-decoration:none;"></a>
              </td>
            </tr>
            <tr>
              <td style="padding:30px;background-color:#ffffff;">
                <div style="text-align: center;">
                <img src="https://smkn7-smr.sch.id/assets/img/logo_smkn7.png" width="165" alt="Logo" style="width:80%;max-width:165px;height:auto;border:none;text-decoration:none;color:#ffffff;" draggable="false">
                </div>
                <h1 style="margin-top:0;margin-bottom:16px;font-size:26px;line-height:32px;font-weight:bold;letter-spacing:-0.02em;" align="center">PENGINGAT KEMBALIKAN BUKU</h1>
                <p style="margin:0;">Halo, <b>{{ $nama_anggota }}</b></p>
                <br>
                <p style="margin:0;">Buku <b>{{ $buku }}</b> yang kamu pinjam akan menuju deadline loh, harus dikembalikan tanggal <b>{{ date_explode($tanggal_harus_kembali) }}</b></p>
                <br>
                <p style="margin:0;">Cek list buku yang kamu pinjam ada di halaman profile, klik aja tombol ini di halaman utama</p>
                <br>
                <p style="margin:0;text-align: center;"><b>Jangan Telat Ya Kembalikan Bukunya, Nanti Kena Denda Loh</b></p>
              </td>
            </tr>
            <tr>
              <td style="padding:30px;font-size:24px;line-height:28px;font-weight:bold;background-color:#ffffff;border-bottom:1px solid #f0f0f5;border-color:rgba(201,201,207,.35);">
                <img src="{{ $message->embed(public_path().'/admin-assets/dist/ss_panduan.jpeg') }}" width="540" alt="" style="width:100%;height:auto;border:none;text-decoration:none;color:#363636;" draggable="false">
                <img src="{{ $message->embed(public_path().'/admin-assets/dist/ss_panduan_2.png') }}" width="540" alt="" style="width:100%;height:auto;border:none;text-decoration:none;color:#363636;" draggable="false">
                <img src="{{ $message->embed(public_path().'/admin-assets/dist/ss_panduan_3.png') }}" width="540" alt="" style="width:100%;height:auto;border:none;text-decoration:none;color:#363636;" draggable="false">
              </td>
            </tr>
            {{-- <tr>
              <td style="padding:30px;background-color:#ffffff;">
                <p style="margin:0;"></p>
              </td>
            </tr> --}}
            <tr>
              <td style="padding:0;font-size:24px;line-height:28px;font-weight:bold;">
              	<img src="{{ $message->embed(public_path().'/admin-assets/dist/16576.jpg') }}" width="600" alt="" style="width:100%;height:auto;display:block;border:none;text-decoration:none;color:#363636;">
              </td>
            </tr>
            <!-- <tr>
              <td style="padding:30px;background-color:#ffffff;">
                <p style="margin:0;">Duis sit amet accumsan nibh, varius tincidunt lectus. Quisque commodo, nulla ac feugiat cursus, arcu orci condimentum tellus, vel placerat libero sapien et libero. Suspendisse auctor vel orci nec finibus.</p>
              </td>
            </tr> -->
            <tr>
              <td style="padding:30px;text-align:center;font-size:12px;background-color:#f39c12;">
                <p style="margin:0;font-size:14px;line-height:20px;color:white;">&copy; RPL Programmer Team {{ date('Y') }}</p>
              </td>
            </tr>
          </table>
          <!--[if mso]>
          </td>
          </tr>
          </table>
          <![endif]-->
        </td>
      </tr>
    </table>
  </div>
</body>
</html>