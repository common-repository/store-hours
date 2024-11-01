<div class="wrap">
	<h2>StoreHours Widget for your homepage!</h2>
	<div>
            
	</div>
	<form method="post" action="options.php">
		<?php @settings_fields('wp_offnungszeiten_script-group'); ?>
		<?php @do_settings_fields('wp_offnungszeiten_script-group'); ?>
		<table width="70%" border="0">
			<tbody><tr>
                    <td>
                        <h3>1. Select a City</h3><br>
                        <input type="text" onchange="refreshWidget();" value="<?php echo get_option('widgetwo'); ?>" name="widgetwo" id="widgetwo" /> (optional)
                    </td>
                    <td>
                        <h3>2. Select searchterm</h3><br>
                        <input type="text" onchange="refreshWidget();" value="<?php echo get_option('widgetwas'); ?>" name="widgetwas" id="widgetwas" /> (optional)
                    </td>
                </tr>
            </tbody>
		</table>
		<h3>3. Choose design</h3><br>
		<table width="70%" cellspacing="10" border="0" style="padding-left: 14px;" id="widgetGenerator">
			<tbody><tr>
                    <td width="100">Color for headline</td>
                    <td><input type="text" value="<?php echo get_option('titlecolor', '#FFFFFF'); ?>" name="titlecolor" id="titlecolor" class="color_picker"></td>
                    <td><div class="colorpickerview" id="titlecolor-picker-view" style="background-color: <?php echo get_option('titlecolor', '#FFFFFF'); ?>;"></div></td>
                    <td style="vertical-align: top; padding-left: 45px;" rowspan="5">
                        <h3>Preview</h3>
                        <br>
                        <div class="backgroundStyle" style="background: #C7E0FF; color:#000000;" id="oe-searchwidget">
							<div style="background: #489BFF; color:#FFFFFF;" id="oe-searchwidget-title">Search StoreHours</div>
							<iframe width="150" height="200" frameborder="0" id="previewWidget" style="overflow: hidden;" src="http://www.storehours24.com/rpc/widget/widget.php?wo=&amp;was=&amp;textcolor=000000&amp;textbgcolor=C7E0FF&amp;buttoncolor=FFFFFF&amp;buttonbgcolor=489BFF"></iframe>
							<div id="oe-searchwidget-branding"></div>
                            <script type="text/javascript">getWidgetBranding('', '', '#000000');</script>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Backgroundcolor for headline</td>
                    <td><input type="text" value="<?php echo get_option('titlebgcolor', '#489BFF'); ?>" name="titlebgcolor" id="titlebgcolor" class="color_picker"></td>
                    <td><div class="colorpickerview" id="titlebgcolor-picker-view" style="background-color: <?php echo get_option('titlebgcolor', '#489BFF'); ?>;"></div></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Fontcolor</td>
                    <td><input type="text" value="<?php echo get_option('textcolor', '#000000'); ?>" name="textcolor" id="textcolor" class="color_picker"></td>
                    <td><div class="colorpickerview" id="textcolor-picker-view" style="background-color: <?php echo get_option('textcolor', '#000000'); ?>;"></div></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Backgroundcolor widget</td>
                    <td><input type="text" value="<?php echo get_option('textbgcolor', '#C7E0FF'); ?>" name="textbgcolor" id="textbgcolor" class="color_picker"></td>
                    <td><div class="colorpickerview" id="textbgcolor-picker-view" style="background-color: <?php echo get_option('textbgcolor', '#C7E0FF'); ?>;"></div></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Fontcolor button</td>
                    <td><input type="text" value="<?php echo get_option('buttoncolor', '#FFFFFF'); ?>" name="buttoncolor" id="buttoncolor" class="color_picker"></td>
                    <td><div class="colorpickerview" id="buttoncolor-picker-view" style="background-color: <?php echo get_option('buttoncolor', '#FFFFFF'); ?>;"></div></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Backgroundcolor button</td>
                    <td><input type="text" value="<?php echo get_option('buttonbgcolor', '#489BFF'); ?>" name="buttonbgcolor" id="buttonbgcolor" class="color_picker"></td>
                    <td><div class="colorpickerview" id="buttonbgcolor-picker-view" style="background-color: <?php echo get_option('buttonbgcolor', '#489BFF'); ?>;"></div></td>
                    <td></td>
                </tr>
            </tbody>
		</table>
		<input type="submit" value="Speichern" />
		<?php //@submit_button(); ?>
	</form>
