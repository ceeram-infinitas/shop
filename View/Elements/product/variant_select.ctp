<?php
$options = array();
foreach ($shopProduct['ShopProductVariant'] as $k => &$variant) {
	if (count($variant['ShopOptionVariant']) < 2) {
		if (empty($variant['ShopOptionVariant'][0])) {
			continue;
		}
		$options[] = $variant['ShopOptionVariant'][0]['ShopOptionValue']['name'];
	} else {
		/*foreach ($variant['ShopOptionVariant'] as $option) {
			$rows[] = $this->Html->tag('dt', $option['ShopOption']['name']);
			$rows[] = $this->Html->tag('dd', $option['ShopOptionValue']['name']);
		}
		$this->Html->tag('dl', implode('', $rows), array('class' => 'dl-horizontal'));*/
	}
}

$formInput = 'ShopProductVariant.' . $k;
echo $this->Form->input($formInput . '.id', array(
	'div' => false,
	'label' => __d('shop', 'Variant'),
	'options' => $options,
	'empty' => Configure::read('Website.empty_select')
));
echo $this->Form->input($formInput . '.quantity', array(
	'value' => $shopProduct['ShopProduct']['quantity_min'],
	'class' => 'quantity',
	'div' => false,
	'label' => false,
	'type' => 'number',
	'step' => $shopProduct['ShopProduct']['quantity_unit'],
	'min' => $shopProduct['ShopProduct']['quantity_min'],
	'max' => $shopProduct['ShopProduct']['quantity_max'],
));
echo $this->Html->tag('hr');
echo $this->Form->button(__d('shop', 'Add to cart'), array(
	'class' => 'pull-right btn btn-small add-to-cart'
));
