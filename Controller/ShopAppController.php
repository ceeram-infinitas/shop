<?php
	class ShopAppController extends AppController {
		public $helpers = array(
			'Shop.Shop'
		);

		public $components = array(
			'Shop.Shop'
		);

		public function beforeRender(){
			parent::beforeRender();
			$user_id = $this->Session->read('Auth.User.id');

			if(isset($this->Cart)){
				$usersCart = $this->Cart->getCartData($user_id);
			}
			else{
				$usersCart = ClassRegistry::init('Shop.Cart')->getCartData($user_id);
			}

			$this->set(compact('usersCart'));
		}

		public function beforeFilter(){
			parent::beforeFilter();
			Configure::write('Rating.time_limit', false);

			$this->addCss(
				array(
					'/shop/css/shop'
				)
			);

			$this->addJs(
				array(
					'/shop/js/shop'
				)
			);

			$this->Event->trigger('shopLoad');
			if(!$this->Session->read('Shop.shipping_method')){
				$this->Session->write('Shop.shipping_method', Configure::read('Shop.shipping_method'));
			}
			return true;
		}
	}