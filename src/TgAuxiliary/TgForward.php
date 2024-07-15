<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgChatType;
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgBot,
  TgChat,
  TgUser
};

/**
 * @version 2024.07.15.00
 */
final readonly class TgForward{
  /**
   * For messages forwarded from channels or from anonymous administrators, information about the original sender chat
   */
  public TgUser|TgBot|TgChat|string $From;
  /**
   * For messages forwarded from channels, identifier of the original message in the channel
   */
  public int|null $Id;
  /**
   * If the message is a channel post that was automatically forwarded to the connected discussion group
   */
  public bool $Auto;
  /**
   * For forwarded messages, date the original message was sent in Unix time
   */
  public int|null $Date;
  /**
   * For messages originally sent by an anonymous chat administrator, original message author signature
   */
  public string|null $Signature;

  public function __construct(
    array $Data
  ){
    if($Data['forward_origin']['type'] === 'user'
    and $Data['forward_origin']['sender_user']['is_bot']):
      $this->From = new TgBot($Data['forward_origin']['sender_user']);
    elseif($Data['forward_origin']['type'] === 'user'):
      $this->From = new TgUser($Data['forward_origin']['sender_user']);
    elseif($Data['forward_origin']['type'] === TgChatType::Channel->value):
      $this->From = new TgChat($Data['forward_origin']['chat']);
    elseif($Data['forward_origin']['type'] === 'chat'):
      $this->From = new TgChat($Data['forward_origin']['sender_chat']);
    elseif($Data['forward_origin']['type'] === 'hidden_user'):
      $this->From = $Data['forward_origin']['sender_user_name'];
    endif;
    $this->Id = $Data['forward_origin']['message_id'] ?? null;
    $this->Date = $Data['forward_origin']['date'] ?? null;
    $this->Signature = $Data['forward_origin']['author_signature'] ?? null;
    $this->Auto = $Data['is_automatic_forward'] ?? false;
  }
}