<?php

declare(strict_types=1);

namespace Infra\Symfony;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

final class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import("{$this->getProjectDir()}/config/parameters.yaml");
        $container->import("{$this->getProjectDir()}/config/{parameters}_$this->environment.yaml");

        $container->import("{$this->getProjectDir()}/config/{packages}/*.yaml");
        $container->import("{$this->getProjectDir()}/config/{packages}/$this->environment/*.yaml");

        $container->import("{$this->getProjectDir()}/config/services.yaml");
        $container->import("{$this->getProjectDir()}/config/{services}_$this->environment.yaml");
    }
}
