<?php

namespace perf\Emailing;

use \perf\String;

/**
 * E-mail container.
 *
 * @package perf
 */
class Email
{

    /**
     * HTML flag.
     *
     * @var string
     */
    private $html = false;

    /**
     * Charset.
     *
     * @var string
     */
    private $charset = 'utf-8';

    /**
     * From e-mail address.
     *
     * @var null|string
     */
    private $from = null;

    /**
     * "Reply-to" e-mail address.
     *
     * @var null|string
     */
    private $replyTo = null;

    /**
     * "To" e-mail addresses.
     *
     * @var string[]
     */
    private $to = array();

    /**
     * "Cc" e-mail addresses.
     *
     * @var string[]
     */
    private $cc = array();

    /**
     * "Bcc" e-mail adresses.
     *
     * @var string[]
     */
    private $bcc = array();

    /**
     * Subject.
     *
     * @var string
     */
    private $subject = '';

    /**
     * Message.
     *
     * @var string
     */
    private $message = '';

    /**
     * Sets the HTML flag.
     *
     * @param bool $html if true, e-mail should be sent as HTML.
     * @return Email Fluent return.
     */
    public function setHtml($html)
    {
        $this->html = (bool) $html;

        return $this;
    }


    /**
     * Sets which charset should be used for the e-mail.
     *
     * @param string $charset charset to be used.
     * @return Email Fluent return.
     */
    public function setCharset($charset)
    {
        $this->charset = (string) $charset;

        return $this;
    }

    /**
     * Sets the sender of the e-mail.
     *
     * @param null|string $emailAddress
     * @return Email Fluent return.
     * @throws \InvalidArgumentException
     */
    public function setFrom($emailAddress)
    {
        if (is_null($emailAddress)) {
            $this->from = null;
        } elseif (String\Email::validate($emailAddress)) {
            $this->from = (string) $emailAddress;
        } else {
            throw new \InvalidArgumentException();
        }

        return $this;
    }

    /**
     * Sets the e-mail address to use for replying.
     *
     * @param null|string $emailAddress
     * @return Email fluent return
     * @throws \InvalidArgumentException
     */
    public function setReplyTo($emailAddress)
    {
        if (is_null($emailAddress)) {
            $this->replyTo = $emailAddress;
        } elseif (String\Email::validate($emailAddress)) {
            $this->replyTo = (string) $emailAddress;
        } else {
            throw new \InvalidArgumentException();
        }

        return $this;
    }

    /**
     * Adds a recipient e-mail address.
     *
     * @param string $emailAddress
     * @return Email fluent return
     * @throws \InvalidArgumentException
     */
    public function addTo($emailAddress)
    {
        if (String\Email::validate($emailAddress)) {
            $this->to[] = (string) $emailAddress;

            return $this;
        }

        throw new \InvalidArgumentException();
    }

    /**
     * Adds a "Cc" e-mail address.
     *
     * @param string $emailAddress
     * @return Email fluent return
     * @throws \InvalidArgumentException
     */
    public function addCc($emailAddress)
    {
        if (String\Email::validate($emailAddress)) {
            $this->cc[] = (string) $emailAddress;

            return $this;
        }

        throw new \InvalidArgumentException();
    }

    /**
     * Adds a "Bcc" e-mail address.
     *
     * @param string $emailAddress e-mail address
     * @return Email fluent return
     * @throws \InvalidArgumentException
     */
    public function addBcc($emailAddress)
    {
        if (String\Email::validate($emailAddress)) {
            $this->bcc[] = (string) $emailAddress;

            return $this;
        }

        throw new \InvalidArgumentException();
    }

    /**
     * Sets subject.
     *
     * @param string $subject
     * @return Email fluent return
     */
    public function setSubject($subject)
    {
        $this->subject = (string) $subject;

        return $this;
    }

    /**
     * Sets message.
     *
     * @param string $message
     * @return Email fluent return
     */
    public function setMessage($message)
    {
        $this->message = (string) $message;

        return $this;
    }

    /**
     * Returns true if the e-mail should be sent as HTML, or false for plain text.
     *
     * @return bool
     */
    public function isHtml()
    {
        return $this->html;
    }

    /**
     * Sets which charset should be used for the e-mail.
     *
     * @return string charset to be used.
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * Returns the sender of the e-mail.
     *
     * @return null|string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Returns the e-mail address to use for replying.
     *
     * @return null|string
     */
    public function getReplyTo()
    {
        return $this->replyTo;
    }

    /**
     * Returns "To" e-mail addresses.
     *
     * @return string[]
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Returns "Cc" e-mail addresses.
     *
     * @return string[]
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * Returns "Bcc" e-mail addresses.
     *
     * @return string[]
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * Returns subject.
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Returns message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}
