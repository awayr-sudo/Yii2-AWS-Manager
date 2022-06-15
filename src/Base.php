<?php

/**
 * @author AWAYR <hello@awayr.net>
 * @link https://awayr.net
 * 
 */

namespace awayr\aws;

use yii\base\Component;
use Aws\Resource\Aws;
use yii\base\InvalidConfigException;

class Base extends Component
{
    /**
     * @var [type]
     * @var [secret]
     * @var [region]
     * @var [configFile]
     * 
     */
    public $key;
    public $secret;
    public $region;

    public $configFile = false;

    private $_config;
    private $_aws = null;

    /**
     * init
     *
     * @return void
     */
    public function init()
    {
        if ($this->configFile === false) {
            if (!$this->key) {
                throw new InvalidConfigException('Key cannot be empty!');
            }
            if (!$this->secret) {
                throw new InvalidConfigException('Secret cannot be empty!');
            }
            if (!$this->region) {
                throw new InvalidConfigException('Region cannot be empty!');
            }
            $this->_config = [
                'key' => $this->key,
                'secret' => $this->secret,
                'region' => $this->region
            ];
        } else {
            if (!file_exists($this->configFile)) {
                throw new InvalidConfigException("{$this->configFile} does not exist");
            }
            $this->_config = $this->configFile;
        }
    }

    /**
     * getAws
     *
     * @return void
     */
    public function getAws()
    {
        if ($this->_aws === null) {
            $this->_aws =  new Aws($this->_config);
        }

        return $this->_aws;
    }

    public function __call($method, $params)
    {
        $client = $this->getAws();
        if (method_exists($client, $method))
            return call_user_func_array(array($client, $method), $params);

        return parent::__call($method, $params);
    }
}
