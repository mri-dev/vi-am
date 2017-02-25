<form id="mailsend" class="" action="" method="post" onsubmit="return false;">
  <div class="head">
    <h2><?php echo __('Kapcsolatfelvétel', TD); ?></h2>
    <div class="sub">
      <?php echo __('Segíthetünk Önnek valamiben? Ne habozzon, vegye fel velünk a kapcsolatot!', TD); ?>
    </div>
  </div>
  <div id="remsg"></div>
  <div class="form-holder">
    <div class="inp-vezeteknev">
      <div class="fwrapper">
        <label for="vezeteknev"><?php echo __('Vezetéknév', TD); ?>*</label>
        <input type="text" name="vezeteknev" id="vezeteknev" value="<?php echo $_POST['vezeteknev']; ?>">
      </div>
    </div>
    <div class="inp-keresztnev">
      <div class="fwrapper">
        <label for="keresztnev"><?php echo __('Keresztnév', TD); ?>*</label>
        <input type="text" name="keresztnev" id="keresztnev" value="<?php echo $_POST['keresztnev']; ?>">
      </div>
    </div>
    <div class="inp-email">
      <div class="fwrapper">
        <label for="email"><?php echo __('E-mail cím', TD); ?>*</label>
        <input type="email" name="email" id="email" value="<?php echo $_POST['email']; ?>">
      </div>
    </div>
    <div class="inp-telefon">
      <div class="fwrapper">
        <label for="telefon"><?php echo __('Telefon', TD); ?></label>
        <input type="tel" name="telefon" id="telefon" value="<?php echo $_POST['telefon']; ?>">
      </div>
    </div>
    <div class="inp-subject">
      <div class="fwrapper">
        <label for="subject"><?php echo __('Üzenet témája', TD); ?>*</label>
        <input type="text" name="subject" class="" id="subject" value="<?php echo $_POST['subject']; ?>">
      </div>
    </div>
    <div class="inp-kategoria">
      <div class="fwrapper">
      <label for="kategoria"><?php echo __('Témakör', TD); ?>*</label>
      <select class="" name="kategoria" id="kategoria">
        <option value="" selected="selected"><?php echo __('-- válasszon --', TD); ?></option>
        <?php foreach (array('Ajánlatkérés', 'Információk', 'Segítségkérés', 'Túrával kapcsolatos') as $tm): ?>
          <option value="<?php echo $tm; ?>"><?php echo $tm; ?></option>
        <?php endforeach; ?>
      </select>
      </div>
    </div>
    <div class="inp-message">
      <div class="fwrapper">
        <label for="subject"><?php echo __('Az Ön üzenete', TD); ?>*</label>
        <textarea name="message"></textarea>
      </div>
    </div>
  </div>
  <div class="captcha">
    <div class="g-recaptcha" data-sitekey="<?=CAPTCHA_PUBLIC?>"></div>
  </div>
  <div class="sub-form">
    <button onclick="uzenetKuldesAJX();" id="mail-sending-btn" class="fusion-button button-flat button-round button-large button-custom button-red" type="submit"><?php echo __('Üzenet küldése', TD); ?></button>
  </div>
</form>
<script type="text/javascript">
var mail_sending_progress = 0;
var mail_sended = 0;
function uzenetKuldesAJX()
{
  if(mail_sending_progress == 0 && mail_sended == 0){
    jQuery('#mail-sending-btn').html('Küldés folyamatban <i class="fa fa-spinner fa-spin"></i>').addClass('in-progress');
    jQuery('#mailsend #remsg').html('');
    jQuery('#mailsend .missing').removeClass('missing');

    mail_sending_progress = 1;
    var mailparam  = jQuery('#mailsend').serialize();

    jQuery.post(
      '<?php echo admin_url('admin-ajax.php'); ?>?action=send_contact_message',
      mailparam,
      function(data){
        var resp = jQuery.parseJSON(data);
        if(resp.error == 0) {
          mail_sended = 1;
          jQuery('#mail-sending-btn').html('Üzenet sikeresen elküldve <i class="fa fa-check-circle"></i>').removeClass('in-progress').addClass('sended');
          jQuery('#mailsend #erremsg').text('');
        } else {
          jQuery('#mail-sending-btn').html('Üzenet küldése').removeClass('in-progress');
          mail_sending_progress = 0;
          if(resp.missing != 0 || resp.missing_elements) {
            jQuery.each(resp.missing_elements, function(i,e){
              jQuery('#mailsend #'+e).addClass('missing');
            });
          }
          jQuery('#mailsend #remsg').html('<div class="error">'+resp.msg+'</div>').css({
            'color' : 'red',
            'lineHeight': 1
          });
        }
      }
    );
  }
}
</script>
