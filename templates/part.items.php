<?php

$feedid = isset($_['feedid']) ? $_['feedid'] : '';

$itemmapper = new OCA\News\ItemMapper();
$items = $itemmapper->findAll($feedid);

echo '<ul>';
foreach($items as $item) {
	
	if($item->isRead()){
		$newsItemClass = "read";
	} else {
		$newsItemClass = "";
	}
	
	if($item->isImportant()){
		$starClass = 'important';
		$startTitle = $l->t('Mark as unimportant');
	} else {
		$starClass = '';
		$startTitle = $l->t('Mark as important');
	}

	echo '<li class="feed_item ' . $newsItemClass .'" data-id="' . $item->getId() . '" data-feedid="' . $feedid . '">';

		echo '<div class="utils">';
			echo '<ul class="primary_item_utils">';
				echo '<li class="star ' . $starClass . '" title="' . $startTitle . '"></li>';
			echo '</ul>';

			echo '<ul class="secondary_item_utils">';
				echo '<li class="keep_unread">' . $l->t('Keep unread') . '<input type="checkbox" /></li>';
			echo '</ul>';
		echo '</div>';

		echo '<h1 class="item_title"><a target="_blank" href="' . $item->getUrl() . '">' . $item->getTitle() . '</a></h1>';	

		echo '<h2 class="item_author">' . $l->t('from') . ' ' . parse_url($item->getUrl(), PHP_URL_PATH) . '</h2>';

		echo '<div class="body">' . $item->getBody() . '</div>';

	echo '</li>';

	}
echo '</ul>';
