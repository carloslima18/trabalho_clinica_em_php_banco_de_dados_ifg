<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('register->register');
$I->sendPOST(
    '/front.php/register',[
        'firstName' => 'carlos',
        'lastName' => 'eduardo',
        'rg' => '6262129',
        'rua' => 'pedroludovico',
        'numero' => '123321',
        'complemento' => 'portorico',
        'bairro' => 'sao joaquim',
        'cidade' => 'anapolis',
        'estado' => 'goais',
        'cep' => '75000000',
        'phone' => '93437996',
        'cpf' => '70328176109',
        'data' => '05121997',
        'sex' => 'masculino',
        'email' => 'carloslima529@gamil.com'
    ]
);
$I->see('logar');
$I->see('sair');
$I->see('sair');



