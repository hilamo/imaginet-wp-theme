<?php
    $facebook    = get_field('facebook','option') ? get_field('facebook','option')      : '';
    $google_plus = get_field('google_plus','option') ? get_field('google_plus','option'): '';
	$linkedin    = get_field('linkedin','option') ? get_field('linkedin','option')      : '';
	$youtube     = get_field('youtube','option') ? get_field('youtube','option')        : '';
?>
<ul class="social_icons clearfix">

    <?php if($facebook):?>
        <li class="social fb">
            <a href="<?php echo $facebook;?>" title="<?php _e('Facebook','options');?>"></a>
        </li>
    <?php endif;?>

    <?php if($linkedin):?>
        <li class="social linkedin">
            <a href="<?php echo $linkedin;?>" title="<?php _e('Linkedin','options');?>"></a>
        </li>
    <?php endif;?>

    <?php if($google_plus):?>
        <li class="social gp">
            <a href="<?php echo $google_plus;?>" title="<?php _e('Google plus','options');?>"></a>
        </li>
    <?php endif;?>

    <?php if($youtube):?>
        <li class="social youtube">
            <a href="<?php echo $youtube;?>" title="<?php _e('Youtube','options');?>"></a>
        </li>
    <?php endif;?>
</ul>