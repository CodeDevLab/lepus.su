<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/private/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/private/init/mysql.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/private/init/memcache.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/private/init/session.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/private/func.main.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/private/auth.php');
if(empty($user)){
	$tmpData = error('no_auth_page');
	die(lepus_error_page($tmpData['mes']));
}
$tmpData = error(lepus_getService($_GET['id']));
if($tmpData['err'] != 'OK')	die(lepus_error_page($tmpData['mes']));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Lepus - интернет хостинг</title>
		<meta name="description" content="Виртуальный хостинг, быстрые VPS, выделенные серверы по привлекательной цене." />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="yandex-verification" content="6940b644b3235f76" />
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="/css/reset.css"/>
		<link rel="stylesheet" type="text/css" href="/css/style.css"/>
		<link rel="stylesheet" type="text/css" href="/css/alertify.core.css" />
		<link rel="stylesheet" type="text/css" href="/css/alertify.bootstrap.css" />
		<link rel="stylesheet" href="/css/dataTables.bootstrap.css">
		<style> td,th { text-align: center; vertical-align: middle; } </style>
		<script src="/js/jquery.min.js"></script>
		<script src="/js/jquery.dataTables.min.js"></script>
		<script src="/js/dataTables.bootstrap.js"></script>
		<script src="/js/bootstrap.min.js"></script>
		<script src="/js/alertify.js"></script>
		<script src="/js/lepus.js"></script>
	<script type="text/javascript" charset="utf-8"> $(document).ready(function() { $('#IPList').dataTable({ "order": [[ 0, "desc" ]] }); }); </script>
	</head>
	<body>
		<div class="wrapper">
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/private/pages/menu.php'); ?>
				<div class="content-box">
					<div class="content-info box-shadow--2dp">
						<div class="content-text">
							<div class="page-title"><?php echo "{$tmpData['mes']['name']} #{$tmpData['mes']['id']}";?></div>
							<div class="row">
								<div class="col-lg-14">
									<div class="col-lg-12">
										<input type="hidden" id="service_id" value="<?php echo $tmpData['mes']['id'];?>">
										<hr/>
										Услуга оплачена до: <lu id="xxx"><?php if(strtotime($tmpData['mes']['time']) > strtotime($tmpData['mes']['promised'])) echo $tmpData['mes']['time']; else echo $tmpData['mes']['promised']; ?></lu>.<br/>
										Стоимость: тариф <?php if(!empty($tmpData['mes']['extra'])) echo "+ доп услуги"; ?> = <?php echo $tmpData['mes']['price'];?> рублей.<br/>
										Документация: <a href="https://github.com/poiuty/lepus.su/wiki/%D0%92%D0%B8%D1%80%D1%82%D1%83%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9-%D1%85%D0%BE%D1%81%D1%82%D0%B8%D0%BD%D0%B3" target="_blank">виртуальный хостинг</a>, <a href="https://github.com/poiuty/lepus.su/wiki/KVM-VPS" target="_blank">vps</a>.<br/>
										<?php if(!empty($tmpData['mes']['extra'])) echo "Дополнительные услуги: {$tmpData['mes']['extra']}.<br/>"; ?>
										<?php if(!empty($tmpData['mes']['top'])) echo $tmpData['mes']['top']."<br/>"; ?>
										<?php if($tmpData['mes']['gid'] != 3 && $tmpData['mes']['gid'] != 4){ ?>
										<hr/>
										<select class="form-control" id="idServiceOrder" name="type"><?php echo lepus_getTariffList($tmpData['mes']['sid']); ?></select>
										<input class="btn btn-sm btn-danger btn-block" style="margin-top: 4px;" data-change-tariff type="submit" value="Поменять тариф">
										<input class="btn btn-sm btn-danger btn-block" style="margin-top: 4px;" data-promised-pay type="submit" value="Обещанный платеж">
										<?php }; ?>
										<?php if(!empty($tmpData['mes']['bottom'])) echo $tmpData['mes']['bottom']; ?>
										<hr/>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php require_once($_SERVER['DOCUMENT_ROOT'].'/private/pages/navi.php'); ?>
		</div>
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/private/pages/footer.php'); ?>
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/private/pages/modal.php'); ?>
		<script src="//www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
	</body>
</html>
