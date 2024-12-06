<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;

/**
 * @version 2023.02.05.00
 */
class TblMarkupRemove extends TblMarkup{
  /**
   * Upon receiving a message with this object, Telegram clients will remove the current custom keyboard and display the default letter-keyboard. By default, custom keyboards are displayed until a new keyboard is sent by a bot. An exception is made for one-time keyboards that are hidden immediately after the user presses a button (see ReplyKeyboardMarkup).
   * @param bool $Selective Optional. Use this parameter if you want to remove the keyboard for specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message. Example: A user votes in a poll, bot returns confirmation message in reply to the vote and removes the keyboard for that user, while still showing the keyboard with poll options to users who haven't voted yet.
   * @link https://core.telegram.org/bots/api#replykeyboardremove
   */
  public function __construct(bool $Selective = false){
    $this->Markup['remove_keyboard'] = true;
    $this->Markup['selective'] = $Selective;
  }
}
