<?php

namespace PhpPact\Consumer\Factory;

use PhpPact\Consumer\Driver\Interaction\InteractionDriver;
use PhpPact\Consumer\Driver\Pact\PactDriver;
use PhpPact\Config\PactConfigInterface;
use PhpPact\Consumer\Service\FFI;
use PhpPact\Consumer\Service\InteractionRegistry;
use PhpPact\Consumer\Service\InteractionRegistryInterface;
use PhpPact\Standalone\MockService\MockServerConfigInterface;
use PhpPact\Consumer\Service\MockServer;

class InteractionRegistryFactory
{
    public static function create(
        PactConfigInterface $pactConfig,
        MockServerConfigInterface $mockServerConfig
    ): InteractionRegistryInterface {
        $ffi = new FFI();
        $pactDriver = new PactDriver($ffi, $pactConfig);
        $interactionDriver = new InteractionDriver($ffi, $pactDriver);
        $mockServer = new MockServer($ffi, $pactDriver, $mockServerConfig);

        return new InteractionRegistry($interactionDriver, $mockServer);
    }
}
