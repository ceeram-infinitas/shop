<?php
/**
 * ShopProductTypeFixture
 *
 * @package Shop.Test.Fixture
 * @since 0.9b1
 */

class ShopProductTypeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'slug' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 'general',
			'name' => 'general',
			'slug' => 'general',
			'active' => 1,
			'created' => '2012-10-06 23:30:18',
			'modified' => '2012-10-06 23:30:18'
		),
		array(
			'id' => 'shirts',
			'name' => 'shirts',
			'slug' => 'shirts',
			'active' => 1,
			'created' => '2012-10-06 23:30:18',
			'modified' => '2012-10-06 23:30:18'
		),
		array(
			'id' => 'shoes',
			'name' => 'shoes',
			'slug' => 'shoes',
			'active' => 1,
			'created' => '2012-10-06 23:30:18',
			'modified' => '2012-10-06 23:30:18'
		),
		array(
			'id' => 'complex-options',
			'name' => 'complex-options',
			'slug' => 'complex-options',
			'active' => 1,
			'created' => '2012-10-06 23:30:18',
			'modified' => '2012-10-06 23:30:18'
		),
	);

}
