<?php

if (!defined('_PS_VERSION_')) {
    # module validation
    exit;
}
class OrdersReader {

    /**
     * This method gets the 5 most expensive orders of all times.
     * @return array
     */
    public function getMostExpensiveOrders() {
        $db = Db::getInstance();

        $query = "SELECT CONCAT(LEFT(cu.`firstname`, 1), '. ', cu.`lastname`) AS `customer`, o.id_order, o.reference, o.total_paid_tax_incl, os.paid, osl.name AS osname, o.id_currency, cur.iso_code, o.current_state, o.id_customer, os.color, o.payment, s.name AS shop_name, o.date_add, cu.company, cl.name AS country_name, o.invoice_number, o.delivery_number, (SELECT IF(count(so.id_order) > 0, 0, 1) FROM ps_orders so WHERE (so.id_customer = o.id_customer) AND (so.id_order < o.id_order) LIMIT 1) AS new FROM ps_orders o LEFT JOIN ps_customer cu ON o.id_customer = cu.id_customer LEFT JOIN ps_currency cur ON o.id_currency = cur.id_currency INNER JOIN ps_address a ON o.id_address_delivery = a.id_address LEFT JOIN ps_order_state os ON o.current_state = os.id_order_state LEFT JOIN ps_shop s ON o.id_shop = s.id_shop INNER JOIN ps_country c ON a.id_country = c.id_country INNER JOIN ps_country_lang cl ON c.id_country = cl.id_country AND cl.id_lang = 1 LEFT JOIN ps_order_state_lang osl ON os.id_order_state = osl.id_order_state AND osl.id_lang = 1 WHERE o.`id_shop` IN ('1') GROUP BY o.id_order ORDER BY o.total_paid_tax_incl DESC LIMIT 5";

        return $db->executeS($query);
    }

    /**
     * This method gets the waiting for payment orders to be processed
     * @param int $id_order_state
     * @return array
     */
    public function getWaitingOrdersToPay($id_order_state) {

        $db = Db::getInstance();

        $query = "SELECT CONCAT(LEFT(cu.`firstname`, 1), '. ', cu.`lastname`) AS `customer`, o.id_order, o.reference, o.total_paid_tax_incl, os.paid, osl.name AS osname, o.id_currency, cur.iso_code, o.current_state, o.id_customer, cu.`id_customer` IS NULL as `deleted_customer`, os.color, o.payment, s.name AS shop_name, o.date_add, cu.company, cl.name AS country_name, o.invoice_number, o.delivery_number, (SELECT IF(count(so.id_order) > 0, 0, 1) FROM ps_orders so WHERE (so.id_customer = o.id_customer) AND (so.id_order < o.id_order) LIMIT 1) AS new FROM ps_orders o LEFT JOIN ps_customer cu ON o.id_customer = cu.id_customer LEFT JOIN ps_currency cur ON o.id_currency = cur.id_currency INNER JOIN ps_address a ON o.id_address_delivery = a.id_address LEFT JOIN ps_order_state os ON o.current_state = os.id_order_state LEFT JOIN ps_shop s ON o.id_shop = s.id_shop INNER JOIN ps_country c ON a.id_country = c.id_country INNER JOIN ps_country_lang cl ON c.id_country = cl.id_country AND cl.id_lang = 1 LEFT JOIN ps_order_state_lang osl ON os.id_order_state = osl.id_order_state AND osl.id_lang = 1 WHERE (o.`id_shop` IN ('1')) AND (os.id_order_state = $id_order_state) GROUP BY o.id_order ORDER BY o.date_add DESC";

        return $db->executeS($query);
    }
}