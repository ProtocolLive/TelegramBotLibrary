<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

require(__DIR__ . '/basics.php');

require(__DIR__ . '/TgObjects/TgCallback.php');
require(__DIR__ . '/TgObjects/TgChat.php');
require(__DIR__ . '/TgObjects/TgChatAction.php');
require(__DIR__ . '/TgObjects/TgChatAutoDel.php');
require(__DIR__ . '/TgObjects/TgChatMigrateFrom.php');
require(__DIR__ . '/TgObjects/TgChatMigrateTo.php');
require(__DIR__ . '/TgObjects/TgChatTitle.php');
require(__DIR__ . '/TgObjects/TgChatType.php');
require(__DIR__ . '/TgObjects/TgCmdScope.php');
require(__DIR__ . '/TgObjects/TgDocument.php');
require(__DIR__ . '/TgObjects/TgDocumentEdited.php');
require(__DIR__ . '/TgObjects/TgEntity.php');
require(__DIR__ . '/TgObjects/TgEntityType.php');
require(__DIR__ . '/TgObjects/TgError.php');
require(__DIR__ . '/TgObjects/TgErrors.php');
require(__DIR__ . '/TgObjects/TgFile.php');
require(__DIR__ . '/TgObjects/TgGroupStatus.php');
require(__DIR__ . '/TgObjects/TgGroupStatusMy.php');
require(__DIR__ . '/TgObjects/TgInlineQuery.php');
require(__DIR__ . '/TgObjects/TgInlineQueryFeedback.php');
require(__DIR__ . '/TgObjects/TgInvoice.php');
require(__DIR__ . '/TgObjects/TgInvoiceCheckout.php');
require(__DIR__ . '/TgObjects/TgInvoiceCurrencies.php');
require(__DIR__ . '/TgObjects/TgInvoiceData.php');
require(__DIR__ . '/TgObjects/TgInvoiceDone.php');
require(__DIR__ . '/TgObjects/TgInvoiceOrderAddress.php');
require(__DIR__ . '/TgObjects/TgInvoiceOrderInfo.php');
require(__DIR__ . '/TgObjects/TgInvoiceShipping.php');
require(__DIR__ . '/TgObjects/TgLocation.php');
require(__DIR__ . '/TgObjects/TgLocationEdited.php');
require(__DIR__ . '/TgObjects/TgMask.php');
require(__DIR__ . '/TgObjects/TgMember.php');
require(__DIR__ . '/TgObjects/TgMemberLeft.php');
require(__DIR__ . '/TgObjects/TgMemberNew.php');
require(__DIR__ . '/TgObjects/TgMemberStatus.php');
require(__DIR__ . '/TgObjects/TgMenuButton.php');
require(__DIR__ . '/TgObjects/TgMessage.php');
require(__DIR__ . '/TgObjects/TgMethods.php');
require(__DIR__ . '/TgObjects/TgParseMode.php');
require(__DIR__ . '/TgObjects/TgPermAdmin.php');
require(__DIR__ . '/TgObjects/TgPermMember.php');
require(__DIR__ . '/TgObjects/TgPhoto.php');
require(__DIR__ . '/TgObjects/TgPhotoEdited.php');
require(__DIR__ . '/TgObjects/TgPhotoSize.php');
require(__DIR__ . '/TgObjects/TgPoll.php');
require(__DIR__ . '/TgObjects/TgPollOption.php');
require(__DIR__ . '/TgObjects/TgPollType.php');
require(__DIR__ . '/TgObjects/TgProfilePhoto.php');
require(__DIR__ . '/TgObjects/TgSticker.php');
require(__DIR__ . '/TgObjects/TgStickerType.php');
require(__DIR__ . '/TgObjects/TgText.php');
require(__DIR__ . '/TgObjects/TgTextEdited.php');
require(__DIR__ . '/TgObjects/TgUser.php');
require(__DIR__ . '/TgObjects/TgVideo.php');
require(__DIR__ . '/TgObjects/TgVoice.php');
require(__DIR__ . '/TgObjects/TgWebappData.php');

require(__DIR__ . '/TblObjects/cmd.php');
require(__DIR__ . '/TblObjects/data.php');
require(__DIR__ . '/TblObjects/entity.php');
require(__DIR__ . '/TblObjects/errors.php');
require(__DIR__ . '/TblObjects/inline.php');
require(__DIR__ . '/TblObjects/invoice.php');
require(__DIR__ . '/TblObjects/markup.php');
require(__DIR__ . '/TblObjects/webhook.php');

require(__DIR__ . '/constants.php');