</div>
<script type="text/javascript" src="http://www.storehours24.com/rpc/widget/templates/js/widgetbranding.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		var hideit = function(e, ui) { $(this).val('#'+ui.hex); $('.ui-colorpicker').css('display', 'none'); };
		$('.color_picker').ColorPicker({
			onChange: function(hsb, hex, rgb, el) {
				$('#'+el.id).val('#'+hex);
				$('#'+el.id+'-picker-view').css('background-color', '#'+hex);
			},
			onHide: function(el) {
				refreshWidget();
			}
		});
	});

	document.getElementById('titlecolor-picker-view').style.backgroundColor = document.getElementById('titlecolor').value;
	document.getElementById('titlebgcolor-picker-view').style.backgroundColor = document.getElementById('titlebgcolor').value;
	document.getElementById('textcolor-picker-view').style.backgroundColor = document.getElementById('textcolor').value;
	document.getElementById('textbgcolor-picker-view').style.backgroundColor = document.getElementById('textbgcolor').value;
	document.getElementById('buttoncolor-picker-view').style.backgroundColor = document.getElementById('buttoncolor').value;
	document.getElementById('buttonbgcolor-picker-view').style.backgroundColor = document.getElementById('buttonbgcolor').value;

	refreshWidget();

	function generateCode() {
		var src = regenerateURL();

		var widgetwo = document.getElementById('widgetwo').value;
		var widgetwas = document.getElementById('widgetwas').value;
		var textcolor = document.getElementById('textcolor').value;
		var textbgcolor = document.getElementById('textbgcolor').value;
		var titlecolor = document.getElementById('titlecolor').value;
		var titlebgcolor = document.getElementById('titlebgcolor').value;

		var iframeCode = '<!-- StoreHours24.com -->\r\n<link rel="stylesheet" type="text/css" href="http://www.storehours24.com/rpc/widget/templates/style/searchwidget.css">\r\n<'+'script type="text/javascript" src="http://www.storehours24.com/rpc/widget/templates/js/widgetbranding.js"></'+'script>\r\n<div id="oe-searchwidget" style="background: '+textbgcolor+'; color: '+textcolor+';" class="backgroundStyle">\r\n<div id="oe-searchwidget-title" style="background: '+titlebgcolor+'; color: '+titlecolor+';">&#xD6;ffnungszeiten suchen</div>\r\n<iframe src="'+src+'" width="150" height="200" frameborder="0" style="overflow: hidden;"></iframe>\r\n<div id="oe-searchwidget-branding"></div>\r\n</div>\r\n<!-- Ende storehours24.com -->';
	}

	function refreshWidget() {
		var src = regenerateURL();
		document.getElementById('oe-searchwidget').style.background = document.getElementById('textbgcolor').value;
		document.getElementById('oe-searchwidget').style.color = document.getElementById('textcolor').value;
		document.getElementById('oe-searchwidget-title').style.background = document.getElementById('titlebgcolor').value;
		document.getElementById('oe-searchwidget-title').style.color = document.getElementById('titlecolor').value;

		//Funktion aufrufen um Branding zu aktualisieren
		var widgetwo = document.getElementById('widgetwo').value.replace('#', '');
		var widgetwas = document.getElementById('widgetwas').value.replace('#', '');
		var textcolor = document.getElementById('textcolor').value.replace('#', '');
		getWidgetBranding(widgetwo, widgetwas, textcolor);

		document.getElementById('previewWidget').src = src;
	}

	function regenerateURL() {
		var widgetwo = document.getElementById('widgetwo').value.replace('#', '');
		var widgetwas = document.getElementById('widgetwas').value.replace('#', '');
		var textcolor = document.getElementById('textcolor').value.replace('#', '');
		var textbgcolor = document.getElementById('textbgcolor').value.replace('#', '');
		var buttoncolor = document.getElementById('buttoncolor').value.replace('#', '');
		var buttonbgcolor = document.getElementById('buttonbgcolor').value.replace('#', '');
		var url = "http://www.storehours24.com/rpc/widget/widget.php?wo="+widgetwo+"&was="+widgetwas+"&textcolor="+textcolor+"&textbgcolor="+textbgcolor+"&buttoncolor="+buttoncolor+"&buttonbgcolor="+buttonbgcolor;
		return url;
	}
</script>