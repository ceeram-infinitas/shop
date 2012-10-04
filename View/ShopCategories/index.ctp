<?php
	$back['url'] = array(
		'plugin' => 'shop',
		'controller' => 'categories',
		'action' => 'index'
	);
	$back['category'] = __d('shop', 'Index');
	if(!empty($currentCategory['ShopCategory']['id'])) {
		$currentCategory['ShopCategory']['plugin'] = 'shop';
		$currentCategory['ShopCategory']['controller'] = 'categories';
		$currentCategory['ShopCategory']['action'] = 'index';
		$currentCategory['ShopCategory']['parent_id'] = $currentCategory['ShopCategory']['id'];
		$eventData = $this->Event->trigger('Shop.slugUrl', array('type' => 'categories', 'data' => $currentCategory['ShopCategory']));

		$back['url'] = current($eventData['slugUrl']);
		$back['category'] = $currentCategory['ShopCategory']['name'];
	}

	echo $this->Html->link(
		sprintf(__d('shop', 'Back to %s'), $back['category']),
		$back['url'],
		array(
			'class' => 'categoryBack'
		)
	);

	if(!empty($categories)) {
		$categoryName = isset($currentCategory['ShopCategory']['name']) ? $currentCategory['ShopCategory']['name'] : __d('shop', 'All Categories');
		?>
			<div>
				<h2 class="fade"><?php echo sprintf('%s (%s)',__d('shop', 'Categories'), $categoryName); ?></h2><?php
				foreach($categories as $category) {
					echo $this->element('category', array('plugin' => 'shop', 'category' => $category));
				} ?>
			</div><div class="clear"> </div>
		<?php
	}
	if(!empty($products)) {
		?>
			<div>
				<h2 class="fade"><?php echo __d('shop', 'Products'); ?></h2><?php
					foreach($products as $product) {
						echo $this->element('product', array('plugin' => 'shop', 'product' => $product));
					}

					$slug = isset($product['ShopCategory'][0]['slug']) ? $product['ShopCategory'][0]['slug'] : 'missing-category';
					$id   = isset($product['ShopCategory'][0]['id']) ? $product['ShopCategory'][0]['id'] : 'missing-category';
			    	echo $this->Html->link(
			    		'('.__d('shop', 'See all').')',
			    		array(
			    			'plugin' => 'shop',
			    			'controller' => 'products',
			    			'action' => 'index',
			    			'category' => $slug,
							'category_id' => $id
			    		),
			    		array(
			    			'class' => 'moreLink'
			    		)
			    	); ?>
			</div>
		<?php
	}
?>