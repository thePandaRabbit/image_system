/**
 * Created by 代晨 on 2017/11/2.
 */
//id方法封装
function $$(id) {
    return document.getElementById(id);
}
// 具体js功能实现
window.onload = function () {
    //  随机改变侧边分类标签颜色的方法
    function getRandomColor() {
        var rgb = 'rgba(' + Math.floor(Math.random() * 255) + ',' + Math.floor(Math.random() * 255) + ',' + Math.floor(Math.random() * 255) + ',' + .6 + ')';
        return rgb;
    };
    var background = document.getElementsByClassName('card');
    for (var j = 0, lens = background.length; j < lens; j++) {
        //            console.log( background[j]);
        background[j].style.background = getRandomColor();
    };
    //  弹窗方法
    //  Add弹窗
    var btn = document.getElementsByClassName('btn');
    var div = $$('win-pop');
    var add = $$("bg-06");
    var c = $$("clerd");
    add.onclick = function () {

        if (div.style.display = 'none') {
            div.style.display = 'block';
        }
    };
    c.onclick = function () {
        if (div.style.display = 'block') {
            div.style.display = 'none';
        }
    };

    //    返回顶部方法
    var stop = $$("scrollSearchDiv");
    var timer = null;
    var isTop = true;
    window.onscroll = function () {
        var osTop = document.documentElement.scrollTop || document.body.scrollTop;
        if (osTop >= 600) {
            stop.style.display = 'block';
        } else {
            stop.style.display = 'none';
        }
        if (!isTop) {
            clearInterval(timer);
        }
        isTop = false;
    }
    stop.onclick = function () {
        timer = setInterval(function () {
            var osTop = document.documentElement.scrollTop || document.body.scrollTop;
            var speed = Math.floor(-osTop / 6);
            document.documentElement.scrollTop = document.body.scrollTop = osTop + speed;
            isTop = true;
            if (osTop == 0) {
                clearInterval(timer);
            }
        }, 30);
    };
    //   alert("222");

    //ajax请求后台数据
    function ajax(type) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                data = JSON.parse(xmlhttp.responseText);
                var str = '';
                for (var a = 0, len = data.length; a < len; a++) {
                    str = str + "<div  class='item'>";
                    str = str + "<img src='./public/Thumbnail/" + data[a]['ps_file_route'] + "' class='real'>";
                    str = str + "<div  class='btn'>";
                    str = str + "<a href='#' class='closer' data-data='" + data[a]["ps_file_id"] + "' title='删除' data-role='button'>✘</a>";
                    str = str + "</div>";
                    str = str + "</div>";
                }
                $$('waterfall').innerHTML = str;
                //删除弹窗
                // var id = $$('id');
                var id = document.getElementsByClassName("id");
                var cer = document.getElementsByClassName("closer");
                var sure = $$("sure");
                var popo = $$("win-popo");
                var cr = $$("clerdr");
                for (var k = 0, lenr = cer.length; k < lenr; k++) {
                    cer[k].onclick = function () {
                        // console.log(this);
                        // console.log(this. ('data-data'));
                        sessionStorage.data = this.getAttribute('data-data');
                        sure.onclick = function () {
                            // console.log(sessionSt orage.data);
                            xmlhttp.onreadystatechange=function() {
                                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                                {
                                    if(xmlhttp.responseText==1){
                                        //关闭弹窗
                                        ajax(5);
                                        popo.style.display = 'none';
                                    }else{
                                        alert('删除失败！');
                                        ajax(5);
                                    }
                                }
                            };
                            xmlhttp.open("POST","./home/index/delete?id="+sessionStorage.data,true);
                            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;");  //用POST的时候一定要有这句
                            xmlhttp.send();
                        };
                        popo.style.display = 'block';
                    };
                    cr.onclick = function () {
                        popo.style.display = 'none';
                        sessionStorage.clear();
                        // console.log(cr.id);
                    }
                }
                //   鼠标经过
                var item = document.getElementsByClassName('item');
                //  console.log(item.length);
                for (var i = 0, len = item.length; i < len; i++) {
                    item[i].onmouseover = function () {
                        //                console.log(this.children[1]);
                        this.children[1].style.display = 'block';
                    };
                    item[i].onmouseout = function () {
                        this.children[1].style.display = 'none';
                    };
                }
                //弹窗预览
                var realimg = document.getElementsByClassName("real");
                //console.log(realimg.length)
                for (var i = 0, len = realimg.length; i < len; i++) {
                    //console.log(this.parentNode.parentNode.parentNode.nextElementSibling);
                    realimg[i].onclick = function () {
                        var paret = this.parentNode.parentNode.parentNode.nextElementSibling;
                        paret.style.display = 'block';
                        paret.children[1].src = this.src;
                        paret.children[2] = this.alt;
                        paret.children[0].onclick = function () {
                            // console.log(this.nextElementSibling);
                            this.parentNode.style.display = 'none';
                        }
                    };
                }
            }
        };
        xmlhttp.open("POST", "./home/index/ajaxchuli?type=" + type, true);
        xmlhttp.send();
    }
    //添加submit页面不刷新
    var submit = $$('submit');
    submit.onclick = function () {
        var form = $$('form');
        var formData = new FormData(form);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                if (xmlhttp.responseText == 1) {
                    div.style.display = 'none';
                    form.reset();
                    ajax(5);
                } else {
                    form.reset();
                    ajax(5);
                    alert('添加失败!');
                    return;
                }
            }
        };
        xmlhttp.open("POST", "./home/index/insert", true);
        xmlhttp.send(formData);
    }
    // 分类标签向后台传值
    var card = document.getElementsByClassName('card-wrapper');
    // var type = document.getElementsByClassName('inputtype');
    // console.log(type.length);
    for (var i = 0, lens = card.length; i < lens; i++) {
        (function (i) {
            card[i].onclick = function () {
                ajax(this.children[0].children[1].value);
            }
        })(i)
    };
    ajax(5);
};