<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.03.11.00

enum TblMarkupTypes{
  case Inline;
  case Keyboard;
  case KeyboardRemove;
  case Reply;
}

class TblMarkup{
  private TblMarkupTypes $Type;
  private array $Markup = [];

  public function __construct(TblMarkupTypes $Type){
    $this->Type = $Type;
    if($Type === TblMarkupTypes::Inline):
      $this->Markup['inline_keyboard'] = [];
    elseif($Type === TblMarkupTypes::Keyboard):
      $this->Markup['keyboard'] = [];
    elseif($Type === TblMarkupTypes::KeyboardRemove):
      $this->Markup['remove_keyboard'] = true;
    elseif($Type === TblMarkupTypes::Reply):
      $this->Markup['force_reply'] = true;
    endif;
  }

  /**
   * Get the markup object in json format
   */
  public function Get():string{
    return json_encode($this->Markup);
  }

  public function ButtonUrl(
    int $Line,
    int $Column,
    string $Text,
    string $Url
  ):bool{
    if($this->Type === TblMarkupTypes::Inline):
      $this->Markup['inline_keyboard'][$Line][$Column] = [
        'text' => $Text,
        'url' => $Url
      ];
      return true;
    else:
      return false;
    endif;
  }

  public function ButtonLogin(
    int $Line,
    int $Column,
    string $Text,
    string $Url,
    bool $Write = null,
    string $ForwardText = null,
    string $BotName = null
  ):bool{
    if($this->Type === TblMarkupTypes::Inline):
      $this->Markup['inline_keyboard'][$Line][$Column]['text'] = $Text;
      $this->Markup['inline_keyboard'][$Line][$Column]['login_url']['url'] = $Url;
      if($ForwardText !== null):
        $this->Markup['inline_keyboard'][$Line][$Column]['login_url']['forward_text'] = $ForwardText;
      endif;
      if($BotName !== null):
        $this->Markup['inline_keyboard'][$Line][$Column]['login_url']['bot_username'] = $BotName;
      endif;
      if($Write !== null):
        $this->Markup['inline_keyboard'][$Line][$Column]['login_url']['request_write_access'] = $Write;
      endif;
      return true;
    else:
      return false;
    endif;
  }

  public function ButtonCallback(
    int $Line,
    int $Column,
    string $Text,
    string $Data
  ):bool{
    if(strlen($Data) > TgLimits::CallbackData):
      $this->Error = TblError::LimitCallbackData;
      return null;
    elseif($this->Type === TblMarkupTypes::Inline):
      $this->Markup['inline_keyboard'][$Line][$Column] = [
        'text' => $Text,
        'callback_data' => $Data
      ];
      return true;
    else:
      return false;
    endif;
  }

  public function ButtonQuery(
    int $Line,
    int $Column,
    string $Text,
    string $Query,
    bool $OtherChat = false
  ):bool{
    if($this->Type === TblMarkupTypes::Inline):
      $this->Markup['inline_keyboard'][$Line][$Column]['text'] = $Text;
      if($OtherChat):
        $this->Markup['inline_keyboard'][$Line][$Column]['switch_inline_query'] = $Query;
      else:
        $this->Markup['inline_keyboard'][$Line][$Column]['switch_inline_query_current_chat'] = $Query;
      endif;
      return true;
    else:
      return false;
    endif;
  }

  public function ReplyOptions(
    bool $Selective,
    string $PlaceHolder = null
  ):bool{
    if($this->Type === TblMarkupTypes::Reply):
      $this->Markup['input_field_placeholder'] = $PlaceHolder;
      $this->Markup['selective'] = $Selective;
      return true;
    else:
      return false;
    endif;
  }

  public function RemoveOptions(
    bool $Selective
  ):bool{
    if($this->Type === TblMarkupTypes::KeyboardRemove):
      $this->Markup['selective'] = $Selective;
      return true;
    else:
      return false;
    endif;
  }

  public function KeyboardOptions(
    bool $Selective,
    bool $Resize = false,
    bool $OneTime = false,
    string $Placeholder = null
  ):bool{
    if($this->Type === TblMarkupTypes::Keyboard):
      $this->Markup['selective'] = $Selective;
      $this->Markup['resize_keyboard'] = $Resize;
      $this->Markup['one_time_keyboard'] = $OneTime;
      if($Placeholder !== null):
        $this->Markup['input_field_placeholder'] = $Placeholder;
      endif;
      return true;
    else:
      return false;
    endif;
  }

  public function ButtonKeyboard(
    int $Line,
    int $Column,
    string $Text,
    bool $Contact = false,
    bool $Location = false,
    string $Poll = null
  ):bool{
    if($this->Type === TblMarkupTypes::Keyboard):
      $this->Markup['keyboard'][$Line][$Column]['text'] = $Text;
      if($Contact):
        $this->Markup['keyboard'][$Line][$Column]['request_contact'] = $Contact;
      endif;
      if($Location):
        $this->Markup['keyboard'][$Line][$Column]['request_location'] = $Location;
      endif;
      if($Poll !== null):
        $this->Markup['keyboard'][$Line][$Column]['request_poll']['type'] = $Poll;
      endif;
      return true;
    else:
      return false;
    endif;
  }
}