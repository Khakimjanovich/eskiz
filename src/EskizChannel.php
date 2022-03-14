<?php

namespace NotificationChannels\Eskiz;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Notifications\Notification;
use NotificationChannels\Eskiz\Exceptions\CouldNotSendNotification;

class EskizChannel
{
    /**
     * @var Eskiz
     */
    protected Eskiz $eskiz;

    /**
     * @param Eskiz $eskiz
     */
    public function __construct(Eskiz $eskiz)
    {
        $this->eskiz = $eskiz;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     *
     * @return mixed|void
     * @throws CouldNotSendNotification
     * @throws GuzzleException
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toEskiz($notifiable);

        // No EskizMessage object was returned
        if (is_string($message)) {
            $message = EskizMessage::create($message);
        }

        if (!$message->hasToNumber()) {
            if (!$to = $notifiable->phone_number) {
                $to = $notifiable->routeNotificationFor('sms');
            }

            if (!$to) {
                throw CouldNotSendNotification::phoneNumberNotProvided();
            }

            $message->to($to);
        }

        $params = $message->toArray();

        if ($message instanceof EskizMessage) {
            $response = $this->eskiz->sendMessage($params);
        } else {
            return;
        }

        return json_decode($response->getBody()->getContents(), true);
    }
}
