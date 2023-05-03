# Magento 2 Powerise.io Integration Module
This module integrates Magento 2 with Powerise.io, a software that generates product descriptions using artificial intelligence. With this integration, you can automatically generate unique and high-quality product descriptions for your Magento store, improving the customer experience and SEO.

## Installation
#### Using Composer 
```
composer require powerise/module-integration
```

#### By copying files to the server
To install this module, follow these steps:

1. Download the latest release from the [releases page](https://github.com/brandfil/powerise-magento-2-module/releases).
2. Upload the contents of the app directory to folder `app/code/Powerise/Integration`

#### Run the following command in your Magento 2 installation directory:

```
php bin/magento module:enable Powerise_Integration
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy
```

#### Configure the module
 Configure the module by going to the Magento 2 admin panel > Stores > Configuration > Powerise.


## Configuration
To use the module, you need to connect your e-commerce to Powerise. Log in to Magento 2 admin panel > Stores > Configuration > Powerise. Press the button "Connect" and link your e-commerce with Powerise.


## Support
If you encounter any issues or have any questions, please open an issue on the [GitHub repository](https://github.com/brandfil/powerise-magento-2-module/issues).

## Contributing
If you would like to contribute to this module, please fork the repository and submit a pull request.

## License
This module is licensed under the [MIT License](./LICENSE.md). See the [LICENSE](./LICENSE.md) file for more information.




