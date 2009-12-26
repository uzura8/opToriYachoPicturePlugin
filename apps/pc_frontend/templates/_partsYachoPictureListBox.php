<div id="<?php echo $id ?>" class="dparts homeRecentList">
<div class="parts">

<div class="partsHeading">
<h3><?php echo $options['title'] ?></h3>
</div>

<div class="block">

<table>
<tbody>

<p><?php echo $options['toriName']; ?></p>
<p><img src="<?php echo $options['toriPicture']->url; ?>" width="200"></p>

<?php if (isset($options['moreInfo'])): ?>
<div class="moreInfo"><ul class="moreInfo"><li>
<?php echo link_to(__('More info'), $options['moreInfo']) ?>
</li></ul></div>
<?php endif; ?>

</tbody>
</table>

</div>

</div></div>
