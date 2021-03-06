<?php
App::uses('ShopAppModel', 'Shop.Model');

/**
 * ShopListProduct Model
 *
 * @property ShopList $ShopList
 * @property ShopProductVariant $ShopProductVariant
 */

class ShopListProduct extends ShopAppModel {

/**
 * Custom find methods
 *
 * @var array
 */
	public $findMethods = array(
		'currentList' => true
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ShopList' => array(
			'className' => 'Shop.ShopList',
			'foreignKey' => 'shop_list_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ShopProductVariant' => array(
			'className' => 'Shop.ShopProductVariant',
			'foreignKey' => 'shop_product_variant_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * Constructor
 *
 * @param type $id
 * @param type $table
 * @param type $ds
 */
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);

		$this->validate = array(
			'shop_list_id' => array(
				'validateRecordExists' => array(
					'rule' => 'validateRecordExists',
					'message' => __d('shop', 'The selected list could not be found'),
					'allowEmpty' => false,
					'required' => true,
					'on' => 'create'
				),
				'validateUserList' => array(
					'rule' => 'validateUserList',
					'message' => __d('shop', 'The selected list could not be found'),
				)
			),
			'shop_product_variant_id' => array(
				'notEmpty' => array(
					'rule' => 'notEmpty',
					'message' => __d('shop', 'Please select a product to add to your list'),
					'on' => 'create',
					'required' => true
				),
				'validateRecordExists' => array(
					'rule' => 'validateRecordExists',
					'message' => __d('shop', 'The selected product does not exist')
				),
				'isUnique' => array(
					'rule' => 'isUnique',
					'message' => __d('shop', 'That product is already in your list')
				)
			),
			'quantity' => array(
				'notEmpty' => array(
					'rule' => 'notEmpty',
					'message' => __d('shop', 'Please enter the quantity you would like to purchase')
				),
				'validateQuantityAmount' => array(
					'rule' => 'validateQuantityAmount',
					'message' => __d('shop', 'The selected quantity is not valid'),
					'required' => true,
				),
				'validateStock' => array(
					'rule' => 'validateStock',
					'message' => __d('shop', 'That quantity is not available for the selected product')
				)
			)
		);
	}

/**
 * Validate that the selected list exists and belongs to the current user
 *
 * @param array $field the field being validated
 *
 * @return boolean
 */
	public function validateUserList($field) {
		return (bool)$this->ShopList->find('count', array(
			'conditions' => array(
				$this->ShopList->alias . '.' . $this->ShopList->primaryKey => current($field),
				$this->ShopList->alias . '.user_id' => $this->currentUserId()
			)
		));
	}

/**
 * Validate the order quantity
 *
 * A product as specified min / max values for orders along with the units.
 *
 * A product could be liquid and sold in multiples of 0.1 litre so 0.55 would be invalid, but 0.5 is
 * a valid amount.
 *
 * @param array $field the field being validated
 *
 * @return boolean|string
 */
	public function validateQuantityAmount($field) {
		if (empty($this->data[$this->alias]['shop_product_variant_id'])) {
			return true;
		}

		$product = $this->ShopProductVariant->ShopProduct->find('orderQuantity', array(
			'shop_product_variant_id' => $this->data[$this->alias]['shop_product_variant_id']
		));

		if (empty($product)) {
			return __d('shop', 'Unable to validate the ordered quantity');
		}

		$value = current($field);
		$field = current(array_keys($field));

		if (!$value) {
			return __d('shop', 'No quantity specifed for order');
		}

		if ($product['quantity_max'] && $value > $product['quantity_max']) {
			return __d('shop', 'The maximum purchase quantity is "%s"', $product['quantity_max']);
		}

		if ($value < $product['quantity_min']) {
			return __d('shop', 'The minimum purchase quantity is "%s"', $product['quantity_min']);
		}

		$units = $value / $product['quantity_unit'];
		if ($units != round($units)) {
			return __d('shop', 'Quantity should be in multiples of "%s"', $product['quantity_unit']);
		}

		return true;
	}

/**
 * Validate there is enough stock for the order
 *
 * @param type $field
 *
 * @return boolean
 */
	public function validateStock($field) {
		if (empty($this->data[$this->alias]['shop_product_variant_id'])) {
			return true;
		}

		return (bool)$this->ShopProductVariant->ShopBranchStock->find('totalProductStock', array(
			'shop_product_variant_id' => $this->data[$this->alias]['shop_product_variant_id']
		));
	}

/**
 * Get the contents of the currently selected list
 *
 * @param string $state
 * @param array $query
 * @param array $results
 *
 * @return array
 */
	protected function _findCurrentList($state, array $query, array $results = array()) {
		if ($state == 'before') {
			$query['fields'] = array_merge((array)$query['fields'], array(
				$this->alias . '.' . $this->primaryKey,
				$this->alias . '.quantity',

				$this->ShopProductVariant->ShopProduct->alias . '.' . $this->ShopProductVariant->ShopProduct->primaryKey,
				$this->ShopProductVariant->ShopProduct->alias . '.' . $this->ShopProductVariant->ShopProduct->displayField,
				$this->ShopProductVariant->ShopProduct->alias . '.slug',

				$this->ShopProductVariant->ShopProduct->ShopCategoriesProduct->ShopCategory->alias . '.' . $this->ShopProductVariant->ShopProduct->ShopCategoriesProduct->ShopCategory->primaryKey,
				$this->ShopProductVariant->ShopProduct->ShopCategoriesProduct->ShopCategory->alias . '.' . $this->ShopProductVariant->ShopProduct->ShopCategoriesProduct->ShopCategory->displayField,
				$this->ShopProductVariant->ShopProduct->ShopCategoriesProduct->ShopCategory->alias . '.slug',
			));

			$query['conditions'] = array_merge((array)$query['conditions'], array(
				$this->alias . '.shop_list_id' => $this->ShopList->currentListId(true)
			));

			$query['joins'][] = $this->autoJoinModel($this->ShopProductVariant->fullModelName());
			$query['joins'][] = $this->autoJoinModel(array(
				'from' => $this->ShopProductVariant->fullModelName(),
				'model' => $this->ShopProductVariant->ShopProduct->fullModelName()
			));
			$query['joins'][] = $this->autoJoinModel(array(
				'from' => $this->ShopProductVariant->ShopProduct->fullModelName(),
				'model' => $this->ShopProductVariant->ShopProduct->ShopCategoriesProduct->fullModelName()
			));
			$query['joins'][] = $this->autoJoinModel(array(
				'from' => $this->ShopProductVariant->ShopProduct->ShopCategoriesProduct->fullModelName(),
				'model' => $this->ShopProductVariant->ShopProduct->ShopCategoriesProduct->ShopCategory->fullModelName()
			));
			return $query;
		}

		if (empty($results)) {
			return array();
		}

		$shopListProductIds = Hash::extract($results, '{n}.' . $this->alias . '.' . $this->primaryKey);
		foreach ($results as &$result) {
			$extractTemplate = sprintf('{n}[shop_list_product_id=%s]', $result[$this->alias][$this->primaryKey]);
		}

		return $results;
	}

/**
 * Add a product to a list, If no list is specified the default will be used
 *
 * @param array $product the product to add to the cart
 *
 * @return boolean
 */
	public function addToList($product) {
		if (empty($product[$this->alias]['shop_list_id'])) {
			$product[$this->alias]['shop_list_id'] = $this->ShopList->currentListId(true);
		}

		$this->transaction();
		$this->create();
		if (!$this->save($product[$this->alias])) {
			$this->transaction(false);
			return false;
		}

		$this->transaction(true);
		return $this->id;
	}

/**
 * Update the contents of a list
 *
 * @param array $listProducts the products to update
 *
 * @return boolean
 */
	public function updateListProducts(array $listProducts) {
		$updated = true;
		$this->transaction();
		foreach ($listProducts as $product) {
			$updated = (bool)$this->save(array(
				$this->primaryKey => $product[$this->primaryKey],
				'quantity' => $product['quantity']
			));

			if (!$updated) {
				var_dump($this->validationErrors);
				exit;
				break;
			}
		}

		if ($updated) {
			$this->transaction(true);
			return true;
		}

		$this->transaction(false);
		return false;
	}

/**
 * Delete a product from a list
 *
 * @param string $id
 * @param boolean $cascade
 *
 * @return boolean
 */
	public function delete($id = null, $cascade = true) {
		if (AuthComponent::user('group_id') !== 1) {
			$this->recursive = 0;
			$id = $this->field($this->primaryKey, array(
				$this->alias . '.' . $this->primaryKey => $id,
				$this->ShopList->alias . '.user_id' => $this->currentUserId(),
			));
		}

		return parent::delete($id, $cascade);
	}
}