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
 * @version 2024.01.03.02
 */
final readonly class TblInvoiceShippingOption{
  public function __construct(
    public string $Id,
    public string $Name,
    public TgInvoicePrices $Prices
  ){}
}