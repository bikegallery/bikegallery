<?php

    if (defined('ALLOW_INCLUDE') === false)
        die('no direct access');

	function show_donation() {
?>
        <div style="position: relative; padding: 10px; border: 1px dotted; margin: 10px; width: 240px; float: none; text-align: center;">
            <div><h3>Flattr</h3>
                <!--
                    var flattr_btn = "compact";
                -->
                <script type="text/javascript">
/* <![CDATA[ */
    (function() {
        var s = document.createElement('script'), t = document.getElementsByTagName('script')[0];
        s.type = 'text/javascript';
        s.async = true;
        s.src = 'http://api.flattr.com/js/0.6/load.js?mode=auto';
        t.parentNode.insertBefore(s, t);
    })();
/* ]]> */
                </script>
                <a class="FlattrButton" style="display:none;" href="http://www.advicio-servdesk.de/loesungen/wordpress"></a>
                <noscript>
                    <a href="http://flattr.com/thing/452924/ASD-Wordpress-Solutions" target="_blank">
                        <img src="http://api.flattr.com/button/flattr-badge-large.png" alt="Flattr this" title="Flattr this" border="0" />
                    </a>
                </noscript>
            </div>
            <div><h3>Paypal</h3>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="49GYUTXUAXK9U">
                    <input type="image" src="https://www.paypalobjects.com/de_DE/DE/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="Jetzt einfach, schnell und sicher online bezahlen  mit PayPal.">
                    <img alt="" border="0" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1">
                </form>
            </div>
        </div>
           
<?php
	}
?>

	
<div class="wrap">
    <table border="0" width="100%" align="center">
        <tr>
            <td valign="top">
                <a name="cf7recapext"></a>
                <h2><?php _e('Contact Form 7 reCAPTCHA Extension Options', 'cf7recaptcha'); ?></h2>

                <?php settings_errors(); ?>

                <form method="post" action="options.php">
                    <?php settings_fields($this->options_name . '_group'); ?>

                    <?php do_settings_sections($this->options_name . '_page'); ?>

                    <p class="submit"><input type="submit" class="button-primary" title="<?php _e('Save Options') ?>" value="<?php _e('Save Changes') ?> &raquo;" /></p>


                </form>
            </td>
            <td valign="top">
                <?php show_donation(); ?>
            </td>
        </tr>
    </table>
</div>