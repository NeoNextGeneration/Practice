<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
	<style type="text/css">
		div.top {
			width: 100%;
			font-size: 30px;
			color: blue;
			line-height: 150%;
			text-align: center;
		}
		textarea {
			width: 95%;
			margin: 0 auto;
			border: 2px solid #666;
			padding: 12px;
			font-family: consolas, monospace;
			font-size: 120%;
			height: 80%;
			overflow: auto;
			
			background: #333;
			color: #ccc;
			line-height: 120%;
		}
		.button {
		border: 2px solid #0a3c59;
		background: #3e779d;
		background: -webkit-gradient(linear, left top, left bottom, from(#65a9d7), to(#3e779d));
		background: -webkit-linear-gradient(top, #65a9d7, #3e779d);
		background: -moz-linear-gradient(top, #65a9d7, #3e779d);
		background: -ms-linear-gradient(top, #65a9d7, #3e779d);
		background: -o-linear-gradient(top, #65a9d7, #3e779d);
		background-image: -ms-linear-gradient(top, #65a9d7 0%, #3e779d 100%);
		padding: 5px 10px;
		-webkit-border-radius: 6px;
		-moz-border-radius: 6px;
		border-radius: 6px;
		-webkit-box-shadow: rgba(255,255,255,0.4) 0 1px 0, inset rgba(255,255,255,0.4) 0 1px 0;
		-moz-box-shadow: rgba(255,255,255,0.4) 0 1px 0, inset rgba(255,255,255,0.4) 0 1px 0;
		box-shadow: rgba(255,255,255,0.4) 0 1px 0, inset rgba(255,255,255,0.4) 0 1px 0;
		text-shadow: #7ea4bd 0 1px 0;
		color: #06426c;
		font-size: 22px;
		font-family: helvetica, serif;
		text-decoration: none;
		vertical-align: middle;
		}
		.button:hover {
		border: 2px solid #0a3c59;
		text-shadow: #1e4158 0 1px 0;
		background: #3e779d;
		background: -webkit-gradient(linear, left top, left bottom, from(#65a9d7), to(#3e779d));
		background: -webkit-linear-gradient(top, #65a9d7, #3e779d);
		background: -moz-linear-gradient(top, #65a9d7, #3e779d);
		background: -ms-linear-gradient(top, #65a9d7, #3e779d);
		background: -o-linear-gradient(top, #65a9d7, #3e779d);
		background-image: -ms-linear-gradient(top, #65a9d7 0%, #3e779d 100%);
		color: #fff;
		}
		.button:active {
		text-shadow: #1e4158 0 1px 0;
		border: 2px solid #0a3c59;
		background: #65a9d7;
		background: -webkit-gradient(linear, left top, left bottom, from(#3e779d), to(#3e779d));
		background: -webkit-linear-gradient(top, #3e779d, #65a9d7);
		background: -moz-linear-gradient(top, #3e779d, #65a9d7);
		background: -ms-linear-gradient(top, #3e779d, #65a9d7);
		background: -o-linear-gradient(top, #3e779d, #65a9d7);
		background-image: -ms-linear-gradient(top, #3e779d 0%, #65a9d7 100%);
		color: #fff;
		}
	</style>

	<title>
		씨뿔뿔 프로그래밍
	</title>
</head>
<body>
<div class='top'>
소스 코드를 입력하고 결과보기를 선택하면 결과화면을 보여드립니다.
</div>
<?php
	// result.php로부터 값 취득	
	$sourceCode = isset($_POST['sourcecode']) ? $_POST['sourcecode'] : '여기에 소스코드를 입력하세요.';
	$userName = isset($_POST['username']) ? $_POST['username'] : '';


?>
<form action="result.php" method="post">
	userid : <input type="text" name="username" size="30" maxlength="20" value=<?php echo '"'.$userName.'"'; ?>><br>
	<textarea name="sourcecode"　wrap="off"><?php echo urldecode($sourceCode); ?></textarea><br>
	<input type="submit" value="결과보기">
	<input type="reset" value="내용 초기화">
</form>

<a href='#' class='button'>TestButton</a>

</body>
</html>


