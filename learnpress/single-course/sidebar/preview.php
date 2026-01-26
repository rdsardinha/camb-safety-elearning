<?php
/**
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.1
 */

defined('ABSPATH') || exit;
?>

<div class="course-sidebar-preview lp-course-preview">
	<div class="media-preview">
		<?php
		LearnPress::instance()->template('course')->course_media_preview();
		learn_press_get_template('loop/course/badge-featured');
		?>
	</div>

	<?php

	// Progress
	LearnPress::instance()->template('course')->user_progress();

	?>

	<div class="course-meta__pull-left">

		<?php
		/**
		 * LP Hook
		 */
		do_action('learn-press/course-meta-secondary-left');
		?>

	</div>

	<?php

	// Buttons
	LearnPress::instance()->template('course')->course_buttons();
	?>
</div>