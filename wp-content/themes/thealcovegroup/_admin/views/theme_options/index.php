<?php include_once('header.php'); ?>

<form action='' enctype='multipart/form-data'>
	<div class='top_button'>
		<img class='save_tip' style='display: none;' src='<?php bloginfo('template_directory'); ?>/_admin/views/theme_options/images/save_tip.png' alt='' />
		<input type='submit' name='save_changes' value='' class='save_changes' />
	</div>
	<div style='clear: both;'></div>
	<div id='general_settings' class='mainTab'>
	
		<div id='theme_header' style='display: none;'>

			<h2>Website Header Details</h2>
			<?php $this->text('generic_email', 'Company Email', ''); ?>
			<?php $this->text('company_facebook', 'Company Facebook Page', ''); ?>
			<?php $this->text('company_linkedin', 'Company LinkedIn Page', ''); ?>

		</div>
        <div id='theme_footer' style='display: none;'>
       		<h2>Website Header Details</h2>
			<?php $this->textarea('footer_subscribe', 'Newsletter Subscription Message', ''); ?>
		</div>

		<div id='analytics' style='display: none;'>
			<?php $this->textarea('analytics', 'Analaytics Code', ''); ?>
		</div>

	</div>
		
	<div id='homepage_settings' style='display: none;' class='mainTab'>
    <div id='theme_homepage'>
		<?php 
			$this->select('slider_style', array(
			'full' => 'Scrolling Slider',
			'single' => 'Static/Single Item Slider',
			'off' => 'Disabled'
		),
		'Featured Slider Display'); ?>
        </div>
        <div id='theme_slider' style='display: none;'>
        <?php $this->text('slider_slides', 'Slides To Display', 'Number of slides to display. Blank defaults to 10.'); ?>
        <?php $this->text('slider_readmoremargin', 'Read More Top Margin', 'Adds a top margin to the Read More Link. Blank defaults to 5.'); ?>
		<?php 
        $this->select('slider_arrows', array(
        'style1' => 'Style 1',
        'off' => 'Disabled'
		),
		'Next/Previous Arrows'); ?>
        <?php 
        $this->select('slider_sortby', array(
        'date_asc' => 'Date (Newest First)',
        'date_desc' => 'Date (Oldest First)',
		'modified' => 'Latest Modified',
		'menu_order' => 'Menu Order Value (Lowest First)',
		'rand' => 'Random',
		),
		'Sort Slides By'); ?>
        <?php 
        $this->select('slider_autostart', array(
        'on' => 'Enabled',
        'off' => 'Disabled'
		),
		'Auto-Start Slideshow'); ?>
        <?php 
        $this->select('slider_playbutton', array(
        'style1' => 'Style 1',
        'off' => 'Disabled'
		),
		'Play/Pause Button'); ?>
        <?php 
        $this->select('slider_1', array(
        'style1' => 'Style 1',
        'off' => 'Disabled'
		),
		'Slider Item Navigation Links'); ?>
        <?php $this->text('slider_wait', 'Slider Wait Time', 'Seconds to display each slide. Blank defaults to 10.'); ?>
        <?php $this->text('slider_width', 'Override Slider Width', 'Sets a width limit to the slideshow container. Blank defaults to automatic image width'); ?>
        <?php $this->text('slider_height', 'Override Slider Height', 'Sets a height limit to the slideshow container. Blank defaults to automatic image height'); ?>
		</div>
	</div>
	<div class='reset_save'>
		<div class='reset_button'>
			<input onclick='return confirm("Click OK to reset. Any settings will be lost!");' type='submit' name='reset' value='' class='reset_btn' />
			<img class='reset_tip' style='display: none;' src='<?php bloginfo('template_directory'); ?>/_admin/views/theme_options/images/reset_tip.png' alt='' />
		</div>
		<div class='bottom_button'>
			<img class='save_tip' style='display: none;' src='<?php bloginfo('template_directory'); ?>/_admin/views/theme_options/images/save_tip.png' alt='' />
			<input type='submit' name='save_changes' value='' class='save_changes' />
		</div>
		<div style='clear: both;'></div>
	</div>
	<div style='clear: both;'></div>
</form>

<?php include_once('footer.php'); ?>