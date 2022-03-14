<?php

namespace NotificationChannels\Eskiz;

class EskizMessage
{
    protected $payload = [];

    /**
     * @param string $message
     */
    public function __construct(string $message = '')
    {
        $this->payload['text'] = $message;
    }

    /**
     * Return new EskizMessage object.
     *
     * @param string $message
     * @return EskizMessage
     */
    public static function create(string $message = ''): self
    {
        return new self($message);
    }

    /**
     * Get the payload value for a given key.
     *
     * @param string $key
     *
     * @return mixed|null
     */
    public function getPayloadValue(string $key)
    {
        return $this->payload[$key] ?? null;
    }

    /**
     * Returns if recipient number is given or not.
     *
     * @return bool
     */
    public function hasToNumber(): bool
    {
        return isset($this->payload['to']);
    }

    /**
     * Return payload.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->payload;
    }

    /**
     * Set message content.
     *
     * @param string $message
     * @return EskizMessage
     */
    public function content(string $message): self
    {
        $this->payload['message'] = $message;

        return $this;
    }

    /**
     * Set recipient phone number.
     *
     * @param string $to
     * @return EskizMessage
     */
    public function to(string $to): self
    {
        $this->payload['mobile_phone'] = $to;

        return $this;
    }

    /**
     * Set sender name.
     *
     * @return EskizMessage
     */
    public function from(): self
    {
        $this->payload['from'] = config('services.eskiz.from');

        return $this;
    }
}
