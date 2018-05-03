<?php
/**
 * @package		 Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license		 GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app  = JFactory::getApplication();
$doc  = JFactory::getDocument();
$path = JURI::base(true).'/templates/'.$app->getTemplate().'/';
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

$renderer = $doc->loadRenderer('modules');
$render_options = array('style' => 'none');
$params = $app->getTemplate(true)->params;

?>
		<section class="head">
			<h2><?php echo $params->get('sitedeschead'); ?></h2>
			<div class="item">
				<p><?php echo $params->get('sitedescbody'); ?></p>
			</div>
		</section>

		<section class="logo-map-sec backcolor">
			<div class="logo-map">
				<img class="shadow" src="<?php echo $path; ?>/media/metro-logo.svg" />

				<div class="nw">
					<img src="<?php echo JURI::base(true).'/'.$params->get('logomapheadnw'); ?>" />
					<span><?php echo $params->get('logomapbodynw'); ?></span>
				</div>

				<div class="ne">
					<img src="<?php echo JURI::base(true).'/'.$params->get('logomapheadne'); ?>" />
					<span><?php echo $params->get('logomapbodyne'); ?></span>
				</div>

				<div class="sw">
					<img src="<?php echo JURI::base(true).'/'.$params->get('logomapheadsw'); ?>" />
					<span><?php echo $params->get('logomapbodysw'); ?></span>
				</div>

				<div class="se">
					<img src="<?php echo JURI::base(true).'/'.$params->get('logomapheadse'); ?>" />
					<span><?php echo $params->get('logomapbodyse'); ?></span>
				</div>
			</div>
		</section>

		<div class="cols">
		<section class="col-1 left">
			<?php echo $renderer->render('front-red-left', $render_options, null); ?>
		</section>

		<section class="col-1 right">
			<?php echo $renderer->render('front-red-right', $render_options, null); ?>
		</section>
		</div>

		<section class="blog">
			<h2>Blog</h2>
			<div class="blog-featured<?php echo $this->pageclass_sfx;?>" itemscope itemtype="http://schema.org/Blog">
			<?php $leadingcount = 0; ?>
			<?php if (!empty($this->lead_items)) : ?>
			<div class="items-leading clearfix">
				<?php foreach ($this->lead_items as &$item) : ?>
					<div class="item-leading leading-<?php echo $leadingcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?> clearfix"
						itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
						<?php
							$this->item = &$item;
							echo $this->loadTemplate('item');
						?>
					</div>
					<?php
						$leadingcount++;
					?>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
			<?php
				$introcount = (count($this->intro_items));
				$counter = 0;
			?>
			<?php if (!empty($this->intro_items)) : ?>
				<?php foreach ($this->intro_items as $key => &$item) : ?>

					<?php
					$key = ($key - $leadingcount) + 1;
					$rowcount = (((int) $key - 1) % (int) $this->columns) + 1;
					$row = $counter / $this->columns;

					if ($rowcount == 1) : ?>

					<div class="items-row cols-<?php echo (int) $this->columns;?> <?php echo 'row-' . $row; ?> row-fluid">
					<?php endif; ?>
						<div class="item column-<?php echo $rowcount;?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?> span<?php echo round((12 / $this->columns));?>"
							itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
						<?php
								$this->item = &$item;
								echo $this->loadTemplate('item');
						?>
						</div>
						<?php $counter++; ?>

						<?php if (($rowcount == $this->columns) or ($counter == $introcount)) : ?>

					</div>
					<?php endif; ?>

				<?php endforeach; ?>
			<?php endif; ?>

			</div>
		</section>

		<div class="cols">
		<section class="col-2 left">
			<?php echo $renderer->render('front-yellow-left', $render_options, null); ?>
		</section>

		<section class="col-2 right">
			<?php echo $renderer->render('front-yellow-right', $render_options, null); ?>
		</section>
		</div>

		<section class="last">
			<?php echo $renderer->render('front-blue', $render_options, null); ?>
		</section>
