<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgCurrencies;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * @version 2024.07.07.00
 */
final readonly class TgRefundedPayment
implements TgEventInterface{
  public TgCurrencies $Currency;
  public int $Amount;
  public string $Payload;
  public string $TelegramId;
  public string|null $ProviderId;

  public function __construct(
    array $Data
  ){
    $this->Currency = TgCurrencies::from($Data['currency']);
    $this->Amount = $Data['total_amount'];
    $this->Payload = $Data['invoice_payload'];
    $this->TelegramId = $Data['telegram_payment_charge_id'];
    $this->ProviderId = $Data['provider_payment_charge_id'] ?? null;
  }
}