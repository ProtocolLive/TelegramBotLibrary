<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @version 2025.07.03.01
 */
final class TgLimits{
  /**
   * @link https://core.telegram.org/bots/api#answercallbackquery
   */
  public const CallbackAnswer = 200;
  public const CallbackData = 64;
  public const Caption = 1024;
  /**
   * @link https://core.telegram.org/bots/api#createchatsubscriptioninvitelink
   */
  public const ChannelSubscriptionPrice = 2500;
  /**
   * @link https://core.telegram.org/bots/api#inputchecklist
   */
  public const int ChecklistTasks = 30;
  /**
   * @link https://core.telegram.org/bots/api#inputchecklisttask
   */
  public const int ChecklistTaskText = 100;
  /**
   * @link https://core.telegram.org/bots/api#inputchecklist
   */
  public const int ChecklistTitle = 255;
  /**
   * @link https://core.telegram.org/bots/api#botcommand
   */
  public const Command = 32;
  /**
   * @link https://core.telegram.org/bots/api#botcommand
   */
  public const CmdDescription = 256;
  /**
   * @link https://core.telegram.org/bots/api#setmydescription
   */
  public const Description = 512;
  /**
   * @link https://core.telegram.org/bots/api#setmyshortdescription
   */
  public const DescriptionShort = 120;
  /**
   * @link https://core.telegram.org/bots/api#createchatsubscriptioninvitelink
   */
  public const InviteLinkName = 32;
  /**
   * https://core.telegram.org/bots/api#copymessages
   */
  public const MessagesCopy = 100;
  /**
   * @link https://core.telegram.org/bots/api#deletemessages
   */
  public const MessagesDelete = 100;
  /**
   * https://core.telegram.org/bots/api#forwardmessages
   */
  public const MessagesForward = 100;
  public const MediaGroup = 10;
  /**
   * @link https://core.telegram.org/bots/api#setmyname
   */
  public const Name = 64;
  /**
   * @link https://core.telegram.org/bots/api#sendpaidmedia
   */
  public const Payload = 128;
  /**
   * @link https://core.telegram.org/bots/api#sendpoll
   */
  public const PollExplanation = 200;
  /**
   * @link https://core.telegram.org/bots/api#sendpoll
   */
  public const PollOptionsMax = 10;
  /**
   * @link https://core.telegram.org/bots/api#sendpoll
   */
  public const PollOptionsMin = 2;
  /**
   * https://core.telegram.org/bots/api#inputpolloption
   */
  public const PollOptionText = 100;
  /**
   * @link https://core.telegram.org/bots/api#sendpoll
   */
  public const PollQuestion = 300;
  /**
   * @link https://core.telegram.org/bots/api#replyparameters
   */
  public const Quote = 1024;
  public const Text = 4096;
}