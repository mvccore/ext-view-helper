# MvcCore - Extension - View Helper

[![Latest Stable Version](https://img.shields.io/badge/Stable-v5.2.0-brightgreen.svg?style=plastic)](https://github.com/mvccore/ext-view-helper/releases)
[![License](https://img.shields.io/badge/License-BSD%203-brightgreen.svg?style=plastic)](https://mvccore.github.io/docs/mvccore/5.0.0/LICENSE.md)
![PHP Version](https://img.shields.io/badge/PHP->=5.4-brightgreen.svg?style=plastic)

Abstract class code and interface support code to create more sofisticated view helpers with better setup and protected properties.

## Installation
```shell
composer require mvccore/ext-view-helper
```
## Example

Your custom primitive view helper code:
```php
// located in `/App/Views/Helpers/FormatNumber.php`

namespace App\Views\Helpers;

class FormatNumber {
	public function FormatNumber ($number) { // $number = 1234.56;
		return number_format($number); // english notation - 1,234
	}
}
```

... could be more sofisticated with this package:
```php
// located in `/App/Views/Helpers/FormatNumber.php`

namespace App\Views\Helpers;

class FormatNumber extends \MvcCore\Ext\Views\Helpers\AbstractHelper
	public function FormatNumber ($number) { // $number = 1234.56;
		if ($this->request->GetLang() == 'fr') {
			return number_format($number, 2, ',', ' '); // french notation: 1 234,56
		} else {
			return number_format($number); // english notation: 1,234
		}
	}
}
```

# Automaticly assigned protected properties
- `AbstractHelper::$view` as `\MvcCore\View|\MvcCore\IView`
- `AbstractHelper::$controller` as `\MvcCore\Controller|\MvcCore\IController`
- `AbstractHelper::$request` as `\MvcCore\Request|\MvcCore\IRequest`
- `AbstractHelper::$response` as `\MvcCore\Response|\MvcCore\IResponse`

# Behaviour
- Your view helper will be created by static method `GetInstance()` as singleton with abstract class `AbstractHelper`.
- Everytime, when there will be rendered different view script (action view, layout view or sub-controller view), there will be called automatically method `AbstractHelper::SetView($view);` to setup view object or other objects inside helper to actual ones.
