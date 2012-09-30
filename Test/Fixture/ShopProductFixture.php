<?php
/* ShopProduct Fixture generated on: 2010-08-17 14:08:00 : 1282055220 */
class ShopProductFixture extends CakeTestFixture {
	public $name = 'ShopProduct';

	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45),
		'slug' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'description' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'unit_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36),
		'cost' => array('type' => 'float', 'null' => false, 'default' => '0'),
		'retail' => array('type' => 'float', 'null' => false, 'default' => '0'),
		'price' => array('type' => 'float', 'null' => false, 'default' => NULL),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'image_id' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'rating' => array('type' => 'float', 'null' => true, 'default' => '0'),
		'rating_count' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'supplier_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 36),
		'deleted' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'deleted_date' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'views' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'added_to_cart' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'added_to_wishlist' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'specifications' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'sales' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $records = array(
		array(
			'id' => 1,
			'name' => 'just a spotlight',
			'slug' => 'just-a-spotlight',
			'description' => '<p>\r\n	abcsadf</p>',
			'unit_id' => 2,
			'cost' => 100,
			'retail' => 150,
			'price' => 125,
			'active' => 1,
			'image_id' => '5',
			'rating' => 3,
			'rating_count' => 1,
			'supplier_id' => 1,
			'deleted' => 0,
			'deleted_date' => '0000-00-00 00:00:00',
			'created' => '2010-04-30 00:02:21',
			'modified' => '2010-05-17 01:57:28',
			'views' => 90,
			'added_to_cart' => 6,
			'added_to_wishlist' => 3,
			'specifications' => '<p>\r\n	sdf</p>',
			'sales' => 1
		),
		array(
			'id' => 2,
			'name' => 'some cool product ',
			'slug' => 'some-cool-product',
			'description' => '<p>\r\n	We first define a default image for the $active variable, which interestingly enough needs to be the last image on the stack. This is because through absolute positioning, the last image appears on top, and we need to start with it if we want to avoid any flicker.</p>\r\n<p>\r\n	For the loop it is pretty simple: all we have to do is point the $next variable to the first image once it has gotten to the end of the line.</p>\r\n<p>\r\n	If you want to improve this function, try setting the animation speed with a variable so the main slideshow function can be thrown into the core and left alone. Also, this slideshow is easily converted to support DIV&rsquo;s instead of IMG&rsquo;s&mdash;try programming a slideshow with more content.</p>\r\n<p>\r\n	Now for a challenge: the gallery flickers when the images first load, but it can be fixed without touching the JS or markup at all. Bonus points to whoever figures it out and posts a comment.</p>',
			'unit_id' => 2,
			'cost' => 50,
			'retail' => 200,
			'price' => 150,
			'active' => 1,
			'image_id' => '11',
			'rating' => 0,
			'rating_count' => 0,
			'supplier_id' => 1,
			'deleted' => 0,
			'deleted_date' => '0000-00-00 00:00:00',
			'created' => '2010-05-04 00:59:20',
			'modified' => '2010-05-17 01:58:19',
			'views' => 172,
			'added_to_cart' => 3,
			'added_to_wishlist' => 1,
			'specifications' => '<p>\r\n	&nbsp;</p>',
			'sales' => 1
		),
		array(
			'id' => 3,
			'name' => 'product with a subcategory',
			'slug' => 'product-with-a-subcategory',
			'description' => '<p>\r\n	blaa blaa blaa</p>\r\n<p>\r\n	and lots of images</p>',
			'unit_id' => 1,
			'cost' => 123,
			'retail' => 321,
			'price' => 231,
			'active' => 1,
			'image_id' => '13',
			'rating' => 4,
			'rating_count' => 1,
			'supplier_id' => 1,
			'deleted' => 0,
			'deleted_date' => '0000-00-00 00:00:00',
			'created' => '2010-05-07 19:30:17',
			'modified' => '2010-05-17 01:58:40',
			'views' => 106,
			'added_to_cart' => 1,
			'added_to_wishlist' => 1,
			'specifications' => '<p>\r\n	&nbsp;</p>',
			'sales' => 1
		),
	);
}
?>