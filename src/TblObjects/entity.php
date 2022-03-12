<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.03.12.00

class TblEntities{
  static function ToJson(array $Entities){
    /** @var TgEntity $ent */
    $entities = [];
    foreach($Entities as $ent):
      $temp = [];
      $temp['type'] = $ent->Type->value;
      $temp['offset'] = $ent->Offset;
      $temp['length'] = $ent->Length;
      if($ent->Type === TgEntityType::Link):
        $temp['url'] = $ent->Url;
      elseif($ent->Type === TgEntityType::MentionText):
        $temp['user'] = $ent->User;
      elseif($ent->Type === TgEntityType::Pre):
        $temp['language'] = $ent->Language;
      endif;
      $entities[] = $temp;
    endforeach;
    return json_encode($entities);
  }
}