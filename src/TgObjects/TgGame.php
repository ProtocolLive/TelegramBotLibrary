<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * Message is a game, information about the game.
 * @link https://core.telegram.org/bots/api#game
 * @version 2023.12.20.00
 */
final class TgGame{
  public readonly TgMessageData $Data;
  /**
   * Title of the game
   */
  public readonly string $Title;
  /**
   * Description of the game
   */
  public readonly string $Description;
  /**
   * Photo that will be displayed in the game message in chats.
   */
  public array $Photo;
  /**
   * Brief description of the game or high scores included in the game message. Can be automatically edited to include current high scores for the game when the bot calls setGameScore, or manually edited using editMessageText. 0-4096 characters.
   */
  public readonly string|null $Text;
  /**
   * Special entities that appear in text, such as usernames, URLs, bot commands, etc.
   */
  public array $Entities = [];
  /**
   * Optional. Animation that will be displayed in the game message in chats. Upload via BotFather
   */
  public readonly TgAnimation|null $Animation;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Title = $Data['title'];
    $this->Description = $Data['description'];
    foreach($Data['photo'] as $photo):
      $this->Photo[] = new TgPhotoSize($photo);
    endforeach;
    $this->Text = $Data['text'] ?? null;
    if(isset($Data['entities'])):
      foreach($Data['entities'] as $entity):
        $this->Entities[] = new TgEntity($entity);
      endforeach;
    endif;
    if(isset($Data['animation'])):
      $this->Animation = new TgAnimation($Data['animation']);
    else:
      $this->Animation = null;
    endif;
  }
}