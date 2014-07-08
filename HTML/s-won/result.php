<html>
<head>
	<meta charset='utf-8'>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
	<script type="text/javascript" src="scripts/shCore.js"></script>
	<script type="text/javascript" src="scripts/shBrushJScript.js"></script>
	<script type="text/javascript" src="scripts/shBrushCpp.js"></script>
	<link type="text/css" rel="stylesheet" href="styles/shCoreDefault.css">
	<script type="text/javascript">
		SyntaxHighlighter.all();
	</script>
	<style type='text/css'>
		body {
			width: auto;
			height: auto;
		}
		div.terminal {
			width: 100%;
			height: auto;
			border: solid 1px black;
			border-color: black;
		}
		div.prompt {
			height: auto;
			background-color: black;
			color: white;
			margin: 0px;
			padding: 5px;
		}
		div.titlebar{
			width: 100%;
			height: auto;
			background-color: #F0F0F0;
			color: black;
			text-align: center;
			margin: 0px;
			padding: 0px;
		}
		div.top {
			width: 100%;
			height: auto;
			border: solid 1px black;
			border-color: black;

		}
		h1 {
			background: white; 
			font-family: Helvetica;
			text-indent: 10px;
		}
		h2 {
			background: white; 
			font-family: Helvetica;
			text-indent: 20px;
		}
	</style>
	<title>결과 보기 화면</title>
</head>
<body>

<?php

// index.php로부터 값 취득	
$sourceCode = isset($_POST['sourcecode']) ? $_POST['sourcecode'] : false;
$userName = isset($_POST['username']) ? $_POST['username'] : false;



// 각 값의 존재 유무, 내용 판별
$SCFlag = false;
$UNFlag = false;




// 네가지 경우
if ($sourceCode && $userName) {
	// 두 값이 다 들어있는 경우
	$SCFlag = true;
	$UNFlag = true;
} else if ($sourceCode && !$userName) {
	// 이름 이 없는 경우
	$SCFlag = true;
	$UNFlag = false;
} else if (!$sourceCode && $userName) {
	// 소스 코드가 없는 경우
	$SCFlag = false;
	$UNFlag = true;
} else if (!$sourceCode && !$userName) {
	// 둘 다 없는 경우
	$SCFlag = false;
	$UNFlag = false;
} else {
	// 예외
	echo 'error';
}

echo '<form action="index.php" method="post">';
echo '<input type="hidden" name="sourcecode" value="' . urlencode(str_replace(array("<",">"), array("&lt;", "&gt;"), $sourceCode)) . '"">';
echo '<input type="hidden" name="username" value=' . $userName . '>';
echo '<input type="submit" value="처음 화면으로 돌아가기">';
echo '</form><br>';


echo '<div class="top">';
echo '<h1>source code </h1>';
echo '<pre class="brush: cpp;">';
echo str_replace(array("<",">"), array("&lt;", "&gt;"), $sourceCode);
echo '</pre>';
echo '<h1>user name </h1>';
echo '<h2>' . $userName . '</h2>';
echo '</div><br>';


// 파일 저장 컴파일 결과 출력
if ($SCFlag && $UNFlag) {
	//ファイル名
	$sFileNameWithoutCPP = date('Ymd-His');
	$sFileName = $sFileNameWithoutCPP . '.cpp';
	//ファイルパス
	$sPath = '/Users/Shared/sc/' . $userName;
	$sFilePath = $sPath . '/' . $sFileName;
	//書き込む内容
	//$sWriteContents =    "1行目1項目目\t1行目2項目目\t1行目3項目目\n";
	//$sWriteContents .=   "2行目1項目目\t2行目2項目目\t2行目3項目目\n";
	//$sWriteContents .=   "3行目1項目目\t3行目2項目目\t3行目3項目目";

	//ファイルの存在確認
	if(file_exists($sFilePath)){
	    echo '・指定ファイルが既に存在しております。';
	    exit;
	}else{
	    //echo '・ファイルの存在確認完了。<br/>';
	}

	//ファイルを作成
	if(touch($sFilePath)){
	    //echo '・ファイル作成完了。<br/>';
	}else{
	    echo '・ファイル作成失敗。<br/>';
	    exit;
	}

	//ファイルのパーティションの変更
	if(chmod($sFilePath, 0644)){
	    //echo '・ファイルパーミッション変更完了。<br/>';
	}else{
	    echo '・ファイルパーミッション変更失敗。<br/>';
	    exit;
	}

	//ファイルをオープン
	if($filepoint = fopen($sFilePath,"w")){
	    //echo '・ファイルオープン完了。<br/>';
	}else{
	    echo '・ファイルオープン失敗。<br/>';
	    exit;
	}

	//ファイルのロック
	if(flock($filepoint, LOCK_EX)){
	    //echo '・ファイルロック完了。<br/>';
	}else{
	    echo '・ファイルロック失敗。<br/>';
	    exit;
	}

	//ファイルへ書き込み
	if(fwrite($filepoint, $sourceCode)){
	    //echo '・ファイル書き込み完了。<br/>';
	}else{
	    echo '・ファイル書き込み失敗。<br/>';
	    exit;
	}

	//ファイルのアンロック
	if(flock($filepoint, LOCK_UN)){
	    //echo '・ファイルアンロック完了。<br/>';
	}else{
	    echo '・ファイルアンロック失敗。<br/>';
	    exit;
	}

	//ファイルを閉じる
	if(fclose($filepoint)){
	    //echo '・ファイルクローズ完了。<br/>';
	}else{
	    echo '・ファイルクローズ失敗。<br/>';
	    exit;
	}
	//echo '------------------------------------------';
	echo '<div class=\'terminal\'>';
	echo '<div class=\'titlebar\'>';
	echo 'terminal';
	echo '</div>';
	echo '<div class=\'prompt\'>';
	echo '<pre>';
	//echo $userName . ' $ ls -al ' . $sPath . '<br>';
	//system('ls -al ' . $sPath, $reval);
	//echo '<br>';
	echo $userName . ' $ c++ -o ' . $sPath . '/' . $sFileNameWithoutCPP . '.out ' . $sPath . '/' . $sFileName . '<br>';
	passthru('c++ -o ' . $sPath . '/' . $sFileNameWithoutCPP . '.out ' . $sPath . '/' . $sFileName, $reval);
	//echo '<br>';
	//echo var_dump($reval);

	if (!$reval) {
		echo $userName . ' $ ' . $sPath . '/' . $sFileNameWithoutCPP . '.out<br>';
		passthru($sPath . '/' . $sFileNameWithoutCPP . '.out');
		echo '<br>';
		echo '</pre>';
	}
	echo '</div>';
	echo '</div>';
} else if (!$SCFlag && $UNFlag) {

} else if ($SCFlag && !$UNFlag) {

} 

// echo $string;



?>
</body>
</html>