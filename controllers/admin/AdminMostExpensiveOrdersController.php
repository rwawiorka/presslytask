<?php

if (!defined('_PS_VERSION_')) {
    # module validation
    exit;

}

require_once(_PS_MODULE_DIR_.'presslytask/classes/OrdersReader.php');

class AdminMostExpensiveOrdersController extends ModuleAdminController {

    public function __construct() {
        parent::__construct();
    }

    public function init() {
        parent::init();
    }

    public function initContent() {
        parent::initContent();
        $ordersReader = new OrdersReader();
        $expensiveOrders = $ordersReader->getMostExpensiveOrders();

        $this->context->smarty->assign(array(

            'expensiveOrders' => $expensiveOrders
        ));
        
        $this->setTemplate('most_expensive_orders.tpl');
    }
}