<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
use ProtocolLive\TelegramBotLibrary\TblEnums\TblError;
use ProtocolLive\TelegramBotLibrary\TblObjects\{
  TblException,
  TblMarkup
};
use ProtocolLive\TelegramBotLibrary\TgEnums\{
  TgCurrencies,
  TgMethods
};
use ProtocolLive\TelegramBotLibrary\TgObjects\TgInvoice;
use ProtocolLive\TelegramBotLibrary\TgParams\{
  TgInvoicePrices,
  TgInvoiceShippingOptions,
  TgReplyParams,
  TgSuggestedPostParameters
};

/**
 * @version 2025.08.16.00
 */
trait TblInvoiceTrait{
  /**
   * Once the user has confirmed their payment and shipping details, the Bot API sends the final confirmation in the form of an Update with the field pre_checkout_query. Use this method to respond to such pre-checkout queries. Note: The Bot API must receive an answer within 10 seconds after the pre-checkout query was sent.
   * @param string $Id Unique identifier for the query to be answered
   * @param bool $Confirm Specify True if everything is alright (goods are available, etc.) and the bot is ready to proceed with the order. Use False if there are any problems.
   * @param string $ErrorMsg Required if $Confirm is False. Error message in human readable form that explains the reason for failure to proceed with the checkout (e.g. "Sorry, somebody just bought the last of our amazing black T-shirts while you were busy filling out your payment details. Please choose a different color or garment!"). Telegram will display this message to the user.
   * @return bool On success, True is returned.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#answerprecheckoutquery
   */
  public function InvoiceCheckoutSend(
    string $Id,
    bool $Confirm,
    string|null $ErrorMsg = null
  ):bool{
    $param['pre_checkout_query_id'] = $Id;
    $param['ok'] = $Confirm;
    if($Confirm === false):
      $param['error_message'] = $ErrorMsg;
    endif;
    return $this->ServerMethod(TgMethods::InvoiceCheckoutSend, $param);
  }

  /**
   * Use this method to create a link for an invoice.
   * @param string $Title Product name, 1-32 characters
   * @param string $Description Product description, 1-255 characters
   * @param string $Payload Bot-defined invoice payload, 1-128 bytes. This will not be displayed to the user, use for your internal processes.
   * @param string $Token Payment provider token, obtained via @BotFather. Pass an empty string for payments in Telegram Stars.
   * @param TgCurrencies $Currency Three-letter ISO 4217 currency code
   * @param TgInvoicePrices $Prices Price breakdown, a list of components (e.g. product price, tax, discount, delivery cost, delivery tax, bonus, etc.)
   * @param int $TipMax The maximum accepted amount for tips in the smallest units of the currency (integer, not float/double). For example, for a maximum tip of US$ 1.45 pass max_tip_amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies). Defaults to 0
   * @param array $TipSuggested A array of suggested amounts of tips in the smallest units of the currency (integer, not float/double). At most 4 suggested tip amounts can be specified. The suggested tip amounts must be positive, passed in a strictly increased order and must not exceed max_tip_amount.
   * @param string $ProviderData A JSON-serialized data about the invoice, which will be shared with the payment provider. A detailed description of required fields should be provided by the payment provider.
   * @param string $Photo URL of the product photo for the invoice. Can be a photo of the goods or a marketing image for a service. People like it better when they see what they are paying for.
   * @param int $PhotoSize Photo size
   * @param int $PhotoWidth Photo width
   * @param int $PhotoHeight Photo height
   * @param bool $NeedName Pass True, if you require the user's full name to complete the order
   * @param bool $NeedPhone Pass True, if you require the user's phone number to complete the order
   * @param bool $NeedEmail Pass True, if you require the user's email address to complete the order
   * @param bool $NeedAddress Pass True, if you require the user's shipping address to complete the order
   * @param bool $ProviderPhone Pass True, if user's phone number should be sent to provider
   * @param bool $ProviderEmail Pass True, if user's email address should be sent to provider
   * @param bool $PriceWithShipping Pass True, if the final price depends on the shipping method
   * @param int $SubscriptionPeriod The number of seconds the subscription will be active for before the next payment. The currency must be set to “XTR” (Telegram Stars) if the parameter is used. Currently, it must always be 2592000 (30 days) if specified.
   * @param int $BusinessId Unique identifier of the business connection on behalf of which the link will be created
   * @return string Returns the created invoice link as String on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#createinvoicelink
   */
  public function InvoiceLink(
    string $Title,
    string $Description,
    string $Payload,
    TgCurrencies $Currency,
    TgInvoicePrices $Prices,
    string|null $BusinessId = null,
    string|null $Token = null,
    int|null $TipMax = null,
    array|null $TipSuggested = null,
    string|null $ProviderData = null,
    string|null $Photo = null,
    int|null $PhotoSize = null,
    int|null $PhotoWidth = null,
    int|null $PhotoHeight = null,
    bool $NeedName = false,
    bool $NeedPhone = false,
    bool $NeedEmail = false,
    bool $NeedAddress = false,
    bool $ProviderPhone = false,
    bool $ProviderEmail = false,
    bool $PriceWithShipping = false,
    int|null $SubscriptionPeriod = null
  ):string{
    if($Prices->Count() === 0):
      throw new TblException(TblError::InvoicePriceEmpty);
    endif;
    $param['title'] = $Title;
    $param['description'] = $Description;
    $param['payload'] = $Payload;
    $param['provider_token'] = $Token;
    $param['currency'] = $Currency->value;
    $param['prices'] = $Prices->ToArray();
    if(empty($BusinessId) === false):
      $param['business_connection_id'] = $BusinessId;
    endif;
    if($TipMax !== null):
      $param['max_tip_amount'] = $TipMax;
    endif;
    if($TipSuggested !== null):
      $param['suggested_tip_amounts'] = $TipSuggested;
    endif;
    if($ProviderData !== null):
      $param['provider_data'] = $ProviderData;
    endif;
    if($Photo !== null):
      $param['photo_url'] = $Photo;
    endif;
    if($PhotoSize !== null):
      $param['photo_size'] = $PhotoSize;
    endif;
    if($PhotoWidth !== null):
      $param['photo_width'] = $PhotoWidth;
    endif;
    if($PhotoHeight !== null):
      $param['photo_height'] = $PhotoHeight;
    endif;
    if($NeedName):
      $param['need_name'] = true;
    endif;
    if($NeedPhone):
      $param['need_phone_number'] = true;
    endif;
    if($NeedEmail):
      $param['need_email'] = true;
    endif;
    if($NeedAddress):
      $param['need_shipping_address'] = true;
    endif;
    if($ProviderPhone):
      $param['send_phone_number_to_provider'] = true;
    endif;
    if($ProviderEmail):
      $param['send_email_to_provider'] = true;
    endif;
    if($PriceWithShipping):
      $param['is_flexible'] = true;
    endif;
    if($SubscriptionPeriod !== null):
      $param['subscription_period'] = $SubscriptionPeriod;
    endif;
    return $this->ServerMethod(TgMethods::InvoiceLink, $param);
  }

