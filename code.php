<?php
session_start();
//生成验证码图片
header("Content-type: image/png");

$im = imagecreate(60,25);    //生成图片
$black = imagecolorallocate($im, 0,0,0);     //此条及以下三条为设置的颜色
$white = imagecolorallocate($im, 255,255,255);
$gray = imagecolorallocate($im, 200,200,200);
$red = imagecolorallocate($im, 255, 0, 0);
// 全数字
$str = "a,b,c,d,e,f,g,h,i,k,l,m,n,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,I,J,K,L,M,N,P,Q,R,S,T,U,V,W,X,V,Z,1,2,3,4,5,6,7,8,9";      //要显示的字符，可自己进行增删
$list = explode(",", $str);
$cmax = count($list) - 1;
$verifyCode = '';
for ( $i=0; $i < 5; $i++ ){
      $randnum = mt_rand(0, $cmax);
      $verifyCode .= $list[$randnum];           //取出字符，组合成为我们要的验证码字符
}
$_SESSION['code'] = strtolower($verifyCode);        //将字符放入SESSION中
 

imagefill($im,0,0,rand_color($im));     //给图片填充颜色
 
//将验证码绘入图片
imagestring($im, 5, 8, 5, $verifyCode, $black);    //将验证码写入到图片中
 
for($i=0;$i<40;$i++)  //加入干扰象素
{
     imagesetpixel($im, rand(0,60) , rand(0,20) , rand_color($im));    //加入点状干扰素
//     imagesetpixel($im, rand(0,60) , rand(0,20) , rand_color($im));
//     imagesetpixel($im, rand(0,60) , rand(0,20) , rand_color($im));
}
     imagearc($im, rand(0,60) , rand(0,20), rand(0,20), rand(0,30), rand(60,90), rand(100,200), rand_color($im));    //加入弧线状干扰素
     imagearc($im, rand(0,60) , rand(0,20), rand(0,20), rand(0,30), rand(60,90), rand(100,200), rand_color($im));    //加入弧线状干扰素
//     imageline($im, rand(0,60) , rand(0,20), rand(0,60) , rand(0,20), rand_color($im));    //加入线条状干扰素
//     imageline($im, rand(0,60) , rand(0,20), rand(0,60) , rand(0,20), rand_color($im));    //加入线条状干扰素
//     imageline($im, rand(0,60) , rand(0,20), rand(0,60) , rand(0,20), rand_color($im));    //加入线条状干扰素
imagepng($im);
imagedestroy($im);
function rand_color($img){
	return imagecolorallocate($img, rand(100,255),rand(100,255),rand(100,255));
}
?>