<?php

namespace ride\application\elastic;

use Elasticsearch\ClientBuilder;

use ride\library\config\Config;

/**
 * Factory to create an elastic client from the Ride configuration
 */
class ClientFactory {

    /**
     * Name of the parameter for the hosts
     * @var string
     */
    const PARAM_HOSTS = 'elastic.hosts';

    /**
     * Name of the parameter for the retries
     * @var string
     */
    const PARAM_RETRIES = 'elastic.retries';

    /**
     * Constructs a new client factory
     * @param \ride\library\config\Config $config
     * @return null
     */
    public function __construct(Config $config) {
        $this->config = $config;
    }

    /**
     * Creates an elastic client from the Ride configuration
     * @return \Elasticsearch\Client
     */
    public function createClient() {
        $parameters = array(
            'hosts' => $this->config->get(self::PARAM_HOSTS, array('localhost:9200')),
            'retries' => $this->config->get(self::PARAM_RETRIES, 1),
        );

        return ClientBuilder::fromConfig($parameters);

        // $clientBuilder = ClientBuilder::create();
        // $clientBuilder->setHosts($hosts);
        // $clientBuilder->setRetries($retries);

        // return $clientBuilder->build();
    }

}
