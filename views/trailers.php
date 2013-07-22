<?php 
	function videolink($key, $label, $data, $list){
		if (!isset($data[$key])) return;
		if($key == 'youtube'){
			$list[] = ViewHelper::link('http://youtu.be/' . $data[$key], $label);
		} else if($key == 'vimeo'){
			$list[] = ViewHelper::link('https://vimeo.com/' . $data[$key], $label);
		} else {
			$list[] = ViewHelper::link('trailers/' . $data[$key], $label);
		}
	}
?>
<div id="trailers" class="twelve columns">
	<h2>Videos</h2>
	<?php 
	$count = 0;
	foreach($trailers as $trailer){
		$links = array();
		videolink('youtube', ViewHelper::icon('youtube-play'), $trailer, $links);
		videolink('vimeo', ViewHelper::icon('play-sign'), $trailer, $links);
		videolink('mov', ViewHelper::icon('download'), $trailer, $links);
		videolink('mp4', ViewHelper::icon('download'), $trailer, $links);

		$isodd = sizeof($trailers) % 2 == 1;
		$class = 'six columns '. ViewHelper::alphaomega($count, $isodd);

		if ($count == 0 && $isodd) $class = 'twelve columns alpha omega';
		?>

		<div class="video six columns <?php echo $class; ?>">
			<ul class="videolinks">
				<?php foreach($links as $link): ?>
					<li><?php echo $link; ?></li>
				<?php endforeach; ?>
			</ul>
			<?php if(isset($trailer['name'])): ?>
				<p><?php echo $trailer['name']; ?></p>
			<?php endif; ?>

			<div class="widescreen">
				<?php if(isset($trailer['youtube'])): ?>
					<iframe src="http://www.youtube.com/embed/<?php echo $trailer['youtube'] ?>?autohide=1&amp;hd=1&amp;controls=1&amp;modestbranding=1&amp;rel=0&amp;showinfo=1&amp;allowfullscreen" allowfullscreen></iframe>
				<?php elseif (isset($trailer['vimeo'])): ?>
					<iframe src="http://player.vimeo.com/video/'<?php echo $trailer['vimeo'] ?>" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				<?php endif; ?>
			</div>
		</div>

		<?php
		$count++;
	}
	?>
</div>

<hr class="twelve columns" />