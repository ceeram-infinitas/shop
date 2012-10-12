<?php
	/**
	 * @brief Add some documentation for this add form.
	 *
	 * @copyright Copyright (c) 2009 Carl Sutton (dogmatic69)
	 *
	 * @link		  http://infinitas-cms.org/Shop
	 * @package	   Shop.views.add
	 * @license	   http://infinitas-cms.org/mit-license The MIT License
	 * @since 0.9b1
	 *
	 * @author dogmatic69
	 *
	 * Licensed under The MIT License
	 * Redistributions of files must retain the above copyright notice.
	 */
	echo $this->Form->create(null, array(
		'inputDefaults' => array(
			'empty' => Configure::read('Website.empty_select')
		)
	));
		echo $this->Infinitas->adminEditHead();
		echo $this->Form->input('id');
		echo $this->Form->input('ShopPrice.id');
		echo $this->Form->hidden('ShopPrice.model', array('value' => 'Shop.ShopProduct'));
		echo $this->Form->input('ShopSize.id');
		echo $this->Form->hidden('ShopSize.model', array('value' => 'Shop.ShopProduct'));
		$tabs = array(
			__d('shop', 'Product'),
			__d('shop', 'Images'),
			__d('shop', 'Supply'),
			__d('shop', 'Options'),
			__d('shop', 'Promotion')
		);

		$smallFields = array('div' => false, 'error' => false, 'label' => false);
		$shopPrice = $this->Html->tag('div', implode(array(
			$this->Form->input('ShopPrice.retail', $smallFields + array('placeholder' => __d('shop', 'Retail'))),
			$this->Form->input('ShopPrice.selling', $smallFields + array('placeholder' => __d('shop', 'Selling'))),
			$this->Form->input('ShopPrice.cost', $smallFields + array('placeholder' => __d('shop', 'Cost'))),
		)), array('class' => 'input tiny'));
		$shopSizeProduct = $this->Html->tag('div', implode(array(
			$this->Form->input('ShopSize.product_width', $smallFields + array('placeholder' => __d('shop', 'Width (mm)'))),
			$this->Form->input('ShopSize.product_length', $smallFields + array('placeholder' => __d('shop', 'Length (mm)'))),
			$this->Form->input('ShopSize.product_height', $smallFields + array('placeholder' => __d('shop', 'Height (mm)'))),
			$this->Form->input('ShopSize.product_weight', $smallFields + array('placeholder' => __d('shop', 'Weight (g)'))),
		)), array('class' => 'input tiny'));
		$shopSizeShipping = $this->Html->tag('div', implode(array(
			$this->Form->input('ShopSize.shipping_width', $smallFields + array('placeholder' => __d('shop', 'Width (mm)'))),
			$this->Form->input('ShopSize.shipping_length', $smallFields + array('placeholder' => __d('shop', 'Length (mm)'))),
			$this->Form->input('ShopSize.shipping_height', $smallFields + array('placeholder' => __d('shop', 'Height (mm)'))),
			$this->Form->input('ShopSize.shipping_weight', $smallFields + array('placeholder' => __d('shop', 'Weight (g)'))),
		)), array('class' => 'input tiny'));

		$stockForm = array();
		$i = 0;
		foreach($shopBranches as $branch) {
			$stockForm[] = $this->Html->tag('div', implode('', array(
				$this->Form->hidden('ShopBranchStock.' . $i . '.id'),
				$this->Form->hidden('ShopBranchStock.' . $i . '.shop_branch_id'),
				$this->Form->input('ShopBranchStock.' . $i . '.stock', array(
					'label' => __d(
						'shop', 'Branch: %s (%s)',
						$this->Html->link($branch['ContactBranch']['name'], array(
							'plugin' => 'shop',
							'controller' => 'shop_branches',
							'action' => 'edit',
							$branch['ShopBranch']['id']
						)), 
						$this->Html->link($branch['Manager']['full_name'], array(
							'plugin' => 'users',
							'controller' => 'users',
							'action' => 'edit',
							$branch['ShopBranch']['manager_id']
						))
					),
					'placeholder' => __d('shop', 'Stock')
				))
			)));
		}

		$contents = array(
			implode('', array(
				$this->Form->input('shop_product_type_id', array(
					'label' => __d('shop', 'Product Type'),
					'empty' => __d('shop', 'Use category type')
				)),
				$this->Form->input('name'),
				$this->Form->input('active'),
				$this->Form->input('shop_image_id', array('label' => 'Default Image')),
				$this->Infinitas->wysiwyg('ShopProduct.description'),
				$this->Infinitas->wysiwyg('ShopProduct.specifications')
			)),
			implode('', array(
				$this->Form->input('ShopImagesProduct', array(
					'options' => $shopImages,
					'multiple' => 'checkbox',
					'empty' => false
				))
			)),
			implode('', array(
				$this->Html->tag('div', implode('', array(
					$this->Form->input('shop_supplier_id', array('label' => __d('shop', 'Default Supplier'))),
					$this->Html->tag('label', __d('shop', 'Costing'), array('for' => '')) . $shopPrice,
					$this->Html->tag('label', __d('shop', 'Product Dimentions (W x L x H)'), array('for' => '')) . $shopSizeProduct,
					$this->Html->tag('label', __d('shop', 'Shipping Dimentions (W x L x H)'), array('for' => '')) . $shopSizeShipping
				)), array('class' => 'form-group')),
				$this->Html->tag('div', implode('', $stockForm), array('class' => 'form-group'))

			)),
			implode('', array(
				$this->Form->input('ShopProductOption')
			)),
			implode('', array(

			)),
		);

		echo $this->Design->tabs($tabs, $contents);
	echo $this->Form->end();