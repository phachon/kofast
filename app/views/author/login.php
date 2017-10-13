<div class="row-fluid login-wrapper">
    <h2 style="color:azure"><strong>KoFast Login</strong></h2>
    <div class="span4 box" style="padding-top: 30px;">
        <div class="content-wrap">
            <h6 style="margin-bottom:15px; color:#de615e" id="errorMessage" class="hidden"></h6>
            <form role="form" action="<?php echo URL::site('author/login');?>" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="name" id="username" placeholder="请输入账号">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" id="password" placeholder="请输入密码">
                </div>
                <div class="form-group col-xs-8">
                    <input type="text" class="form-control" name="captcha" id="captcha" placeholder="请输入验证码">
                </div>
                <div style="width:120px;height:41px;margin-left:212px">
                    <a href="javascript:;">
                        <img src="<?php echo URL::site('author/captcha');?>" onclick=this.src="<?php echo URL::site('author/captcha?n=');?>"+Math.random() style="display:inline"/>
                    </a>
                </div>
                <button class="btn btn-lg btn-success btn-block" type="button" onclick="Login.ajaxSubmit(this.form)">登录</button>
            </form>
        </div>
    </div>
    <div class="span4 no-account">
        <p style="font-size: 14px"><strong>copyright © 2017 koFast</strong></p>
    </div>
    <div class="text-center" style="font-size: 12px;color: #949CAF;">请使用Firefox, Chrome, IE9+浏览器达到更好效果</div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
        $.backstretch("/resource/images/backgrounds/2.jpg");
    });
</script>