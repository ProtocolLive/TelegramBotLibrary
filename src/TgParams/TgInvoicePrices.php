<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgParams;
use ProtocolLive\TelegramBotLibrary\TblEnums\TblError;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblException;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgCurrencies;

/**
 * @version 2025.07.04.00
 */
final class TgInvoicePrices{
  private array $Prices = [];

  /**
   * @throws TblException
   */
  public function __construct(
    string|null $Name = null,
    int|null $Price = null,
    bool $IgnoreLimit = false,
    private TgCurrencies $Currency = TgCurrencies::USD
  ){
    if($Name === null):
      return;
    endif;
    $this->Add($Name, $Price, $IgnoreLimit);
  }

  /**
   * @throws TblException
   */
  public function Add(
    string $Name,
    int $Price,
    bool $IgnoreLimit = false
    ):bool{
    if($IgnoreLimit === false):
      if(isset($_SESSION['Currencies']) === false):
        $_SESSION['Currencies'] = file_get_contents('https://core.telegram.org/bots/payments/currencies.json');
        if($_SESSION['Currencies'] !== false):
          $_SESSION['Currencies'] = json_decode($_SESSION['Currencies'], true);
        endif;
      endif;
      if(isset($_SESSION['Currencies'])):
        if($Price > 0):
          if($Price <= $_SESSION['Currencies'][$this->Currency->value]['min_amount']):
            throw new TblException(
              TblError::InvoicePriceLow,
              'Price must be bigger than ' . $_SESSION['Currencies'][$this->Currency->value]['min_amount']
            );
          endif;
          if($Price > $_SESSION['Currencies'][$this->Currency->value]['max_amount']):
            throw new TblException(
              TblError::InvoicePriceHigh,
              'Price must be smaller than ' . $_SESSION['Currencies'][$this->Currency->value]['max_amount']
            );
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