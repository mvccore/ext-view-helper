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
 */
abstract class AbstractHelper implements \MvcCore\Ext\Views\Helpers\IHelper
{
	/**
	 * MvcCore Extension - View Helper - Line Breaks - version:
	 * Comparison by PHP function version_compare();
	 * @see http://php.net/manual/en/function.version-compare.php
	 */
	const VERSION = '5.0.0-alpha';

	protected static $instance = NULL;

	/**
	 * Currently rendered view instance reference.
	 * Every time, when there is rendered different view script,
	 * this view property is changed by method `\MvcCore\Ext\Views\Helpers\AbstractHelper::SetView();`.
	 * @var \MvcCore\View|\MvcCore\IView
	 */
	protected $view = NULL;

	/**
	 * Currently used controller instance reference for currently rendered view script.
	 * Every time, when there is rendered different view script,
	 * this controller and also view property is changed by method `\MvcCore\Ext\Views\Helpers\AbstractHelper::SetView();`.
	 * @var \MvcCore\Controller|\MvcCore\IController
	 */
	protected $controller = NULL;

	/**
	 * Current request object reference from used controller.
	 * @var \MvcCore\Request|\MvcCore\IRequest
	 */
	protected $request = NULL;

	/**
	 * Current response object reference from used controller.
	 * @var \MvcCore\Response|\MvcCore\IResponse
	 */
	protected $response = NULL;

	/**
	 * Create view helper instance as singleton.
	 * To configure view helper instance, create it by this method
	 * in your base controller in `PreDispatch();` method.
	 * After this singleton instance is created, then you can configure
	 * anything you want.
	 *
	 * Example:
	 *	// somewhere in base controller:
	 *	`\MvcCore\Ext\Views\Helpers\LineBreaks::GetInstance()
	 *		->SetView($this->view)
	 *		->SetAnythingElseBeforeRendering(...);`
	 * @return \MvcCore\Ext\Views\Helpers\AbstractHelper
	 */
	public static function & GetInstance () {
		if (!static::$instance) static::$instance = new static();
		return static::$instance;
	}

	/**
	 * Set currently rendered view instance every time this helper
	 * is called and the rendered view instance is changed.
	 * This method sets these protected object references:
	 * - `AbstractHelper::$view` as `\MvcCore\View|\MvcCore\IView`
	 * - `AbstractHelper::$controller` as `\MvcCore\Controller|\MvcCore\IController`
	 * - `AbstractHelper::$request` as `\MvcCore\Request|\MvcCore\IRequest`
	 * - `AbstractHelper::$response` as `\MvcCore\Response|\MvcCore\IResponse`
	 * @param \MvcCore\View|\MvcCore\IView $view
	 * @return \MvcCore\Ext\Views\Helpers\AbstractHelper
	 */
	public function & SetView (\MvcCore\IView & $view) {
		$this->view = & $view;
		$this->controller = & $view->GetController();
		$this->request = & $this->controller->GetRequest();
		$this->response = & $this->controller->GetResponse();
		return $this;
	}
}
