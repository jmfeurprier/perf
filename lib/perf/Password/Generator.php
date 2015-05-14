<?php

namespace perf\Password;

/**
 * This class allows to generate random passwords based on specific constraints:
 *   character dictionary, minimum and maximum lengths.
 *
 */
class Generator
{

    /**
     * Characters to be used to generate passwords.
     *
     * @var string
     */
    private $dictionary = 'abcdefghjkmnpqrstuvwxyz23456789';

    /**
     * Minimum length of the passwords to be generated.
     *
     * @var int
     */
    private $lengthMin = 8;

    /**
     * Maximum length of the passwords to be generated.
     *
     * @var int
     */
    private $lengthMax = 8;

    /**
     * Sets the characters to be used to generate passwords.
     *
     * @param string $dictionary Characters to be used to generate passwords.
     * @return void
     * @throws \InvalidArgumentException
     */
    public function setDictionary($dictionary)
    {
        $dictionary = (string) $dictionary;

        if (mb_strlen($dictionary) < 1) {
            throw new \InvalidArgumentException();
        }

        $this->dictionary = $dictionary;
    }

    /**
     * Sets the minimum length of the passwords to be generated.
     *
     * @param int $lengthMin Minimum length of the passwords to be generated.
     * @return void
     * @throws \InvalidArgumentException
     */
    public function setLengthMin($lengthMin)
    {
        $lengthMin = (int) $lengthMin;

        if ($lengthMin < 0) {
            throw new \InvalidArgumentException();
        }

        $this->lengthMin = $lengthMin;

        if ($this->lengthMax < $this->lengthMin) {
            $this->lengthMax = $this->lengthMin;
        }
    }

    /**
     * Sets the maximum length of the passwords to be generated.
     *
     * @param int $lengthMax Maximum length of the passwords to be generated.
     * @return void
     * @throws \InvalidArgumentException
     */
    public function setLengthMax($lengthMax)
    {
        $lengthMax = (int) $lengthMax;

        if ($lengthMax < 0) {
            throw new \InvalidArgumentException();
        }

        $this->lengthMax = $lengthMax;

        if ($this->lengthMin > $this->lengthMax) {
            $this->lengthMin = $this->lengthMax;
        }
    }

    /**
     * Sets the (fixed) length of the passwords to be generated.
     *
     * @param int $length Length of the passwords to be generated.
     * @return void
     * @throws \InvalidArgumentException
     */
    public function setLength($length)
    {
        $length = (int) $length;

        if ($length < 0) {
            throw new \InvalidArgumentException();
        }

        $this->lengthMin = $length;
        $this->lengthMax = $length;
    }

    /**
     * Generates a new password.
     *
     * @return string Generated password.
     */
    public function getPassword()
    {
        $maxIndex = mb_strlen($this->dictionary) - 1;

        $length = mt_rand($this->lengthMin, $this->lengthMax);

        $password = '';

        for ($i = 0; $i < $length; ++$i) {
            $password .= $this->dictionary{mt_rand(0, $maxIndex)};
        }

        return $password;
    }
}
