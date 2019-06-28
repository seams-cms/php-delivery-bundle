### Seams-CMS delivery bundle for Symfony

This repository hosts the Symfony bundle for the Seams-CMS delivery API to allow easy integration of the SDK 
within your Symfony projects.


### Usage

1.Install the bundle through composer

    composer req SeamsCMS/delivery-bundle

2.Add the following line to your `config/bundles.php`:

     SeamsCMS\DeliveryBundle\SeamsCMSDeliveryBundle::class => ['all' => true],

3.Create a configuration file in `config/packages/seams-cms.yaml`:

    seams_cms_delivery:
        clients:
            default:
                api_key: "<apikey>"
                workspace: "<workspace>"
                options:
                    debug: false

This creates a `@seams_cms_delivery.client.default` service that you can use. For more information
about using the actual client, see the documentation of the seams-cms/delivery-sdk package.


### Contributing

Please read the [CONTRIBUTION](CONTRIBUTION.md) file for more information on how to contribute.


### Running tests

Note that when running tests, you must install all the composer packages first. Run `composer install` 
in the current directory to install all (development) packages before running the tests. 

Running unit tests:

    ./vendor/bin/phpunit

Running code sniffer:

    ./vendor/bin/phpcs src/
