<?php

/**
 * MvcCore
 *
 * This source file is subject to the BSD 3 License
 * For the full copyright and license information, please view
 * the LICENSE.md file that are distributed with this source code.
 *
 * @copyright	Copyright (c) 2016 Tom Flídr (https://github.com/mvccore/mvccore)
 * @license		https://mvccore.github.io/docs/mvccore/5.0.0/LICENCE.md
 */

namespace MvcCore\Ext\Views\Helpers;

/**
 * Responsibility - better view helper setup.
 * - Every time, when there is necessary to create view helper, there is called
 *   `\MvcCore\Ext\Views\Helpers\IHelper::GetInstance();` method in `\MvcCore\View`.
 *   All view helpers are stored inside `\MvcCore\View` and they are created only once.
 *   But if you need to configure view helper anytime before, you can use this method
 *   for singleton instancing to configure anything statically anytime before.
 * - Every time, when currently rendered view object is changed (action view, layout view,
 *   sub-controller view...), there is called `\MvcCore\Ext\Views\Helpers\IHelper::SetView($view);`
 *   method giving currently rendered view object. From this object, you can get properties
 *   for better view helper processing like application object, controller, request or response object.
 * @method \MvcCore\Ext\Views\Helpers\IHelper GetInstance()
 */
interface IHelper
{
	/**
	 * Create view helper instance, every time new instance or singleton instance, it's up to you.
	 * @static
	 * @return \MvcCore\Ext\Views\Helpers\IHelper
	 */
	public static function & GetInstance ();

	/**
	 * Set currently rendered view instance every time this helper
	 * is called and the rendered view instance is changed.
	 * This method sets these protected object references:
	 * - `AbstractHelper::$view` as `\MvcCore\View|\MvcCore\IView`
	 * - `AbstractHelper::$controller` as `\MvcCore\Controller|\MvcCore\IController`
	 * - `AbstractHelper::$request` as `\MvcCore\Request|\MvcCore\IRequest`
	 * - `AbstractHelper::$response` as `\MvcCore\Response|\MvcCore\IResponse`
	 * @param \MvcCore\View|\MvcCore\IView $view
	 * @return \MvcCore\Ext\Views\Helpers\IHelper
	 */
	public function & SetView (\MvcCore\IView & $view);
}
