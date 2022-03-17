<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
    <span class="preheader">@lang('email.preheader', @lang('email.name'))</span>
    <table align="center" cellpadding="0" cellspacing="0" width="95%">
      <tr>
        <td align="center">
          <table class="logo" align="center" cellpadding="0" cellspacing="0" width="600" bgcolor="#fff">
            <tr>
              <td class="logo-td" align="center">
                <a href="{{ route('home') }}" target="_blank">
                  <img src="https://i.imgur.com/Q48s77d.png"/>
                </a>
              </td>
            </tr>
            <tr>
              <td bgcolor="#fff">
                <table cellpadding="0" cellspacing="0" width="100%%">
                  <tr>
                    <td class="title-td">
                      Reset Password Akun <?= $json['title'] ;?>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#fff">
                <table cellpadding="0" cellspacing="0" width="100%%">
                  <tr>
                    <td class="pad-0">
                      Sistem kami mendeteksi bahwa anda meminta reset password. Mohon konfirmasi email ini untuk reset password akun <?= $json['title'] ;?> Anda.
                    </td>
                  </tr>
                  <tr>
                    <td class="link-td">
                      <a href="<?= base_url() ;?>/forgetpassword/forget_password?token=<?= $data_peserta['reset_hash'] ;?>" class="goto-link">
                        Reset Password
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="pad-0">
                      Harap dicatat, tautan reset password Anda bersifat sementara dan akan kedaluwarsa dalam <strong><?= $time_expired ;?> menit</strong>.
                    </td>
                  </tr>
                  <tr>
                    <td class="leave-td">
                      Bukan Anda? Abaikan saja email ini.
                    </td>
                  </tr>
                  <tr>
                    <td class="regards">
                      Regards,
                      <p><?= $json['title'] ;?></p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <!-- END CENTERED WHITE CONTAINER -->
    </table>

    <!-- START FOOTER -->
    <div class="footer">
      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">       
        <tr>
          <td class="powered-by" valign="top" align="center">
            <img src="https://i.imgur.com/Ix1TcfO.png" />
          </td>
        </tr>
        <tr>
          <td class="content-block" valign="top" align="center">
          <span class="address">Company Inc, 3 Abbey Road, San Francisco CA 94102</span>
        </tr>
      </table>
    </div>
    <!-- END FOOTER -->
  </body>
</html>
