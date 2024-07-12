<?php 
if (!defined('_PS_VERSION_')) {
    exit;
}

class Sitefix_featured_categories extends Module
{
    public function __construct()
    {
        $this->name = 'sitefix_featured_categories';
        $this->tab = 'front_office_features';
        $this->version = '0.0.1';
        $this->author = 'AGENCE WEB SITEFIX (EMANUEL ABIZIMI)';
        $this->need_instance = 0;
        $this->bootstrap = true;
        parent::__construct();
        
        $this->displayName = $this->l('SITEFIX_FEATURED_CATEGORIES');
        $this->description = $this->l('This module is used to show the features categories with slider');
        $this->ps_versions_compliancy = [
            'min' => '1.7.0.0',
            'max' => _PS_VERSION_,
        ];
    }

    public function install()
    {   
        return parent::install() &&
               $this->registerHook('displayHome');
    }

    public function uninstall()
    {   
        return parent::uninstall();
    }
    
    public function hookDisplayHome()
    {
     
        $this->context->smarty->assign($this->getConfigFieldsValues());
      
        
        return $this->display(__FILE__, 'views/templates/hook/sitefix_featured_categories.tpl');
    }

    public function renderForm()
    {
        $formConfig = _PS_MODULE_DIR_ . $this->name . '/src/form.php';
        include_once($formConfig);
        
        // FILDS DATA
       
        /**
         * n DEFAULT CATEGORIES SEND AS ARG ON FORM FUNCTION 
         * IS AN ARRAY WITH ID OF ALL CATEGORIES SELECTED
         */
        $_fiels_values  =  $this->getConfigFieldsValues();
        $default_cat = $_fiels_values["SITEFIX_SELECTED_CATEGORIES"];
        $form = form($default_cat);
        /**
         *  INITILISE FORM CLASS TO GENERATE HTML FORM
         */
        $helper = new HelperForm();
        $helper->default_form_language = (int)Configuration::get('PS_LANG_DEFAULT');
        $helper->submit_action = 'SitefixCategoriesFeatured';
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->first_call = true;
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name;
       
        $helper->tpl_vars = [
            'fields_value' => $_fiels_values,
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        ];
        return $helper->generateForm(array($form));
    }

    public function getContent()
    {

        if (Tools::isSubmit('SitefixCategoriesFeatured')) {
            $categories_selected =  Tools::getValue('SITEFIX_SELECTED_CATEGORIES');
            $section_title       =  Tools::getValue('SECTION_TITLE');
            $layout              =  Tools::getValue("FEATURED_LAYOUT");

            // SET DATA INTO DATABASE INTO CONFIG TABLE
            Configuration::updateValue('SITEFIX_FEATURED_CATEGORIES_CATEGORIES', json_encode($categories_selected), true);
            Configuration::updateValue('SITEFIX_FEATURED_CATEGORIES_SECTION_TITLE', ($section_title));
            Configuration::updateValue('FEATURED_LAYOUT', $layout);

            
        }
        return $this->renderForm();
    }

    public function getConfigFieldsValues()
    {
        $categories         = Configuration::get('SITEFIX_FEATURED_CATEGORIES_CATEGORIES') ? :"";
        $section_title      = Configuration::get('SITEFIX_FEATURED_CATEGORIES_SECTION_TITLE') ?: "";
        $layout             = Configuration::get('FEATURED_LAYOUT')?: 1;
        $categories         = json_decode($categories, true) ?: [1];
        return [
            "SITEFIX_SELECTED_CATEGORIES" => $categories,
            "SECTION_TITLE"               => $section_title,
            "sitefix_ft_cat"              => $this->sendDataToTemplate($categories),
            "FEATURED_LAYOUT"             => $layout
        ];
    }
    private function sendDataToTemplate($categories_array)
    {   
        $lang_id = Context::getContext()->language->id;
        $categories_selected = $categories_array;
        $all_categories = [];
        $link = new Link(); 
        // Utiliser l'objet Link pour générer les URLs
        foreach ($categories_selected as $category_id) {
            $category = new Category(intval($category_id), $lang_id);
            // Récupérer l'URL de l'image de la catégorie
            $image_url = $this->getCategoryImageUrl($category);
            // Récupérer l'URL de la catégorie
            $category_url = $link->getCategoryLink($category);
            // Ajouter les détails de la catégorie, l'image et l'URL au tableau
            $all_categories[] = [
                'id'       => $category->id,
                'name'     => $category->name,
                'image'    => $image_url,
                'url'      => $category_url,
            ];
        }
    
        return $all_categories;
    }
    

      
    private function getCategoryImageUrl($category)
    {   $imagePath = _PS_CAT_IMG_DIR_ . $category->id . '.jpg';
        if (file_exists($imagePath)) {
            return _PS_BASE_URL_ . _THEME_CAT_DIR_ . $category->id . '.jpg';
        } else {
            // Si l'image de la catégorie n'existe pas, retourner une image par défaut
            return _PS_BASE_URL_ . 'img/default-category.jpg';
        }
    }

}
