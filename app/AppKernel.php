<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new FOS\RestBundle\FOSRestBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new Nelmio\ApiDocBundle\NelmioApiDocBundle(),
            new Nelmio\CorsBundle\NelmioCorsBundle(),
            new Liip\ThemeBundle\LiipThemeBundle(),
            new Bazinga\Bundle\HateoasBundle\BazingaHateoasBundle(),
            new Lexik\Bundle\FormFilterBundle\LexikFormFilterBundle(),
            new FOS\OAuthServerBundle\FOSOAuthServerBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Scheb\TwoFactorBundle\SchebTwoFactorBundle(),
            new KPhoen\RulerZBundle\KPhoenRulerZBundle(),
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new Craue\ConfigBundle\CraueConfigBundle(),
            new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new BD\GuzzleSiteAuthenticatorBundle\BDGuzzleSiteAuthenticatorBundle(),

            // wallabag bundles
            new Wallabag\CoreBundle\WallabagCoreBundle(),
            new Wallabag\ApiBundle\WallabagApiBundle(),
            new Wallabag\UserBundle\WallabagUserBundle(),
            new Wallabag\ImportBundle\WallabagImportBundle(),
            new Wallabag\AnnotationBundle\WallabagAnnotationBundle(),
            new OldSound\RabbitMqBundle\OldSoundRabbitMqBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();

            if ('test' === $this->getEnvironment()) {
                $bundles[] = new DAMA\DoctrineTestBundle\DAMADoctrineTestBundle();
            }
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
        $loader->load(function ($container) {
           if ($container->getParameter('use_webpack_dev_server')) {
               $container->loadFromExtension('framework', [
                   'assets' => [
                       'base_url' => 'http://localhost:8080/',
                   ],
               ]);
           }
        });
    }
}
