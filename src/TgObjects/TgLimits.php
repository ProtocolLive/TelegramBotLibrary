<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @version 2025.07.04.01
 */
final class TgLimits{
  /**
   * @link https://core.telegram.org/bots/api#answercallbackquery
   */
  public const int CallbackAnswer = 200;
  public const int CallbackData = 64;
  public const int Caption = 1024;
  /**
   * @link https://core.telegram.org/bots/api#createchatsubscriptioninvitelink
   */
  public const int ChannelSubscriptionPrice = 2500;
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
  public const int Command = 32;
  /**
   * @link https://core.telegram.org/bots/api#botcommand
   */
  public const int CmdDescription = 256;
  /**
   * @link https://core.telegram.org/bots/api#setmydescription
   */
  public const int Description = 512;
  /**
   * @link https://core.telegram.org/bots/api#setmyshortdescription
   */
  public const int DescriptionShort = 120;
  /**
   * @link https://core.telegram.org/bots/api#createchatsubscriptioninvitelink
   */
  public const int InviteLinkName = 32;
  /**
   * https://core.telegram.org/bots/api#copymessages
   */
  public const int MessagesCopy = 100;
  /**
   * @link https://core.telegram.org/bots/api#deletemessages
   */
  public const int MessagesDelete = 100;
  /**
   * https://core.telegram.org/bots/api#forwardmessages
   */
  public const int MessagesForward = 100;
  public const int MediaGroup = 10;
  /**
   * @link https://core.telegram.org/bots/api#setmyname
   */
  public const int Name = 64;
  /**
   * @link https://core.telegram.org/bots/api#sendpaidmedia
   */
  public const int Payload = 128;
  /**
   * @link https://core.telegram.org/bots/api#sendpoll
   */
  public const int PollExplanation = 200;
  /**
   * @link https://core.telegram.org/bots/api#sendpoll
   */
  public const int PollOptionsMax = 12;
  /**
   * @link https://core.telegram.org/bots/api#sendpoll
   */
  public const int PollOptionsMin = 2;
  /**
   * https://core.telegram.org/bots/api#inputpolloption
   */
  public const int PollOptionText = 100;
  /**
   * @link https://core.telegram.org/bots/api#sendpoll
   */
  public const int PollQuestion = 300;
  /**
   * @link https://core.telegram.org/bots/api#replyparameters
   */
  public const int Quote = 1024;
  public const int Text = 4096;
}