<?php
    $facebook = get_field('facebook','option');
    $twitter  = get_field('twitter','option');
	$linkedin = get_field('linkedin','option');
	$youtube  = get_field('youtube','option');
?>
<ul class="social_icons clearfix">

    <?php if($facebook):?>
        <li class="social fb">
            <a href="<?php echo $facebook;?>" title="<?php _e('Facebook','imaginet');?>"></a>
        </li>
    <?php endif;?>

    <?php if($linkedin):?>
        <li class="social linkedin">
            <a href="<?php echo $linkedin;?>" title="<?php _e('Linkedin','imaginet');?>"></a>
        </li>
    <?php endif;?>

    <?php if($twitter):?>
        <li class="social twitter">
            <a href="<?php echo $twitter;?>" title="<?php _e('Twitter','imaginet');?>"></a>
        </li>
    <?php endif;?>

    <?php if($youtube):?>
        <li class="social youtube">
            <a href="<?php echo $youtube;?>" title="<?php _e('Youtube','imaginet');?>"></a>
        </li>
    <?php endif;?>
</ul>
