<?php
// define your token
require_once 'nusoapClient.php';
define ( "TOKEN", "xyddweixin" );
$wechatObj = new wechatCallbackapiTest ();
//$wechatObj->valid();
$wechatObj->responseMsg ();
class wechatCallbackapiTest {
	public function valid()
	{
		$echoStr = $_GET["echostr"];
	
		//valid signature , option
		if($this->checkSignature()){
			echo $echoStr;
			exit;
		}
	}
	public function responseMsg() {
		// get post data, May be due to the different environments
		$postStr = $GLOBALS ["HTTP_RAW_POST_DATA"];
		
		// extract post data
		if (! empty ( $postStr )) {
			
			$postObj = simplexml_load_string ( $postStr, 'SimpleXMLElement', LIBXML_NOCDATA );
			$fromUsername = $postObj->FromUserName;
			$toUsername = $postObj->ToUserName;
			$keyword = trim ( $postObj->Content );
			$time = time ();
			/* 数据判断与整理部分 */
			$words = array ();
			$words = explode ( "：", $keyword );
			if (count ( $words ) == 2 && ($words [0] == "新鲜事" || $words [0] == "校园知道" || $words [0] == "跳蚤市场" || $words [0] == "失物招领" || $words [0] == "商家资讯")) {
				$contentStr = "恭喜，您的信息已经发布到【" . $words [0] . "】栏目";
				$lanmu = $words [0]; // 栏目名
				$content = $words [1]; // 具体的内容
				$tm = time ();
				$stm = date ( "Y-m-d ", $tm );
				//$ptype = $lanmu;
				switch ($lanmu) {
					case "新鲜事" :
						$ptype = 'news';
						break;
					case "校园知道":
						$ptype = 'know';
						break;
					case "跳蚤市场":
						$ptype = 'market';
						break;
					case "失物招领":
						$ptype = 'lf';
						break;
					case "商家资讯":
						$ptype = 'com';
						break;
					default:
						$ptype = $lanmu;
				}
				$ptitle = '来自微信的消息';
				$pdetail = $content;
				$uid = 2;
				add_post ( $ptype, $ptitle, $pdetail, $uid );
			} else {
				$contentStr = "您输入的信息格式不符合规定" . "校园叮当设有：新鲜事，校园知道，跳蚤市场，失物招领，商家资讯5个栏目。发送消息的格式是：【栏目名：文字内容】";
			}
			$textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
			if (! empty ( $keyword )) {
				$msgType = "text";
				$resultStr = sprintf ( $textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr );
				echo $resultStr;
			} else {
				echo "Input something...";
			}
		} else {
			echo "";
			exit ();
		}
	}
	private function checkSignature()
	{
		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];
	
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
	
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>