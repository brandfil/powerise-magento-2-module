# Magento 2 Powerise.io Integration Module
This module integrates Magento 2 with Powerise.io, a software that generates product descriptions using artificial intelligence. With this integration, you can automatically generate unique and high-quality product descriptions for your Magento store, improving the customer experience and SEO.

## Installation
To install this module, follow these steps:

1. Download the latest release from the [releases page](https://github.com/brandfil/powerise-magento-2-module/releases).
2. Upload the contents of the app directory to your Magento 2 installation's app directory.
3. Run the following command in your Magento 2 installation directory:

```
bin/magento module:enable Powerise_Integration
bin/magento setup:upgrade
```

4. Clear the cache by running the following command:
```
bin/magento cache:clean
```
5. Configure the module by going to the Magento 2 admin panel > Stores > Configuration > Powerise.


## Configuration
To use the module, you need to obtain an API key from Powerise.io. Once you have the API key, go to the Magento 2 admin panel > Stores > Configuration > Powerise.io and enter the API key in the API Key field. You can also configure other options such as the product description length and the product categories to be excluded from the description generation process.


## Support
If you encounter any issues or have any questions, please open an issue on the [GitHub repository](https://github.com/brandfil/powerise-magento-2-module/issues).

## Contributing
If you would like to contribute to this module, please fork the repository and submit a pull request.

## License
This module is licensed under the [MIT License](./LICENSE.md). See the [LICENSE](./LICENSE.md) file for more information.




