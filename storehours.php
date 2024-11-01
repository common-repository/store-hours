<?php
/*
  Plugin Name: Storehours
  Plugin URI: http://www.storehours24.com
  Description: Storehours-Widget für Deine Webseite
  Version: 1.0.0
  Author: storehours24.com
 */


if (!class_exists('WP_Offnungszeiten_Script'))
{

	class WP_Offnungszeiten_Script
	{

		public function __construct()
		{
			add_action('admin_init', array(&$this, 'admin_init'));
			add_action('admin_menu', array(&$this, 'add_menu'));
		}

		public function admin_init()
		{
			$this->init_settings();
		}

		public function init_settings()
		{
			register_setting('wp_offnungszeiten_script-group', 'widgetwo');
			register_setting('wp_offnungszeiten_script-group', 'widgetwas');
			register_setting('wp_offnungszeiten_script-group', 'titlecolor');
			register_setting('wp_offnungszeiten_script-group', 'titlebgcolor');
			register_setting('wp_offnungszeiten_script-group', 'textcolor');
			register_setting('wp_offnungszeiten_script-group', 'textbgcolor');
			register_setting('wp_offnungszeiten_script-group', 'buttoncolor');
			register_setting('wp_offnungszeiten_script-group', 'buttonbgcolor');
		}

		public function add_menu()
		{
			add_options_page('WP Öffnungszeiten Script Settings', 'WP Offnungszeiten Script', 'manage_options', 'wp_offnungszeiten_script', array(&$this, 'plugin_settings_page'));
		}

		public function plugin_settings_page()
		{
			if (!current_user_can('manage_options'))
			{
				wp_die(__('You do not have sufficient permissions to access this page.'));
			}

			include(sprintf("%s/templates/settings.php", dirname(__FILE__)));
		}

		public static function activate()
		{

		}

		public static function deactivate()
		{

		}

		public static function load_widget()
		{
			register_widget('OeffnungszeitenScriptWidget');
		}

	}

}

