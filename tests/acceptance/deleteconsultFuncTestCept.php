<?php
$I = new AcceptanceTester($scenario);
$I->login('admin','admin');
$I->wantTo('deleteconsult->deleteconsult');
$I->sendPOST(
    '/front.php/deleteconsult',[
        'cpf' => '70328176109',
        'date' => '10102020'
    ]
);
$I->see('consulta');
$I->see('encontrado');
$I->see('não');