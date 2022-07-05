<?php
/**
*
*  @author    Rafał Wawiórka
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class Presslytask extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'presslytask';
        $this->tab = 'analytics_stats';
        $this->version = '1.0.0';
        $this->author = 'Rafał Wawiórka';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Pressly Task');
        $this->description = $this->l('Pressly interview task');

        $this->confirmUninstall = $this->l('Do you want to uninstall this module?');

        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
    }

    public function install()
    {
        return parent::install() &&
            $this->installMainTab() &&
            $this->installTab('AdminMostExpensiveOrders') &&
            $this->installTab('AdminWaitingOrders');
    }

    public function uninstall()
    {
        return $this->uninstallTab('AdminMostExpensiveOrders') &&
            $this->uninstallTab('AdminWaitingOrders') &&
            $this->uninstallMainTab() &&
            parent::uninstall();
    }

    public function enable($force_all = false)
    {
        return parent::enable($force_all) &&
            $this->installMainTab() &&
            $this->installTab('AdminMostExpensiveOrders') &&
            $this->installTab('AdminWaitingOrders');
    }

    public function disable($force_all = false)
    {
        return parent::disable($force_all) &&
            $this->uninstallTab('AdminMostExpensiveOrders') &&
            $this->uninstallTab('AdminWaitingOrders') &&
            $this->uninstallMainTab();

    }

    /**
     * This method is installing main tab for subtabs
     * @return boolean
     */
    private function installMainTab() {
        $tabId = (int) Tab::getIdFromClassName('AdminMyTab');
        if(!$tabId) {
            $tabId = null;
        }

        $tab = new Tab($tabId);
        $tab->active = 1;
        $tab->class_name = 'AdminMyTab';
        $tab->name = array();
        foreach (Language::getLanguages() as $lang) {
            $tab->name[$lang['id_lang']] = $this->l('My Tab', array(), 'Modules.PresslyTask.Admin', $lang['locale']);
        }
        $tab->id_parent = (int)Tab::getIdFromClassName('SELL');
        $tab->module = '';
        $tab->icon = 'mood';

        return $tab->save();
    }


    /**
     * This method is uninstalling main "unclickable" tab
     * @return boolean
     */
    private function uninstallMainTab() {
        $tabId = (int) Tab::getIdFromClassName('AdminMyTab');
        if (!$tabId) {
            return true;
        }

        $tab = new Tab($tabId);

        return $tab->delete();
    }

    /**
     * This method is installing tabs on enabling or installing module
     * @param string $className
     * @param string $classNameTranslated
     * @return boolean
     */
    private function installTab($className)
    {
        $tabId = (int) Tab::getIdFromClassName($className);
        if (!$tabId) {
            $tabId = null;
        }

        $tab = new Tab($tabId);
        $tab->active = 1;
        $tab->class_name = $className;
        $tab->name = array();
        foreach (Language::getLanguages() as $lang) {
            if ($className === 'AdminMostExpensiveOrders') {
                $tab->name[$lang['id_lang']] = $this->l('Most Expensive Orders', array(), 'Modules.PresslyTask.Admin', $lang['locale']);
            } else if ($className === 'AdminWaitingOrders') {
                $tab->name[$lang['id_lang']] = $this->l('Waiting For Payment Orders', array(), 'Modules.PresslyTask.Admin', $lang['locale']);
            } else {
                $tab->name[$lang['id_lang']] = $this->l('My Tab', array(), 'Modules.PresslyTask.Admin', $lang['locale']);
            }
        }
        $tab->id_parent = (int) Tab::getIdFromClassName('AdminMyTab');
        $tab->module = $this->name;

        return $tab->save();
    }

    /**
     * This method is uninstalling tabs then disabling or uninstalling module
     * @param string $className
     * @return boolean
     */
    private function uninstallTab($className)
    {
        $tabId = (int) Tab::getIdFromClassName($className);
        if (!$tabId) {
            return true;
        }

        $tab = new Tab($tabId);

        return $tab->delete();
    }
}