if (!class_exists('OeffnungszeitenScriptWidget'))
{

	class OeffnungszeitenScriptWidget extends WP_Widget
	{

		function OeffnungszeitenScriptWidget()
		{
			$widget_ops = array('classname' => 'widget_oeffnungszeiten_script',
				'description' => __("Your Store Hours Search Widget"));
			$this->WP_Widget('oeffnungszeiten_script', 'Storehours', $widget_ops);
		}

		function widget($args, $instance)
		{
			extract($args);

//			$title = apply_filters('widget_title', $instance['title']);
			# Before the widget
			echo $before_widget;
			?>
			<!-- storehours24.com -->
			<link rel="stylesheet" type="text/css" href="http://www.storehours24.com/rpc/widget/templates/style/searchwidget.css">
			<script type="text/javascript" src="http://www.storehours24.com/rpc/widget/templates/js/widgetbranding.js"></script>
			<div id="oe-searchwidget" style="background: <?php echo get_option('textbgcolor', '#C7E0FF'); ?>; color: <?php echo get_option('textcolor', '#000000'); ?>;" class="backgroundStyle">
				<div id="oe-searchwidget-title" style="background: <?php echo get_option('titlebgcolor', '#489BFF'); ?>; color: <?php echo get_option('titlecolor', '#FFFFFF'); ?>;">Find Store Hours</div>
				<iframe src="http://www.storehours24.com/rpc/widget/widget.php?wo=<?php echo urlencode(get_option('widgetwo', '')) ?>&was=<?php echo urlencode(get_option('widgetwas', '')) ?>&textcolor=<?php echo urlencode(get_option('textcolor', '#000000')) ?>&textbgcolor=<?php echo urlencode(get_option('textbgcolor', '#C7E0FF')) ?>&buttoncolor=<?php echo urlencode(get_option('buttoncolor', '#FFFFFF')) ?>&buttonbgcolor=<?php echo urlencode(get_option('buttonbgcolor', '#489BFF')) ?>" width="150" height="200" frameborder="0" style="overflow: hidden;"></iframe>
				<div id="oe-searchwidget-branding"></div>
                <script type="text/javascript">getWidgetBranding('<?php echo urlencode(get_option('widgetwo', '')) ?>', '<?php echo urlencode(get_option('widgetwas', '')) ?>', '#000000');</script>
			</div>
			<script>
function getWidgetBranding(wo, was, color) {

		var brandingtext = "";
		if(wo != "" && was == "") {
			brandingtext = 'Store Hours in <a href="http://www.storehours24.com/city/'+ucFirst(wo)+'-1.html" style="color: '+color+'; font-size: 10px;">'+ucFirst(wo)+'</a>. Storehours24.com .';
		}else if(wo == "" && was != "") {
			brandingtext = 'StoreHours '+ucFirst(was)+'. <a href="http://www.storehours24.com/" style="color: '+color+'; font-size: 10px;">Storehours24.com</a>';
		}else if(wo != "" && was != "") {
			brandingtext = '<a href="http://www.storehours24.com/search/store-'+ucFirst(wo)+'-30+km-'+ucFirst(was)+'-1.html" style="color: '+color+'; font-size: 10px;">&Ouml;ffnungszeiten '+ucFirst(was)+' in '+ucFirst(wo)+'</a>. Ein Service von &Ouml;ffnungszeitenbuch.';
		}else{
			brandingtext = 'Find Store Hours Fast! By <a href="http://www.storehours24.com/" style="color: '+color+'; font-size: 10px;">StoreHours24.com</a>.';
		}

		if(document.getElementById('oe-searchwidget-branding')) {
			document.getElementById('oe-searchwidget-branding').innerHTML = '<small>'+brandingtext+'</small>';
		}

		var widgetElement = document.getElementById('oe-searchwidget');
		var iframeElement = widgetElement.getElementsByTagName("iframe")[0];
		iframeElement.height = "200";

		return true;
	}

	function ucFirst(capitalizeMe)
	{
		return capitalizeMe[0].toUpperCase() + capitalizeMe.substring(1);
	}
			</script>
			<!-- Ende storehours24.com -->
			<?php
			# After the widget
			echo $after_widget;
		}
	}

}

function add_oeffnungszeiten_enqueue_scripts()
{
	wp_register_script('oeffnungszeiten', WP_PLUGIN_URL . '/oeffnungszeiten/templates/js/widgetColorpicker.js', array('jquery'));
	wp_register_style('oeffnungszeiten_cp', WP_PLUGIN_URL . '/oeffnungszeiten/templates/css/colorpicker.css', array());
	wp_register_style('oeffnungszeiten_style', WP_PLUGIN_URL . '/oeffnungszeiten/templates/css/style.css', array());
	wp_enqueue_script('jquery');
	wp_enqueue_script('oeffnungszeiten');
	wp_enqueue_style('oeffnungszeiten_cp');
	wp_enqueue_style('oeffnungszeiten_style');
}

if (class_exists('WP_Offnungszeiten_Script'))
{
	register_activation_hook(__FILE__, array('WP_Offnungszeiten_Script', 'activate'));
	register_deactivation_hook(__FILE__, array('WP_Offnungszeiten_Script', 'deactivate'));
	$wp_offnungszeiten_script = new WP_Offnungszeiten_Script();



	if (isset($wp_offnungszeiten_script))
	{

		// Add the settings link to the plugins page
		function plugin_settings_link($links)
		{
			$settings_link = '<a href="options-general.php?page=wp_offnungszeiten_script">Preferences</a>';
			array_unshift($links, $settings_link);
			return $links;
		}

		$plugin = plugin_basename(__FILE__);
		add_filter("plugin_action_links_$plugin", 'plugin_settings_link');
		add_action('admin_enqueue_scripts', 'add_oeffnungszeiten_enqueue_scripts');

		add_action('widgets_init', array('WP_Offnungszeiten_Script', 'load_widget'));
	}
}
?>