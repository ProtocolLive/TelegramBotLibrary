<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.06.21.00

class TblInvoicePrices implements JsonSerializable{
  private array $Prices = [];
  public TblError|null $Error = null;

  public function Add(
    string $Name,
    int $Price,
    bool $IgnoreLimit = false
  ):bool{
    if($IgnoreLimit === false):
      $CurrenciesJson = file_get_contents('https://core.telegram.org/bots/payments/currencies.json');
      if($CurrenciesJson !== false):
        $CurrenciesJson = json_decode($CurrenciesJson, true);
        if($Price > 0):
          if($Price <= $CurrenciesJson[DefaultCurrency->value]['min_amount']):
            $this->Error = TblError::InvoicePriceLow;
            return false;
          endif;
          if($Price > $CurrenciesJson[DefaultCurrency->value]['max_amount']):
            $this->Error = TblError::InvoicePriceHigh;
            return false;
          endif;
        endif;
      endif;
    endif;
    $this->Prices[] = [
      'label' => $Name,
      'amount' => $Price
    ];
    return true;
  }

  public function Count():int{
    return count($this->Prices);
  }

  public function jsonSerialize():array{
    return $this->Prices;
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