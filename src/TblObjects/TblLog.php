<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;

/**
 * @version 2024.01.26.00
 */
final class TblLog{
  public const All = -1;
  public const None = 0;
  public const Send = 1;
  public const Response = 2;
  public const Webhook = 4;
  public const WebhookObject = 8;
  public const Curl = 16;
}