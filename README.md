## Module for exposing issue with Doctrine annotation in FO

### Requirements

1. Composer, see [Composer](https://getcomposer.org/) to learn more
2. Yarn, see [Yarn](https://yarnpkg.com/lang/en/) to learn more
 
### How to install

1. Download or clone module into `modules` directory of your PrestaShop installation
2. `cd` into module's directory and run following command:
	 - `composer dumpautoload` to generate autoloader for module
3. Install module from Back Office

### How to reproduct the issue

1. Go to the module front controller `./module/doctrineannotation/test`

### To fix the issue

1. Go to the Da_Test entity
2. Uncomment line 9-10
