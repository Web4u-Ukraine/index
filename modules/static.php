<!--
<div class="content">
	<?
	if ($arg1=='contacts'){
	?>
	<div class="row-fluid">
		<div class="span8">
	<?
	}
	$res=db_select("select * from x1_page where pref='$arg1'");
	while ($row=mysql_fetch_array($res)){
		?>
		<h1><?= $row[name] ?></h1>
		<div class="pageText"><?= $row[text] ?></div>
		<?
	}
	if ($arg1=='contacts'){
	?>
		</div>
	</div>
	<? }
	/*
if ($arg1=='contacts'){
		?>
		<div class="maps">
			<script type="text/javascript" charset="utf-8" src="//api-maps.yandex.ru/services/constructor/1.0/js/?sid=G9HoQyIFtVr2tKloqLml9mAh9apmJGM7&width=469&height=317"></script>
		</div>
		<div style="clear:both"></div>
		<?
	}
*/
	?>
</div>
-->