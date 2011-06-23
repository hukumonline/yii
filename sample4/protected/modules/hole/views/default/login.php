<?php
	Yii::import('application.extensions.hole.auth.*');
	Yii::import('application.extensions.hole.cms.*');

	if ($sso->getInfo() || ($_SERVER['REQUEST_METHOD'] == 'POST' && $sso->login()))
	{
		$this->redirect(Yii::app()->user->returnUrl);
		exit;
	}
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') $errmsg = "Login failed";
	
	$catalogHelper = new HoleCmsHelper();
?>

<div class="unit horizontal-center layout on-2 columns" style="padding-top:20px;">
	<div class="fixed column" style="width:640px;padding-right:20px;">
	<p><?=$catalogHelper->getCatalogAttribute($rows[0]['guid'], 'fixedContent'); ?></p>
	</div>
	<div class="fixed column" style="width:300px;">
		<div id="sidecontent">
			<div style="text-align:center;">Masuk dengan Hukumonline<br>
			<img src="<?=Yii::app()->theme->baseUrl;?>/images/holid2.jpg" height="25" border="0" align="middle"> Akun
			</div><br>
			<?php
			$my_access = new CAuthReader();
			$my_access->login_reader();
			if (isset($errmsg)): ?><div style="color:red"><?= $errmsg ?></div><? endif; ?>
			<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" class="niceform">
				<fieldset>
					<dl>
						<dt><label for="identity">Pengguna</label></dt>
						<dd><input name="username" size="18" tabindex="1" value="<?=$my_access->user; ?>" type="text"></dd>
					</dl>
					<dl>
						<dt><label for="password">Sandi</label></dt>
						<dd><input name="password" size="18" tabindex="2" type="password" value="<?=$my_access->user_pw; ?>"></dd>
					</dl>
					<dl>
						<dt style="width:110px;"><input name="remember" tabindex="3" type="checkbox" value="yes"<?=($my_access->is_cookie == true) ? " checked" : ""; ?>>&nbsp;&nbsp;<label for="remember">Tetap login</label></dt>
					</dl>
				</fieldset>
				<fieldset class="action">
				<input tabindex="4" value="Masuk" type="submit" id="submit" />
				</fieldset>
				<input name="broker" type="hidden" value="<?=$sso->broker; ?>" />
			</form>
			<a href="/identity/lupasandi" title="Recover Account">Lupa ID or sandi ?</a>	
			<h4>Tidak punya Hukumonline! ID?</h4>
			daftar nya mudah.
			<ul style="padding-left:15px;">
				<li><a href="/identity/daftar" title="Sign Up">Daftar</a></li>
			</ul>
		</div>
		<div id="sidecontent2">
			<h3>Satu Hukumonline!ID</h3>
			Gunakan ID anda untuk Hukumonline Indonesia, Hukumonline English, Hukumpedia dan Forum.
		</div>
	</div>
</div>