  /**
   * Use this method to send invoices.
   * @param int $Chat Unique identifier for the target chat
   * @param string $Title Product name, 1-32 characters
   * @param string $Description Product description, 1-255 characters
   * @param string $Payload Bot-defined invoice payload, 1-128 bytes. This will not be displayed to the user, use for your internal processes.
   * @param string $Token Payment provider token, obtained via @BotFather. Pass an empty string for payments in Telegram Stars.
   * @param TgCurrencies $Currency Three-letter ISO 4217 currency code
   * @param TgInvoicePrices $Prices Price breakdown, a list of components (e.g. product price, tax, discount, delivery cost, delivery tax, bonus, etc.)
   * @param int $TipMax The maximum accepted amount for tips in the smallest units of the currency (integer, not float/double). For example, for a maximum tip of US$ 1.45 pass max_tip_amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies). Defaults to 0
   * @param array $TipSuggested A array of suggested amounts of tips in the smallest units of the currency (integer, not float/double). At most 4 suggested tip amounts can be specified. The suggested tip amounts must be positive, passed in a strictly increased order and must not exceed max_tip_amount.
   * @param string $StartParam Unique deep-linking parameter. If left empty, forwarded copies of the sent message will have a Pay button, allowing multiple users to pay directly from the forwarded message, using the same invoice. If non-empty, forwarded copies of the sent message will have a URL button with a deep link to the bot (instead of a Pay button), with the value used as the start parameter
   * @param string $ProviderData A JSON-serialized data about the invoice, which will be shared with the payment provider. A detailed description of required fields should be provided by the payment provider.
   * @param string $Photo URL of the product photo for the invoice. Can be a photo of the goods or a marketing image for a service. People like it better when they see what they are paying for.
   * @param int $PhotoSize Photo size
   * @param int $PhotoWidth Photo width
   * @param int $PhotoHeight Photo height
   * @param bool $NeedName Pass True, if you require the user's full name to complete the order
   * @param bool $NeedPhone Pass True, if you require the user's phone number to complete the order
   * @param bool $NeedEmail Pass True, if you require the user's email address to complete the order
   * @param bool $NeedAddress Pass True, if you require the user's shipping address to complete the order
   * @param bool $ProviderPhone Pass True, if user's phone number should be sent to provider
   * @param bool $ProviderEmail Pass True, if user's email address should be sent to provider
   * @param bool $PriceWithShipping Pass True, if the final price depends on the shipping method
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param TgReplyParams $Reply Description of the message to reply to
   * @param TblMarkup $Markup A object for an inline keyboard. If empty, one 'Pay total price' button will be shown. If not empty, the first button must be a Pay button.
   * @param string $Effect Unique identifier of the message effect to be added to the message; for private chats only
   * @param bool $AllowPaid Allow up to 1000 messages per second, ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be withdrawn from the bot's balance
   * @param int $DirectTopic Identifier of the direct messages topic to which the message will be sent; required if the message is sent to a direct messages chat
   * @param TgSuggestedPostParameters $SuggestedPost A JSON-serialized object containing the parameters of the suggested post to send; for direct messages chats only. If the message is sent as a reply to another suggested post, then that suggested post is automatically declined.
   * @return TgInvoice On success, the sent Message is returned.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#sendinvoice
   */
  public function InvoiceSend(
    int $Chat,
    string $Title,
    string $Description,
    string $Payload,
    TgCurrencies $Currency,
    TgInvoicePrices $Prices,
    int|null $DirectTopic = null,
    string|null $Token = null,
    int|null $TipMax = null,
    array|null $TipSuggested = null,
    string|null $StartParam = null,
    string|null $ProviderData = null,
    string|null $Photo = null,
    int|null $PhotoSize = null,
    int|null $PhotoWidth = null,
    int|null $PhotoHeight = null,
    bool $NeedName = false,
    bool $NeedPhone = false,
    bool $NeedEmail = false,
    bool $NeedAddress = false,
    bool $ProviderPhone = false,
    bool $ProviderEmail = false,
    bool $PriceWithShipping = false,
    bool $DisableNotification = false,
    bool $Protect = false,
    TgReplyParams|null $Reply = null,
    bool $AllowPaid = false,
    TblMarkup|null $Markup = null,
    string|null $Effect = null,
    TgSuggestedPostParameters|null $SuggestedPost = null
  ):TgInvoice{
    $param['chat_id'] = $Chat;
    $param['title'] = $Title;
    $param['description'] = $Description;
    $param['payload'] = $Payload;
    $param['provider_token'] = $Token;
    $param['currency'] = $Currency->value;
    $param['prices'] = $Prices->ToArray();
    if($TipMax !== null):
      $param['max_tip_amount'] = $TipMax;
    endif;
    if($TipSuggested !== null):
      $param['suggested_tip_amounts'] = $TipSuggested;
    endif;
    if($StartParam !== null):
      $param['start_parameter'] = $StartParam;
    endif;
    if($ProviderData !== null):
      $param['provider_data'] = $ProviderData;
    endif;
    if($Photo !== null):
      $param['photo_url'] = $Photo;
    endif;
    if($PhotoSize !== null):
      $param['photo_size'] = $PhotoSize;
    endif;
    if($PhotoWidth !== null):
      $param['photo_width'] = $PhotoWidth;
    endif;
    if($PhotoHeight !== null):
      $param['photo_height'] = $PhotoHeight;
    endif;
    if($NeedName):
      $param['need_name'] = true;
    endif;
    if($NeedPhone):
      $param['need_phone_number'] = true;
    endif;
    if($NeedEmail):
      $param['need_email'] = true;
    endif;
    if($NeedAddress):
      $param['need_shipping_address'] = true;
    endif;
    if($ProviderPhone):
      $param['send_phone_number_to_provider'] = true;
    endif;
    if($ProviderEmail):
      $param['send_email_to_provider'] = true;
    endif;
    if($PriceWithShipping):
      $param['is_flexible'] = true;
    endif;
    if($DisableNotification):
      $param['disable_notification'] = true;
    endif;
    if($Protect):
      $param['protect_content'] = true;
    endif;
    if($AllowPaid):
      $param['allow_paid_broadcast'] = true;
    endif;
    if($Reply !== null):
      $param['reply_parameters'] = $Reply->ToArray();
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->ToArray();
    endif;
    if($Effect !== null):
      $param['message_effect_id'] = $Effect;
    endif;
    if($DirectTopic !== null):
      $param['direct_messages_topic_id'] = $DirectTopic;
    endif;
    if($SuggestedPost !== null):
      $param['suggested_post_parameters'] = $SuggestedPost->ToArray();
    endif;
    $return = $this->ServerMethod(TgMethods::InvoiceSend, $param);
    return new TgInvoice($return);
  }

  /**
   * If you sent an invoice requesting a shipping address and the parameter is_flexible was specified, the Bot API will send an Update with a shipping_query field to the bot. Use this method to reply to shipping queries.
   * @param string $Id Unique identifier for the query to be answered
   * @param bool $Confirm Specify True if delivery to the specified address is possible and False if there are any problems (for example, if delivery to the specified address is not possible)
   * @param TgInvoiceShippingOptions $Options Required if ok is True. A JSON-serialized array of available shipping options.
   * @param string $Error Required if ok is False. Error message in human readable form that explains why it is impossible to complete the order (e.g. "Sorry, delivery to your desired address is unavailable'). Telegram will display this message to the user.
   * @return bool On success, True is returned.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#answershippingquery
   */
  public function InvoiceShippingSend(
    string $Id,
    bool $Confirm,
    TgInvoiceShippingOptions|null $Options = null,
    string|null $Error = null
  ):bool{
    $param['shipping_query_id'] = $Id;
    $param['ok'] = $Confirm;
    if($Confirm):
      $param['shipping_options'] = $Options->ToArray();
    else:
      $param['error_message'] = $Error;
    endif;
    return $this->ServerMethod(TgMethods::InvoiceShippingSend, $param);
  }
}