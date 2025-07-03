<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\{
  TgEntity,
  TgMessageData,
  TgPhotoSize
};
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface
};

/**
 * Message is a game, information about the game.
 * @link https://core.telegram.org/bots/api#game
 * @version 2025.07.03.01
 */
readonly class TgGame
implements TgEventInterface, TgForwadableInterface{
  public TgMessageData $Data;
  /**
   * Title of the game
   */
  public string $Title;
  /**
   * Description of the game
   */
  public string $Description;
  /**
   * Photo that will be displayed in the game message in chats.
   */
  public array $Photo;
  /**
   * Brief description of the game or high scores included in the game message. Can be automatically edited to include current high scores for the game when the bot calls setGameScore, or manually edited using editMessageText. 0-4096 characters.
   */
  public string|null $Text;
  /**
   * Special entities that appear in text, such as usernames, URLs, bot commands, etc.
   */
  public array $Entities;
  /**
   * Optional. Animation that will be displayed in the game message in chats. Upload via BotFather
   */
  public TgAnimation|null $Animation;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Title = $Data['game']['title'];
    $this->Description = $Data['game']['description'];
    $this->Text = $Data['game']['text'] ?? null;
    if(isset($Data['game']['animation'])):
      $this->Animation = new TgAnimation($Data['game']);
    else:
      $this->Animation = null;
    endif;

    foreach($Data['game']['photo'] ?? [] as &$photo):
      $photo = new TgPhotoSize($photo);
    endforeach;
    $this->Photo = $Data['game']['photo'] ?? [];

    foreach($Data['game']['entities'] ?? [] as &$entity):
      $entity = new TgEntity($entity);
    endforeach;
    $this->Entities = $Data['game']['entities'] ?? [];
  }
}