<?php

namespace perf\Emailing;

/**
 *
 *
 * @package perf
 */
class EmailSender
{

    /**
     * E-mail recipient separator.
     *
     * @var string
     */
    private $emailRecipientSeparator = ', ';

    /**
     * E-mail header end-of-line string.
     *
     * @var string
     */
    private $headerEndOfLineString = "\r\n";

    /**
     * Sets e-mail recipient separator.
     *
     * @param string $separator E-mail recipient separator.
     * @return void
     */
    public function setEmailRecipientSeparator($separator)
    {
        $this->emailRecipientSeparator = (string) $separator;
    }

    /**
     * Sets e-mail header end-of-line string.
     *
     * @param string $string E-mail header end-of-line string.
     * @return void
     */
    public function setHeaderEndOfLineString($string)
    {
        $this->headerEndOfLineString = (string) $string;
    }

    /**
     * Sends provided e-mail.
     *
     * @param Email $email
     * @return void
     * @throws \RuntimeException
     */
    public function send(Email $email)
    {
        $to                = $this->buildRecipientsString($email->getTo());
        $additionalHeaders = $this->buildAdditionalHeaders($email);

        if (!mail($to, $email->getSubject(), $email->getMessage(), $additionalHeaders)) {
            throw new \RuntimeException('Unable to send email.');
        }
    }

    /**
     * Builds e-mail additional headers.
     *
     * @param Email $email
     * @return string
     */
    protected function buildAdditionalHeaders(Email $email)
    {
        $additionalHeaders = array();

        $from = $email->getFrom();
        if (!is_null($from)) {
            $additionalHeaders[] = "From: {$from}";
        }

        $replyTo = $email->getReplyTo();
        if (!is_null($replyTo)) {
            $additionalHeaders[] = "Reply-To: {$replyTo}";
        }

        $cc = $email->getCc();
        if (count($cc) > 0) {
            $recipients = $this->buildRecipientsString($cc);
            $additionalHeaders[] = "Cc: {$recipients}";
        }

        $bcc = $email->getBcc();
        if (count($bcc) > 0) {
            $recipients = $this->buildRecipientsString($bcc);
            $additionalHeaders[] = "Bcc: {$recipients}";
        }

        $additionalHeaders[] = 'MIME-Version: 1.0';

        if ($email->isHtml()) {
            $contentType = 'text/html';
        } else {
            $contentType = 'text/plain';
        }

        $additionalHeaders[] = "Content-Type: {$contentType}; charset=\"{$email->getCharset()}\"";

        return join($this->headerEndOfLineString, $additionalHeaders);
    }

    /**
     *
     *
     * @param string[] $recipients
     * @return string
     */
    private function buildRecipientsString(array $recipients)
    {
        return join($this->emailRecipientSeparator, $recipients);
    }
}
