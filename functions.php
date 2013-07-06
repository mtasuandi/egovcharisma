<?php
if(!class_exists('egovCharisma'))
{
	class egovCharisma
	{
		public function __construct()
		{
			add_filter('show_admin_bar', array($this, 'egov_hideadminbar'));
			add_action('init', array($this, 'egov_outputbuffer'));
			add_action('admin_menu', array($this, 'egov_removemenu'));
		}

		public function egov_outputbuffer()
		{
			ob_start();
		}

		public function egov_hideadminbar()
		{
			return false;
		}

		public function egov_removemenu()
		{
			remove_menu_page('edit.php');
			remove_menu_page('edit-comments.php');
		}
	}
}
new egovCharisma();
?>