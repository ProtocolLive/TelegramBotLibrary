<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
use ProtocolLive\TelegramBotLibrary\TblObjects\{
  TblException,
  TblMarkup
};
use ProtocolLive\TelegramBotLibrary\TgEnums\TgMethods;
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgGame,
  TgGameScore
};
use ProtocolLive\TelegramBotLibrary\TgParams\TgReplyParams;

/**
 * @version 2026.01.05.00
 */
trait TblGameTrait{
  /**
   * Use this method to send a game
   * @param int|string $Chat Unique identifier for the target chat
   * @param string $Game Short name of the game, serves as the unique identifier for the game. Set up your games via @BotFather.
   * @param int $Thread Unique identifier for the target message thread (topic) of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message will be sent
   * @param bool $DisableNotifications Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param TgReplyParams $Reply Description of the message to reply to
   * @param TblMarkup $Markup A JSON-serialized object for an inline keyboard. If empty, one 'Play game_title' button will be shown. If not empty, the first button must launch the game.
   * @param string $Effect Unique identifier of the message effect to be added to the message; for private chats only
   * @param bool $AllowPaid Allow up to 1000 messages per second, ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be withdrawn from the bot's balance
   * @return TgGame On success, the sent Message is returned.
   * @link https://core.telegram.org/bots/api#sendgame
   * @throws TblException
   */
  public function GameSend(
    int|string $Chat,
    string $Game,
    int|null $Thread = null,
    string|null $BusinessId = null,
    bool $DisableNotifications = false,
    bool $Protect = false,
    bool $AllowPaid = false,
    TgReplyParams|null $Reply = null,
    TblMarkup|null $Markup = null,
    string|null $Effect = null
  ):TgGame{
    $param['chat_id'] = $Chat;
    if(empty($BusinessId) === false):
      $param['business_connection_id'] = $BusinessId;
    endif;
    $param['game_short_name'] = $Game;
    if($Thread !== null):
      $param['message_thread_id'] = $Thread;
    endif;
    if($DisableNotifications):
      $param['disable_notification'] = true;
    endif;
    if($Protect):
      $param['protect_content'] = true;
    endif;
    if($AllowPaid):
      $param['allow_paid_broadcast'] = true;
    endif;
    if($Reply !== null):
      $param['reply_markup'] = $Reply->ToArray();
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->ToArray();
    endif;
    if($Effect !== null):
      $param['message_effect_id'] = $Effect;
    endif;
    $return = $this->ServerMethod(TgMethods::GameSend, $param);
    return new TgGame($return);
  }

  /**
   * Use this method to get data for high score tables. Will return the score of the specified user and several of their neighbors in a game. This method will currently return scores for the target user, plus two of their closest neighbors on each side. Will also return the top three users if the user and their neighbors are not among them. Please note that this behavior is subject to change.
   * @param int $User Target user id
   * @param int $Chat Required if inline_message_id is not specified. Unique identifier for the target chat
   * @param int $MessageId Required if inline_message_id is not specified. Identifier of the sent message
   * @param string $InlineMessageId Required if chat_id and message_id are not specified. Identifier of the inline message
   * @return TgGameScore[] An Array of GameHighScore objects.
   * @link https://core.telegram.org/bots/api#getgamehighscores
   */
  public function GameScoreGet(
    int $User,
    int|null $Chat = null,
    int|null $MessageId = null,
    string|null $InlineMessageId = null
  ):array{
    $param['user_id'] = $User;
    if(empty($InlineMessageId)):
      $param['chat_id'] = $Chat;
      $param['message_id'] = $MessageId;
    else:
      $param['inline_message_id'] = $InlineMessageId;
    endif;
    $return = $this->ServerMethod(TgMethods::GameScoreGet, $param);
    foreach($return as &$score):
      $score = new TgGameScore($score);
    endforeach;
    return $return;
  }

  /**
   * Use this method to set the score of the specified user in a game message.
   * @param int $User User identifier
   * @param int $Score New score, must be non-negative
   * @param bool $Force Pass True, if the high score is allowed to decrease. This can be useful when fixing mistakes or banning cheaters
   * @param bool $DisableAutoEdit Pass True, if the game message should not be automatically edited to include the current scoreboard
   * @param int|string $Chat Required if InlineMessageId is not specified. Unique identifier for the target chat
   * @param int $MessageId Required if InlineMessageId is not specified. Identifier of the sent message
   * @param string $InlineMessageId Required if Chat is not specified. Identifier of the inline message
   * @return true|TgGame On success, if the message is not an inline message, the Message is returned, otherwise True is returned. Returns an error, if the new score is not greater than the user's current score in the chat and force is False.
   * @link https://core.telegram.org/bots/api#setgamescore
   * @throws TblException
   */
  public function GameScoreSet(
    int $User,
    int $Score,
    bool $Force = false,
    bool $DisableAutoEdit = false,
    int|string|null $Chat = null,
    int|null $MessageId = null,
    string|null $InlineMessageId = null
  ):true|TgGame{
    $param['user_id'] = $User;
    $param['score'] = $Score;
    if($Force):
      $param['force'] = true;
    endif;
    if($DisableAutoEdit):
      $param['disable_edit_message'] = true;
    endif;
    if(empty($InlineMessageId)):
      $param['chat_id'] = $Chat;
      $param['message_id'] = $MessageId;
    else:
      $param['inline_message_id'] = $InlineMessageId;
    endif;
    $return = $this->ServerMethod(TgMethods::GameScoreSet, $param);
    if($return):
      return true;
    else:
      return new TgGame($return);
    endif;
  }
}