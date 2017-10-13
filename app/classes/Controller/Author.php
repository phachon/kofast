<?php
/**
 * 用户管理
 * @author: phachon@163.com
 */
class Controller_Author extends Controller_Render {

	protected $_checkLogin = FALSE;

	protected $_layout = 'layouts/author';

	/**
	 * login view
	 */
	public function action_index() {
		$this->_layout->content = View::factory("author/login");
	}

	/**
	 * 登录
	 */
	public function action_login() {
		$this->_contentType = self::CONTENT_TYPE_JSON;

		$name = trim(Arr::get($_POST, 'name', ''));
		$password = trim(Arr::get($_POST, 'password', ''));
		$captcha = trim(Arr::get($_POST, 'captcha', ''));

		if($name == '') {
			return $this->error('用户名不能为空!');
		}
		if($password == '') {
			return $this->error('密码不能为空!');
		}
		if($captcha == '') {
			return $this->error('验证码不能为空!');
		}
		if(strtolower($_SESSION['captcha']) !== strtolower($captcha)) {
			return $this->error('验证码输入错误!');
		}
		
		try {
//			$account = Author::instance()->localLogin($name, $password);
		} catch (Exception $e) {
			return $this->error($e->getMessage());
		}

		//保存 seesion 信息
//		$account = get_object_vars($account);
//		Session::instance()->set('author', $account);
//		$config = Kohana::$config->load('author');
//		$identifier = md5(Request::$user_agent . Misc::getClientIp() . $account['password']);
//		$passport = Encrypt::instance('kofast')->encode($name . '@' . $identifier);
//		Cookie::set($config['passport'], $passport);

		return $this->success('登录成功', URL::site('welcome/index'));
	}

	/**
	 * 退出
	 */
	public function action_logout() {
//		$account = Session::instance()->get('author');
//		if($account) {
//			Logs::instance()->write($account['name'].' 退出登录');
//		}
//		$config = Kohana::$config->load('author');
//		Cookie::delete($config['passport']);
//		Session::instance()->delete('author');

		Prompt::successView('退出成功', URL::site('author'));
	}

	/**
	 * 验证码
	 */
	public function action_captcha() {
		$this->_autoRender = FALSE;

		header('Content-type: image/jpeg');

		$captchaConfig = Kohana::$config->load('captcha.default');
		$length = Arr::get($captchaConfig, 'length', 4);
		$charset = Arr::get($captchaConfig, 'charset', 'abcdefghijklmnpqrstuvwxyz123456789');

		$phraseBuilder = new PhraseBuilder();
		$phrase = $phraseBuilder->build($length, $charset);

		$builder = CaptchaBuilder::create($phrase);
		$builder->build(109, 40)->output();
		$_SESSION['captcha'] = $builder->getPhrase();
	}

}