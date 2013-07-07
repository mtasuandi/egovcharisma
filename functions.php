<?php
if(!class_exists('egovCharisma'))
{
	class egovCharisma
	{
		public function __construct()
		{
			add_filter('show_admin_bar', array($this, 'egov_hideadminbar'));
			add_action('init', array($this, 'egov_outputbuffer'));
			add_action('admin_menu', array($this, 'egov_adminmenu'));
			add_action('admin_enqueue_scripts', array($this, 'egov_adminscripts'));
		}

		public function egov_outputbuffer()
		{
			ob_start();
		}

		public function egov_hideadminbar()
		{
			return false;
		}

		public function egov_adminmenu()
		{
			remove_menu_page('edit.php');
			remove_menu_page('edit-comments.php');

			add_submenu_page('themes.php', 'eGov Theme Options', 'eGov Theme Options', 'manage_options', 'egovtheme', array($this, 'egovthemeoptions'));
		}

		public function egovthemeoptions()
		{
			if(isset($_POST['submit']) && $_POST['submit'] == 'Save Changes')
			{
				$favicon 	= $_POST['egov_ts_favicon'];
				$logo 		= $_POST['egov_ts_logo'];

				if(!empty($favicon)){update_option('egov_ts_favicon', $favicon, 'yes');}
				if(!empty($logo)){update_option('egov_ts_logo', $logo, 'yes');}
			}
			?>
			<div class="wrap">
				<?php
					screen_icon('themes');
					$tab = isset( $_GET['tab'] ) ? $_GET['tab'] : "egovthemeoptions";
				?>
				<h2 class="nav-tab-wrapper">
					<a class="nav-tab <?php if($tab == "egovthemeoptions") echo "nav-tab-active"; ?>" href="?page=egovtheme&tab=egovthemeoptions">eGov Theme Options</a>
				</h2>
				<form action="" method="POST">
				<table class="form-table">
					<tbody>
						<tr valign="top"><th scope="row">Favicon</th>
							<td>
								<input type="text" name="egov_ts_favicon" id="egov_ts_favicon" style="width:30%" value="<?php echo get_option('egov_ts_favicon'); ?>">&nbsp;<a href="#" id="egov_ts_favicon_button" class="button action">Upload</a>
							</td>
						</tr>
						<tr valign="top"><th scope="row">Logo</th>
							<td>
								<input type="text" name="egov_ts_logo" id="egov_ts_logo" style="width:30%" value="<?php echo get_option('egov_ts_logo'); ?>">&nbsp;<a href="#" id="egov_ts_logo_button" class="button action">Upload</a>
							</td>
						</tr>
					</tbody>
				</table>
				<?php submit_button(); ?>
				</form>
			</div>
			<?php
		}

		public function egov_adminscripts()
		{
			wp_enqueue_script('jquery');
			wp_enqueue_media();
			wp_enqueue_script('egovmediaupload', get_template_directory_uri().'/js/egovmediaupload.js', array(), $wp_version, true);
		}
	}
}
new egovCharisma();
?>