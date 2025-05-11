<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgEnums;

/**
 * @link https://core.telegram.org/bots/api#transactionpartneruser
 * @version 2025.05.11.00
 */
enum TgTransactionType:string{
  /**
   * Gifts sent by the bot
   */
  case Gift = 'gift_purchase';
  /**
   * Payments via invoices
   */
  case Invoice = 'invoice_payment';
  /**
   * Payments for paid media
   */
  case PaidMedia = 'paid_media_payment';
  /**
   * Telegram Premium subscriptions gifted by the bot
   */
  case Premium = 'premium_purchase';
  /**
   * Direct transfers from managed business accounts
   */
  case Transfer = 'business_account_transfer';
}