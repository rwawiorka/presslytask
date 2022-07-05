<?php

if (!defined('_PS_VERSION_')) {
    # module validation
    exit;

}

require_once(_PS_MODULE_DIR_.'presslytask/classes/OrdersReader.php');

class AdminWaitingOrdersController extends ModuleAdminController {

    public function __construct() {
        parent::__construct();
    }

    public function init() {
        parent::init();
    }

    public function initContent() {
        parent::initContent();
        $ordersReader = new OrdersReader();
        $waitingOrders = $ordersReader->getWaitingOrdersToPay(12); // 12 is the status of waiting orders

        $this->context->smarty->assign(array(
            'waitingOrders' => $waitingOrders
        ));
    
        $this->setTemplate('waiting_orders.tpl');
    }
}