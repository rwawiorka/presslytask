<?php

if (!defined('_PS_VERSION_')) {
    # module validation
    exit;
}

class AdminMyTabController extends ModuleAdminController {

    public function initContent() {
        Tools::redirectAdmin($this->context->link->getAdminLink('AdminMostExpensiveOrders'));
    }
}