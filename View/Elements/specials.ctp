<div class="centerModule">
	<h2 class="fade"><?php echo __('On Special'); ?></h2>
	<?php
		if(!isset($specials)) {
			$specials = Cache::read('specials', 'shop');

			if(empty($specials)) {
				$specials = ClassRegistry::init('Shop.Special')->getSpecials();
			}
		}

		foreach((array)$specials as $special) {
			echo $this->element('product', array('plugin' => 'shop', 'product' => $special));
		}

	    if($this->request->params['controller'] != 'specials') {
	    	echo $this->Html->link(
	    		'('.__('See all').')',
	    		array(
	    			'plugin' => 'shop',
	    			'controller' => 'specials',
	    			'action' => 'index'
	    		),
	    		array(
	    			'class' => 'moreLink'
	    		)
	    	);
	    }
    ?>
</div>