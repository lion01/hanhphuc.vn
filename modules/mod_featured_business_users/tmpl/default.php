<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_stats
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>

<div class="box">
	<ul class="menu-featured-users fltlft">
		<?php foreach ($list as $user): ?>
		<li class="fltlft">
			<div class="image" style="margin: 10px auto;">
				<?php
				$userLogo = $user->business_logo;
				
				if ($userLogo):
				?>
				<img src="<?php echo JURI::base(); ?>images/business/<?php echo $user->business_logo; ?>" />
				<?php else: ?>
				<img src="<?php echo JURI::base(); ?>images/no_business_logo.png" />
				<?php endif; ?>
			</div>
			<div>
				<h3>
					<a class="title" href="<?php echo JRoute::_('index.php?option=com_jnt_hanhphuc&view=services&user='.$user->id.'-'.$user->username); ?>">
						<?php echo $user->name; ?>
					</a>
				</h3>
			</div>
			<div class="clr"></div>
		</li>
		<?php endforeach; ?>
	</ul>
	<div class="clr"></div>
</div>
<div class="clr"></div>