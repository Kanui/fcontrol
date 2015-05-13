<?php
/**
 * Created by PhpStorm.
 * User: aspinelli
 * Date: 3/23/15
 * Time: 5:30 PM
 * @author Antonio Spinelli <antonio.spinelli@kanui.com.br>
 */

namespace FControl\Parameter;

use FControl\Configuration;
use FControl\ConfigurationInterface;

/**
 * Class Authentication
 * @package FControl\Parameter
 */
class Authentication extends AbstractParameter
{
    protected $parameters = array(
        'Login' => null,
        'Senha' => null,
        'IdentificadorLojaFilho' => null,
    );

    public function __construct($username, $password, $storeId = null)
    {
        $this->Login = $username;
        $this->Senha = $password;
        $this->IdentificadorLojaFilho = $storeId;
    }

    /**
     * Create a Authentication object from Configuration.
     * @param ConfigurationInterface $configuration
     * @return Authentication
     */
    public static function createFromConfiguration(ConfigurationInterface $configuration)
    {
        $auth = new static($configuration->getLogin(), $configuration->getPassword(), $configuration->getStoreId());
        return $auth;
    }

    public function jsonSerialize()
    {
        $data = $this->parameters;
        if (is_null($data['IdentificadorLojaFilho'])) {
            unset($data['IdentificadorLojaFilho']);
        }
        return $data;
    }
}
