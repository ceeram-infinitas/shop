<?php
/**
 * @brief fixture file for Special tests.
 *
 * @package Shop.Fixture
 * @since 0.9b1
 */
class SpecialFixture extends CakeTestFixture {
	public $name = 'Special';

	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary'),
		'product_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36),
		'image_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36),
		'discount' => array('type' => 'float', 'null' => true, 'default' => null),
		'amount' => array('type' => 'float', 'null' => true, 'default' => null),
		'start_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'end_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'start_time' => array('type' => 'time', 'null' => false, 'default' => null),
		'end_time' => array('type' => 'time', 'null' => false, 'default' => null),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $records = array(
	);
}