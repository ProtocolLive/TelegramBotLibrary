<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgChatType;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * This object represents an incoming inline query. When the user sends an empty query, your bot could return some default or trending results.
 * @link https://core.telegram.org/bots/api#inlinequery
 * @version 2024.01.02.00
 */
final class TgInlineQuery
implements TgEventInterface{
  /**
   * @param string $Id Unique identifier for this query
   */
  public readonly string $Id;
  /**
   * @param TgUser $User Sender
   */
  public readonly TgUser $User;
  /**
   * @param TgChatType|null $ChatType Type of the chat from which the inline query was sent. Can be either “sender” for a private chat with the inline query sender, “private”, “group”, “supergroup”, or “channel”. The chat type should be always known for requests sent from official clients and most third-party clients, unless the request was sent from a secret chat
   */
  public readonly TgChatType|null $ChatType;
  /**
   * @param string $Text Text of the query (up to 256 characters)
   */
  public readonly string $Text;
  /**
   * @param string $Offset Offset of the results to be returned, can be controlled by the bot
   */
  public readonly string $Offset;

  /**
   * @link https://core.telegram.org/bots/api#inlinequery
   */
  public function __construct(array $Data){
    $this->Id = $Data['id'];
    $this->User = new TgUser($Data['from']);
    if(isset($Data['chat_type'])):
      $this->ChatType = TgChatType::tryFrom($Data['chat_type']);
    else:
      $this->ChatType = null;
    endif;
    $this->Text = $Data['query'];
    $this->Offset = $Data['offset'];
  }
}