<?php 



function form($values)

{   
 
    $form = [
        "form"=>
        [
            "legend"=>[
                "title"=> "FEATURED PRODUCTS",
                "icon" => "con-cogs"
            ],
            "description" => "This module is used to show a slider categories on homepage, select more than at least 4 categories",
            "input"=>[
                        [
                            'type' => 'categories',
                            'tree' => [
                                'id' => 'categories_tree',
                                'selected_categories' => $values,
                                'use_search' => true, // Activer la recherche de catégories
                                'use_checkbox' => true,
                                'use_radio' => false, // Désactiver les boutons radio 
                                ],
                        'label' => 'Category',
                        'name' => 'SITEFIX_SELECTED_CATEGORIES',
                        'multiple' => true,
                        'hint' => 'Select one or more categories.',
                        'desc' => "Select more than one categories to show on your home page featured categories"
                    ],
                    [
                        'type' => 'text',
                        'label' => 'The title',
                         'name' => 'SECTION_TITLE',
                         "desc"=> "THE TITLE SECTION TO APPEAR ON HOME PAGE"
                    ],
                    ["type"  =>"radio",
                     "label" =>"Layout",
                     "name"  =>"FEATURED_LAYOUT",
                     "desc"  => "choose how to display the categories on your home page",
                     "required"=>True,
                     "values"=>[
                        [
                            'id' => 'radio1',
                            'value' => 1,
                            'label' => ('SLIDER LAYOUT')
                        ],
                        [
                            'id' => 'radio2',
                            'value' => 2,
                            'label' => ('CARD LAYOUT WITHOUD SLIDER')
                        ],
                        [
                            "id"=>"radio3",
                            "value"=>3,
                            "label" =>("CIRCLE LAYOUT")
                        ]
                     ]
                    
                    ]
                       
                ],
            "submit"=>[
                "title"=> "saved"
            ]
        ]
       
    ];
    return $form;
}