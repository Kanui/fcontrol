<?php

namespace FControl\Parameter;

use FControl\Exceptions\EnumeratorDataNotFound;

/**
 * @package FControl\Parameter
 */
abstract class AbstractEnumerator extends AbstractParameter
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var int
     */
    protected $code;
    protected $codeNames = array();
    protected $isConstantName = false;

    /**
     * @param string $input
     */
    public function __construct($input)
    {
        $this->check($input);
        $this->name = $this->translate($input);
        $this->code = $this->getCodeFromName($this->getName());
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param int $code
     * @return bool
     */
    public function isValidCode($code)
    {
        return array_key_exists($code, $this->codeNames);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function isValidName($name)
    {
        return in_array($name, $this->codeNames);
    }

    /**
     * @param int $code
     * @return string
     */
    public function getNameFromCode($code)
    {
        return $this->codeNames[$code];
    }

    /**
     * @param string $name
     * @return string
     */
    public function getCodeFromName($name)
    {
        $codeNames = array_flip($this->codeNames);
        return $codeNames[$name];
    }

    /**
     * @param string $input
     * @return string
     */
    protected function translate($input)
    {
        if ($this->isValidCode($input)) {
            $input = $this->getNameFromCode($input);
        }
        return $input;
    }

    /**
     * @param string $input
     * @return string
     */
    protected function check($input)
    {
        if (!$this->isValidCode($input) && !$this->isValidName($input)) {
            throw new EnumeratorDataNotFound(substr(strrchr(get_class($this), '\\'),1), $input);
        }
    }
}
