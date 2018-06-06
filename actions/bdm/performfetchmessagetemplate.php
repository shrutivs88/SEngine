<?php
    session_start();
    include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/config.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/services/MailTemplateService.php');
    $mailTemplateService = new MailTemplateService();

    $templateid = $_POST['template']; 
    $TemplateArray = $mailTemplateService->getMailTemplateBasedOnId($templateid);  
    // encoding array to json format
    echo $TemplateArray[0]; 
    echo "\n";
    echo "\n";
    echo $TemplateArray[1];
    echo "\n";
?>