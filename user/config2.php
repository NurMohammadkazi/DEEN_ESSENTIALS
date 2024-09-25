<?php
require ('stripe-php-master/init.php');

$publishableKey = "pk_test_51PpBRX04P32O2jd0tIYDuyw32opgM2KGp43RRqPuGVJ12VL1JhKLKmLotEKgoKfMc17ZUInPPKy1gFBDRJWVLyrX00UCucpl7Z";

$secretKey = "sk_test_51PpBRX04P32O2jd0GOXV1NyUmhKc748q6J18xjViF3KZzpTGd6SH0YbLtMJ2NDYPd8PkkaR9dXCZtqgEVIgOk34800CHskrT0O";

\Stripe\Stripe::setApiKey($secretKey);
?>