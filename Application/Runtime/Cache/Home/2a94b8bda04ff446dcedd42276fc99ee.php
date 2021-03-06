<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图片管理</title>
    <link rel="stylesheet" href="/image_system/Public/css/style.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="/image_system/Public/css/waterfall.css"type="text/css">
    <link rel="stylesheet" href="/image_system/Public/css/popup.css" type="text/css">
    <script src="/image_system/Public/js/index.js"></script>
</head>
<body>
<!--返回顶部-->
<div id="scrollSearchDiv" class="backtotop" title="返回顶部">
    <img src="/image_system/Public/imgs/返回顶部.png" alt="">
    <!--返回顶部-->
</div>
<!--添加弹窗-->
<div id="win-pop" class="win-pop">
    <div class="win-mask">
        <!--蒙层-->
    </div>
    <div class="win-content">
        <div  class="win-header">添加图片</div>
        <form method="post" id="form" enctype="multipart/form-data">
            <div  class="win-body">主题内容
                <input type="file" name="file[]" multiple>
                <select name="type">
                    <option value="1">风景印象</option>
                    <option value="2">人物剪影</option>
                    <option value="3">动物萌宠</option>
                    <option value="4">小清新</option>
                </select>
            </div>
            <div  class="win-footer">
                <input type="button" id="submit" data-role="button" value="确定">
                <input type="button" data-role="button" id="clerd" data-role="button" value="取消">
        </div>
        </form>
    </div>
</div>
<!--删除弹窗-->
<div id="win-popo" class="win-popo">
    <div class="win-mask">
        <!--蒙层-->
    </div>
    <div class="win-content">
        <div  class="win-header">删除？</div>
            <div  class="win-body">
               <p>您确定要删除吗？</p>
            </div>
            <div  class="win-footer">
                <!--<a href="/image_system/index.php/Home/Function/delete?id=<?php echo ($vo['ps_file_id']); ?>&route=<?php echo ($vo['ps_file_route']); ?>"><input type="button" data-role="button" value="确定"></a>-->
                <input type="button" class="sure" id="sure" data-role="button" value="确定">
                <!--<input type='hidden' class='id' value='+data[a]["ps_file_id"]+'>-->
                <input type="button" data-role="button" id="clerdr" data-role="button" value="取消">
            </div>

    </div>
</div>
<!--侧边分类栏-->
<div class='card-holder'>
    <div class='card-wrapper'>
            <div id="bg-01" class='card bg-01'>
                <span class='card-content'>首页</span>
                <input type="hidden" class="inputtype" value="5">
            </div>
    </div>
    <div class='card-wrapper'>
            <div id="bg-02"  class='card bg-02'>
                <span class='card-content'>风景印象</span>
                <input type="hidden" class="inputtype" value="1">
            </div>
    </div>
    <div class='card-wrapper'>
            <div id="bg-03" class='card bg-03'>
                <span class='card-content'>人物剪影</span>
                <input type="hidden" class="inputtype" value="2">
            </div>
    </div>
    <div class='card-wrapper'>
            <div id="bg-04" class='card bg-04'>
                <span class='card-content'>动物萌宠</span>
                <input type="hidden" class="inputtype" value="3">
            </div>
    </div>
    <div class='card-wrapper'>
            <div id="bg-05" class='card bg-05' >
                <span class='card-content'>小清新</span>
                <input type="hidden" class="inputtype" value="4">
            </div>
    </div>
    <div class='card-wrapper'>
        <br>
        <br>
        <br>
            <div id="bg-06" class='card bg-06'>
                <span class='card-content'>添加</span>
            </div>

    </div>
</div>
<!--photo-->
<div class="container">
    <div id="waterfall" class="waterfall">
    </div>
</div>
<!--预览弹窗-->
<div class="motai" id="motai">
    <span class="close" id="close">×</span>
    <img class="moimg" id="moimg">
    <div id="caption" class="caption"></div>
</div>
</body>
</html>