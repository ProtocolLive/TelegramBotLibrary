<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.19.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;

/**
 * This object represents one shipping option.
 * @param string $Id Shipping option identifier
 * @param string $Name Option title
 * @param array $Prices List of price portions, in TblInvoiceProduct format
 * @link https://core.telegram.org/bots/api#shippingoption
 */
class TblInvoiceShippingOption{
  public function __construct(
    public readonly string $Id,
    public readonly string $Name,
    public readonly TblInvoicePrices $Prices
  ){}
}