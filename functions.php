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
			add_action('add_meta_boxes', array($this, 'egov_metabox'));
			add_action('save_post', array($this, 'egov_save_postmeta'));
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
								<input type="text" name="egov_ts_favicon" id="egov_ts_favicon" style="width:30%" value="<?php echo get_option('egov_ts_favicon'); ?>">&nbsp;<a href="#" style="text-decoration:none" id="egov_ts_favicon_button" class="button action">Upload</a>
							</td>
						</tr>
						<tr valign="top"><th scope="row">Logo</th>
							<td>
								<input type="text" name="egov_ts_logo" id="egov_ts_logo" style="width:30%" value="<?php echo get_option('egov_ts_logo'); ?>">&nbsp;<a href="#" style="text-decoration:none" id="egov_ts_logo_button" class="button action">Upload</a>
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
			wp_enqueue_style('egoviconsmetabox', get_template_directory_uri().'/css/egoviconsmetabox.css', false, 'screen');

			wp_enqueue_script('jquery');
			wp_enqueue_media();
			wp_enqueue_script('egovmediaupload', get_template_directory_uri().'/js/egovmediaupload.js', array(), $wp_version, true);
		}

		public function egov_metabox()
		{
			add_meta_box('egov-custom-iconpage', 'Menu Icon', array(&$this, 'egov_metabox_page'), 'page', 'normal', 'high' );
		}

		public function egov_metabox_page($post)
		{
			?>
			<script type="text/javascript">
			function egovSetIcon(iconclass){
				jQuery("#egov_pageiconmeta").val(iconclass);
				jQuery(".egov_selectedicon").html('<i class="'+iconclass+'"</i>');
				return false;
			}
			</script>
			<style type="text/css">
			i{
				cursor: pointer;
			}
			</style>
			<input type="hidden" name="egov_pageiconmeta" id="egov_pageiconmeta" value="">
			Selected icon:
			<span class="egov_selectedicon">
				<i class="<?php echo get_post_meta( $post->ID, 'egov_page_menu_icon', true ); ?>"></i>
			</span>
			<p/>
			<div class="row-fluid bs-icons">
				<div class="span3">
				  <ul class="the-icons">
					<li><i class="icon-glass" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-glass</li>
					<li><i class="icon-music" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-music</li>
					<li><i class="icon-search" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-search</li>
					<li><i class="icon-envelope" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-envelope</li>
					<li><i class="icon-heart" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-heart</li>
					<li><i class="icon-star" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-star</li>
					<li><i class="icon-star-empty" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-star-empty</li>
					<li><i class="icon-user" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-user</li>
					<li><i class="icon-film" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-film</li>
					<li><i class="icon-th-large" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-th-large</li>
					<li><i class="icon-th" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-th</li>
					<li><i class="icon-th-list" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-th-list</li>
					<li><i class="icon-ok" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-ok</li>
					<li><i class="icon-remove" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-remove</li>
					<li><i class="icon-zoom-in" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-zoom-in</li>
					<li><i class="icon-zoom-out" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-zoom-out</li>
					<li><i class="icon-off" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-off</li>
					<li><i class="icon-signal" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-signal</li>
					<li><i class="icon-cog" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-cog</li>
					<li><i class="icon-trash" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-trash</li>
					<li><i class="icon-home" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-home</li>
					<li><i class="icon-file" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-file</li>
					<li><i class="icon-time" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-time</li>
					<li><i class="icon-road" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-road</li>
					<li><i class="icon-download-alt" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-download-alt</li>
					<li><i class="icon-download" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-download</li>
					<li><i class="icon-upload" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-upload</li>
					<li><i class="icon-inbox" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-inbox</li>
					<li><i class="icon-play-circle" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-play-circle</li>
					<li><i class="icon-repeat" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-repeat</li>
					<li><i class="icon-refresh" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-refresh</li>
					<li><i class="icon-list-alt" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-list-alt</li>
					<li><i class="icon-lock" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-lock</li>
					<li><i class="icon-flag" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-flag</li>
					<li><i class="icon-headphones" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-headphones</li>
				  </ul>
				</div>
				<div class="span3">
				  <ul class="the-icons">
					<li><i class="icon-volume-off" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-volume-off</li>
					<li><i class="icon-volume-down" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-volume-down</li>
					<li><i class="icon-volume-up" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-volume-up</li>
					<li><i class="icon-qrcode" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-qrcode</li>
					<li><i class="icon-barcode" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-barcode</li>
					<li><i class="icon-tag" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-tag</li>
					<li><i class="icon-tags" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-tags</li>
					<li><i class="icon-book" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-book</li>
					<li><i class="icon-bookmark" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-bookmark</li>
					<li><i class="icon-print" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-print</li>
					<li><i class="icon-camera" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-camera</li>
					<li><i class="icon-font" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-font</li>
					<li><i class="icon-bold" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-bold</li>
					<li><i class="icon-italic" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-italic</li>
					<li><i class="icon-text-height" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-text-height</li>
					<li><i class="icon-text-width" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-text-width</li>
					<li><i class="icon-align-left" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-align-left</li>
					<li><i class="icon-align-center" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-align-center</li>
					<li><i class="icon-align-right" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-align-right</li>
					<li><i class="icon-align-justify" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-align-justify</li>
					<li><i class="icon-list" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-list</li>
					<li><i class="icon-indent-left" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-indent-left</li>
					<li><i class="icon-indent-right" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-indent-right</li>
					<li><i class="icon-facetime-video" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-facetime-video</li>
					<li><i class="icon-picture" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-picture</li>
					<li><i class="icon-pencil" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-pencil</li>
					<li><i class="icon-map-marker" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-map-marker</li>
					<li><i class="icon-adjust" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-adjust</li>
					<li><i class="icon-tint" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-tint</li>
					<li><i class="icon-edit" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-edit</li>
					<li><i class="icon-share" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-share</li>
					<li><i class="icon-check" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-check</li>
					<li><i class="icon-move" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-move</li>
					<li><i class="icon-step-backward" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-step-backward</li>
					<li><i class="icon-fast-backward" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-fast-backward</li>
				  </ul>
				</div>
				<div class="span3">
				  <ul class="the-icons">
					<li><i class="icon-backward" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-backward</li>
					<li><i class="icon-play" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-play</li>
					<li><i class="icon-pause" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-pause</li>
					<li><i class="icon-stop" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-stop</li>
					<li><i class="icon-forward" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-forward</li>
					<li><i class="icon-fast-forward" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-fast-forward</li>
					<li><i class="icon-step-forward" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-step-forward</li>
					<li><i class="icon-eject" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-eject</li>
					<li><i class="icon-chevron-left" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-chevron-left</li>
					<li><i class="icon-chevron-right" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-chevron-right</li>
					<li><i class="icon-plus-sign" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-plus-sign</li>
					<li><i class="icon-minus-sign" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-minus-sign</li>
					<li><i class="icon-remove-sign" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-remove-sign</li>
					<li><i class="icon-ok-sign" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-ok-sign</li>
					<li><i class="icon-question-sign" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-question-sign</li>
					<li><i class="icon-info-sign" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-info-sign</li>
					<li><i class="icon-screenshot" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-screenshot</li>
					<li><i class="icon-remove-circle" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-remove-circle</li>
					<li><i class="icon-ok-circle" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-ok-circle</li>
					<li><i class="icon-ban-circle" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-ban-circle</li>
					<li><i class="icon-arrow-left" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-arrow-left</li>
					<li><i class="icon-arrow-right" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-arrow-right</li>
					<li><i class="icon-arrow-up" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-arrow-up</li>
					<li><i class="icon-arrow-down" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-arrow-down</li>
					<li><i class="icon-share-alt" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-share-alt</li>
					<li><i class="icon-resize-full" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-resize-full</li>
					<li><i class="icon-resize-small" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-resize-small</li>
					<li><i class="icon-plus" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-plus</li>
					<li><i class="icon-minus" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-minus</li>
					<li><i class="icon-asterisk" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-asterisk</li>
					<li><i class="icon-exclamation-sign" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-exclamation-sign</li>
					<li><i class="icon-gift" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-gift</li>
					<li><i class="icon-leaf" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-leaf</li>
					<li><i class="icon-fire" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-fire</li>
					<li><i class="icon-eye-open" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-eye-open</li>
				  </ul>
				</div>
				<div class="span3">
				  <ul class="the-icons">
					<li><i class="icon-eye-close" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-eye-close</li>
					<li><i class="icon-warning-sign" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-warning-sign</li>
					<li><i class="icon-plane" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-plane</li>
					<li><i class="icon-calendar" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-calendar</li>
					<li><i class="icon-random" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-random</li>
					<li><i class="icon-comment" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-comment</li>
					<li><i class="icon-magnet" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-magnet</li>
					<li><i class="icon-chevron-up" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-chevron-up</li>
					<li><i class="icon-chevron-down" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-chevron-down</li>
					<li><i class="icon-retweet" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-retweet</li>
					<li><i class="icon-shopping-cart" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-shopping-cart</li>
					<li><i class="icon-folder-close" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-folder-close</li>
					<li><i class="icon-folder-open" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-folder-open</li>
					<li><i class="icon-resize-vertical" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-resize-vertical</li>
					<li><i class="icon-resize-horizontal" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-resize-horizontal</li>
					<li><i class="icon-hdd" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-hdd</li>
					<li><i class="icon-bullhorn" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-bullhorn</li>
					<li><i class="icon-bell" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-bell</li>
					<li><i class="icon-certificate" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-certificate</li>
					<li><i class="icon-thumbs-up" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-thumbs-up</li>
					<li><i class="icon-thumbs-down" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-thumbs-down</li>
					<li><i class="icon-hand-right" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-hand-right</li>
					<li><i class="icon-hand-left" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-hand-left</li>
					<li><i class="icon-hand-up" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-hand-up</li>
					<li><i class="icon-hand-down" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-hand-down</li>
					<li><i class="icon-circle-arrow-right" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-circle-arrow-right</li>
					<li><i class="icon-circle-arrow-left" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-circle-arrow-left</li>
					<li><i class="icon-circle-arrow-up" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-circle-arrow-up</li>
					<li><i class="icon-circle-arrow-down" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-circle-arrow-down</li>
					<li><i class="icon-globe" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-globe</li>
					<li><i class="icon-wrench" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-wrench</li>
					<li><i class="icon-tasks" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-tasks</li>
					<li><i class="icon-filter" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-filter</li>
					<li><i class="icon-briefcase" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-briefcase</li>
					<li><i class="icon-fullscreen" onClick="egovSetIcon(jQuery(this).attr('class'))"></i> icon-fullscreen</li>
				  </ul>
				</div>
			</div>
			<?php
		}

		public function egov_save_postmeta($post_id)
		{
			if ( ! current_user_can( 'edit_page', $post_id ) )
				return;

			$icons = sanitize_text_field( $_POST['egov_pageiconmeta'] );

			if ( !add_post_meta( $post_id, 'egov_page_menu_icon', $icons, true ) ) {
				update_post_meta( $post_id, 'egov_page_menu_icon', $icons );
			}
		}
	}
}
new egovCharisma();
?>