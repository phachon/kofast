## KoFast captcha module
验证码模块

## Used
使用示例

```
header('Content-type: image/jpeg');

//load captcha config
$captchaConfig = Kohana::$config->load('captcha.default')->as_array();
//captcha length
$length = Arr::get($captchaConfig, 'length', 4);
//captcha charset
$charset = Arr::get($captchaConfig, 'charset', 'abcdefghijklmnpqrstuvwxyz123456789');

//create captcha
$phraseBuilder = new PhraseBuilder();
$phrase = $phraseBuilder->build($length, $charset);
$builder = CaptchaBuilder::create($phrase);
$builder->build(109, 40)
        ->output();

//save captcha to session
$_SESSION['captcha'] = $builder->getPhrase();
```