<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.19.00

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
require(__DIR__ . '/TgObjects/TgLimits.php');
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
require(__DIR__ . '/TgObjects/TgUpdateType.php');
require(__DIR__ . '/TgObjects/TgUser.php');
require(__DIR__ . '/TgObjects/TgVideo.php');
require(__DIR__ . '/TgObjects/TgVoice.php');
require(__DIR__ . '/TgObjects/TgWebappData.php');

require(__DIR__ . '/TblObjects/TblCmd.php');
require(__DIR__ . '/TblObjects/TblCmdEdited.php');
require(__DIR__ . '/TblObjects/TblCommand.php');
require(__DIR__ . '/TblObjects/TblData.php');
require(__DIR__ . '/TblObjects/TblDebug.php');
require(__DIR__ . '/TblObjects/TblDefaultPerms.php');
require(__DIR__ . '/TblObjects/TblEntities.php');
require(__DIR__ . '/TblObjects/TblError.php');
require(__DIR__ . '/TblObjects/TblException.php');
require(__DIR__ . '/TblObjects/TblInlineQuery.php');
require(__DIR__ . '/TblObjects/TblInlineQueryArticle.php');
require(__DIR__ . '/TblObjects/TblInlineQueryContent.php');
require(__DIR__ . '/TblObjects/TblInlineQueryContentText.php');
require(__DIR__ . '/TblObjects/TblInlineQueryPhoto.php');
require(__DIR__ . '/TblObjects/TblInvoicePrices.php');
require(__DIR__ . '/TblObjects/TblInvoiceShippingOption.php');
require(__DIR__ . '/TblObjects/TblInvoiceShippingOptions.php');
require(__DIR__ . '/TblObjects/TblLog.php');
require(__DIR__ . '/TblObjects/TblMarkup.php');
require(__DIR__ . '/TblObjects/TblMarkupForceReply.php');
require(__DIR__ . '/TblObjects/TblMarkupInline.php');
require(__DIR__ . '/TblObjects/TblMarkupKeyboard.php');
require(__DIR__ . '/TblObjects/TblMarkupRemove.php');
require(__DIR__ . '/TblObjects/TblMarkupRequest.php');
require(__DIR__ . '/TblObjects/TblWebhook.php');