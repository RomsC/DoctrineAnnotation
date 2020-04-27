<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

$autoloadPath = __DIR__ . '/vendor/autoload.php';
if (file_exists($autoloadPath)) {
    require_once $autoloadPath;
}

class doctrineannotation extends Module
{
    public function __construct()
    {
        $this->name = 'doctrineannotation';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'RomsC';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '1.7.6.0',
            'max' => _PS_VERSION_,
        ];

        parent::__construct();

        $this->displayName = $this->trans(
            'Doctrine Annotation Sample',
            [],
            'Modules.Doctrineannotation.Admin'
        );
        $this->description =
            $this->trans(
                'A sample module that uses doctrine annotation',
                [],
                'Modules.Doctrineannotation.Admin'
            );
    }

    /**
     * This function is required in order to make module compatible with new translation system.
     *
     * @return bool
     */
    public function isUsingNewTranslationSystem()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function install()
    {
        if (parent::install()) {
            foreach ($this->_hooks as $hook) {
                if (!$this->registerHook($hook)) {
                    return false;
                }
            }

            if (!$this->installTables()) {
                return false;
            }

            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function uninstall()
    {
        return parent::uninstall()
            && $this->uninstallTables();
    }

    /**
     * Installs tables required.
     *
     * @return bool
     */
    private function installTables()
    {
        $sql_file = __DIR__ . '/install/install.sql';
        if (!$this->loadSQLFile($sql_file)) {
            return false;
        }

        return true;
    }

    /**
     * Uninstalls tables required.
     *
     * @return bool
     */
    private function uninstallTables()
    {
        $sql_file = __DIR__ . '/install/uninstall.sql';
        if (!$this->loadSQLFile($sql_file)) {
            return false;
        }

        return true;
    }

    /**
     * @param string $sql_file
     *
     * @return int|bool
     */
    protected function loadSQLFile($sql_file)
    {
        // Get install MySQL file content
        /** @var string $sql_content */
        $sql_content = Tools::file_get_contents($sql_file);

        // Replace prefix
        // Replace ENGINE
        $sql_content = str_replace(['PREFIX_', '_ENGINE_'], [_DB_PREFIX_, _MYSQL_ENGINE_], $sql_content);
        // Store MySQL command in array
        $sql_requests = preg_split("/;\s*[\r\n]+/", $sql_content);
        if (!$sql_requests) {
            return false;
        }
        // Execute each MySQL command
        $result = true;
        foreach ($sql_requests as $request) {
            if (!empty($request)) {
                $result &= Db::getInstance()->execute(trim($request));
            }
        }
        // Return result
        return $result;
    }

}
