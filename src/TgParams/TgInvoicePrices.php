<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgParams;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblError;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgInvoiceCurrencies;

/**
 * @version 2024.01.03.02
 */
final class TgInvoicePrices{
  private array $Prices = [];
  public TblError|null $Error = null;

  public function __construct(
    string $Name = null,
    int $Price = null,
    bool $IgnoreLimit = false,
    TgInvoiceCurrencies $Currency = TgInvoiceCurrencies::USD
  ){
    if($Name === null):
      return;
    endif;
    $this->Add($Name, $Price, $IgnoreLimit, $Currency);
  }

  public function Add(
    string $Name,
    int $Price,
    bool $IgnoreLimit = false,
    TgInvoiceCurrencies $Currency = TgInvoiceCurrencies::USD
  ):bool{
    if($IgnoreLimit === false):
      if(isset($_SESSION['Currencies']) === false):
        $_SESSION['Currencies'] = file_get_contents('https://core.telegram.org/bots/payments/currencies.json');
      endif;
      if($_SESSION['Currencies'] !== false):
        $_SESSION['Currencies'] = json_decode($_SESSION['Currencies'], true);
        if($Price > 0):
          if($Price <= $_SESSION['Currencies'][$Currency->value]['min_amount']):
            $this->Error = TblError::InvoicePriceLow;
            return false;
          endif;
          if($Price > $_SESSION['Currencies'][$Currency->value]['max_amount']):
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

  public function ToArray():array{
    return $this->Prices;
  }
}