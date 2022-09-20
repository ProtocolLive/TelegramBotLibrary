<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.09.20.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgInvoiceCurrencies;

class TblInvoicePrices{
  private array $Prices = [];
  public TblError|null $Error = null;

  public function Add(
    string $Name,
    int $Price,
    bool $IgnoreLimit = false,
    TgInvoiceCurrencies $Currency = TgInvoiceCurrencies::USD
  ):bool{
    if($IgnoreLimit === false):
      $CurrenciesJson = file_get_contents('https://core.telegram.org/bots/payments/currencies.json');
      if($CurrenciesJson !== false):
        $CurrenciesJson = json_decode($CurrenciesJson, true);
        if($Price > 0):
          if($Price <= $CurrenciesJson[$Currency->value]['min_amount']):
            $this->Error = TblError::InvoicePriceLow;
            return false;
          endif;
          if($Price > $CurrenciesJson[$Currency->value]['max_amount']):
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

  public function ToJson():string{
    return json_encode($this->Prices);
  }

  public function ToArray():array{
    return $this->Prices;
  }
}