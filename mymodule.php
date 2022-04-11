<?php
 if (!defined('_PS_VERSION_')) {
    exit;
}
class MyModule extends Module
{

    public function __construct()
    {
        $this->name = 'mymodule';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Firstname Lastname';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '1.6',
            'max' => '1.7.99',
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('My module');
        $this->description = $this->l('Description of my module.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

        if (!Configuration::get('MYMODULE_NAME')) {
            $this->warning = $this->l('No name provided');
        }

    }

    function install(): bool
    {
        if (parent::install() && $this->registerHook('displayNav1') && $this->registerHook('header')) {
            return true;
        }
        return false;
    }

    function uninstall()
    {
        if (parent::uninstall()) {
            return true;
        }
        return false;
    }

    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path . '/views/js/uberbutton.js');
    }

    public function hookDisplayNav1()
    {
        return $this->display(__FILE__, 'views/templates/admin/uberconnexionbutton.tpl');
    }

    public function uberConnexion()
    {

        $ch = curl_init();
        $url = "https://login.uber.com/oauth/v2/authorize";


        $dataArray = [
            'client_id' => "your client id",
            'response_type' => "code",
            'redirect_uri' => $_GET['baseUrl']+"/index.php"
        ];

        $data = http_build_query($dataArray);
        $getUrl = $url . "?" . $data;


        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $getUrl);

        $response = curl_exec($ch);

        if (curl_error($ch)) {
            echo 'Request Error:' . curl_error($ch);
        } else {

            echo $response;
        }

        curl_close($ch);

        return $response;


    }

}
