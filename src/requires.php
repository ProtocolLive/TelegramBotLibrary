<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.03.08.00

require(__DIR__ . '/basics.php');

require(__DIR__ . '/TgObjects/message.php');//parent
require(__DIR__ . '/TgObjects/media.php');//parent
require(__DIR__ . '/TgObjects/chat.php');
require(__DIR__ . '/TgObjects/cmd.php');
require(__DIR__ . '/TgObjects/document.php');
require(__DIR__ . '/TgObjects/entity.php');
require(__DIR__ . '/TgObjects/photo.php');
require(__DIR__ . '/TgObjects/text.php');
require(__DIR__ . '/TgObjects/user.php');

require(__DIR__ . '/TblObjects/cmd.php');
require(__DIR__ . '/TblObjects/data.php');
require(__DIR__ . '/TblObjects/webhook.php');

require(__DIR__ . '/constants.php');