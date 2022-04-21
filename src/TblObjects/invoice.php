<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.04.20.01

class TblInvoiceProduct{
  /**
   * Throws an error if price is out of the range
   */
  public function __construct(
    public readonly string $Name,
    public readonly int $Price,
    bool $IgnoreLimit = false
  ){
    if($IgnoreLimit === false):
      $CurrenciesJson = file_get_contents('https://core.telegram.org/bots/payments/currencies.json');
      if($CurrenciesJson !== false):
        $CurrenciesJson = json_decode($CurrenciesJson, true);
        if($Price > 0):
          if($Price < $CurrenciesJson[DefaultCurrency->value]['min_amount']):
            throw new Exception('Price too low', TblException::InvoicePriceLow);
          endif;
          if($Price > $CurrenciesJson[DefaultCurrency->value]['max_amount']):
            throw new Exception('Price too high', TblException::InvoicePriceHigh);
          endif;
        endif;
      endif;
    endif;
  }
}

/**
 * This object represents one shipping option.
 * @param string $Id Shipping option identifier
 * @param string $Title Option title
 * @param array $Prices List of price portions, in TblInvoiceProduct format
 * @link https://core.telegram.org/bots/api#shippingoption
 */
class TblInvoiceShippingOption{
  public function __construct(
    public readonly string $Id,
    public readonly string $Title,
    public readonly array $Prices
  ){}
}