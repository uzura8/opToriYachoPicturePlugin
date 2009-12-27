<div id="<?php echo $id ?>" class="dparts homeRecentList">
<div class="parts">

<div class="partsHeading">
<h3><?php echo $options['title'] ?></h3>
</div>

<div class="block">

<table>
<tbody>

<p style="text-align:center;"><a href="<?php echo $options['linkUrl']; ?>" target="_blank"><img src="<?php echo $options['imageUrl']; ?>" width="<?php echo $options['imageWidth']; ?>" style="display:none" onload="this.style.display='inline'"></a></p>
<p style="text-align:center;margin-top:10px;"><strong><a href="<?php echo $options['linkUrl']; ?>" target="_blank"><?php echo $options['toriName']; ?></a></strong></p>

<?php if (isset($options['moreInfo'])): ?>
<div class="moreInfo"><ul class="moreInfo"><li>
<!-- <?php echo link_to(__('More info'), $options['moreInfo']) ?> -->
</li></ul></div>
<?php endif; ?>

</tbody>
</table>

</div>

</div></div>
