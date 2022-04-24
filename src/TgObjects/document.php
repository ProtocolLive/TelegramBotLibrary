<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.03.24.01

class TgDocument{
  public readonly TgMessage $Message;
  public readonly string $Id;
  public readonly string $IdUnique;
  public readonly string $Name;
  public readonly string $Mime;
  public readonly int $Size;
  public readonly string|null $MediaGroup;

  public function __construct(array $Data){
    $this->Message = new TgMessage($Data);
    $this->Id = $Data['document']['file_id'];
    $this->IdUnique = $Data['document']['file_unique_id'];
    $this->Name = $Data['document']['file_name'];
    $this->Mime = $Data['document']['mime_type'];
    $this->Size = $Data['document']['file_size'];
    $this->MediaGroup = $Data['media_group_id'] ?? null;
  }
}

class TgDocumentEdited extends TgDocument{
  public readonly int $DateEdited;

  /**
   * New version of a message that is known to the bot and was edited
   * @link https://core.telegram.org/bots/api#message
   */
  public function __construct(array $Data){
    parent::__construct($Data);
    $this->DateEdited = $Data['edit_date'];
  }
}