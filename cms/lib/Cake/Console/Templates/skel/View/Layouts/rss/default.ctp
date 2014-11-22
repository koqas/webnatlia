<?php
<<<<<<< HEAD
if (!isset($channel)) {
	$channel = array();
}
if (!isset($channel['title'])) {
	$channel['title'] = $title_for_layout;
}
=======
if (!isset($channel)):
	$channel = array();
endif;
if (!isset($channel['title'])):
	$channel['title'] = $title_for_layout;
endif;
>>>>>>> 514c7aff6f8d3335089b89706e5a9e4fdf2f54c6

echo $this->Rss->document(
	$this->Rss->channel(
		array(), $channel, $this->fetch('content')
	)
);
<<<<<<< HEAD
?>
=======
>>>>>>> 514c7aff6f8d3335089b89706e5a9e4fdf2f54c6
