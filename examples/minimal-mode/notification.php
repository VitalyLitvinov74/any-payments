<?php
(new Notification(
    new \AnyPayments\v3\psp\royalpay\RoyalPayNotification(
    )
))->accept_notification();
?>

