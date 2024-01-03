<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TgParams\TgInvoicePrices;

/**
 * This object represents one shipping option.
 * @param string $Id Shipping option identifier
 * @param string $Name Option title
 * @param array $Prices List of price portions, in TblInvoiceProduct format
 * @link https://core.telegram.org/bots/api#shippingoption
 * @version 2024.01.03.01
 */
class TblInvoiceShippingOption{
  public function __construct(
    public readonly string $Id,
    public readonly string $Name,
    public readonly TgInvoicePrices $Prices
  ){}
}