<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.04.19.00

class TblInvoiceProduct{
  /**
   * Throws an error if price is out of the range
   */
  public function __construct(
    public readonly string $Name,
    public readonly int $Price
  ){
    $CurrenciesJson = file_get_contents('https://core.telegram.org/bots/payments/currencies.json');
    if($CurrenciesJson !== false):
      $CurrenciesJson = json_decode($CurrenciesJson, true);
      if($Price < $CurrenciesJson[DefaultCurrency->value]['min_amount']):
        throw new Exception('Price too low', TblException::InvoicePriceLow);
      endif;
      if($Price > $CurrenciesJson[DefaultCurrency->value]['max_amount']):
        throw new Exception('Price too high', TblException::InvoicePriceHigh);
      endif;
    endif;
  }
}