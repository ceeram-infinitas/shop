<?php
/**
 * @brief fixture file for BranchesSpecial tests.
 *
 * @package Shop.Fixture
 * @since 0.9b1
 */
class BranchesSpecialFixture extends CakeTestFixture {
	public $name = 'BranchesSpecial';

	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'branch_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'special_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	public $records = array(
	);
}