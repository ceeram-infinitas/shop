<?php
    /**
     * Shop suppliers add/edit
     *
     * This page is used to add/edit suppliers for your products.
     *
     * Copyright (c) 2009 Carl Sutton ( dogmatic69 )
     *
     * Licensed under The MIT License
     * Redistributions of files must retain the above copyright notice.
     *
     * @filesource
     * @copyright     Copyright (c) 2009 Carl Sutton ( dogmatic69 )
     * @link          http://infinitas-cms.org
     * @package       shop
     * @subpackage    shop.views.suppliers.form
     * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
     * @since 0.8a
     */

    echo $this->Form->create('Product', array('type' => 'file'));
        echo $this->Infinitas->adminEditHead();
        	?>
				<div class="data">
					<?php
						echo $this->Form->input('id');
						echo $this->Form->input('name', array('class' => 'title'));
						echo $this->Shop->wysiwyg('Product.description');
						echo $this->Shop->wysiwyg('Product.specifications');
					?>
				</div>
				<div class="config">
					<?php
						?><h2><?php echo __d('shop', 'Config'); ?></h2><?php
						echo $this->Form->input('supplier_id', array('empty' => __d('shop', Configure::read('Website.empty_select'))));
						echo $this->Form->input('ShopBranch');
						echo $this->Form->input('active');

						?><h2><?php echo __d('shop', 'Pricing'); ?></h2><?php
						echo $this->Form->input('cost', array('before' => Configure::read('Currency.unit'),'title' => __d('shop', 'Cost :: This is the price that you pay for the item')));
						echo $this->Form->input('retail', array('before' => Configure::read('Currency.unit'), 'title' => __d('shop', 'Retail :: This is the going rate of the item in other stores')));
						echo $this->Form->input('price', array('before' => Configure::read('Currency.unit'), 'title' => __d('shop', 'Price :: This is your selling price')));
						echo $this->Form->input('unit_id', array('title' => __d('shop', 'Unit :: The unit that the product is sold in [eg: ounces]')));

						?><h2><?php echo __d('shop', 'Categories'); ?></h2><?php
						echo $this->Form->input('ShopCategory', array('label' => false, 'multiple' =>  'checkbox', 'style' => 'clear:both;'));

						?><h2><?php echo __d('shop', 'Images'); ?></h2><?php
						echo $this->Form->input('Image.image', array('label' => __d('shop', 'New Main Image'), 'type' => 'file'));
						echo $this->Form->input('image_id', array('label' => __d('shop', 'Exsisting Main Image'), 'empty' => __d('shop', Configure::read('Website.empty_select'))));
						echo $this->Form->input('ProductImage', array('options' => $images, 'multiple' => true));
					?>
				</div>
			<?php
    echo $this->Form->end();
?>