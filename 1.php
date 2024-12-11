<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!-- <script src="D:\xampp\htdocs\jquery-3.4.1.min.js"></script> -->
<!-- 服务器返回数据 0 登录成功 1 注册成功 2 此用户名已注册 3 密码不正确 4 用户名不存在 5 聊天数据保存成功-->
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        html {
            height: 100%;
        }
        body {
            height: 100%;
        }
        .container {
            height: 100%;
            background-image: linear-gradient(to right, #fbc2eb, #a6c1ee);
        }
        .login-wrapper {
            background-color: #fff;
            width: 358px;
            height: 588px;
            border-radius: 15px;
            padding: 0 50px;
            position: relative;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }
        .header {
            font-size: 38px;
            font-weight: bold;
            text-align: center;
            line-height: 200px;
        }
        .input-item {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            border: 0;
            padding: 10px;
            border-bottom: 1px solid rgb(128, 125, 125);
            font-size: 15px;
            outline: none;
        }
        .input-item:placeholder {
            text-transform: uppercase;
        }
        .btn0 {
            text-align: center;
            padding: 7px;
            margin: 4px 12px;
            width: 24%;
            font-size: 16px;
            background-image: linear-gradient(to right, #cbafff, #abc000);
            color: #fff;
            cursor: pointer;
        }
        .btn1 {
            text-align: center;
            padding: 10px;
            width: 100%;
            margin-top: 20px;
            background-image: linear-gradient(to right, #a6c1ee, #fbc2eb);
            color: #fff;
        }
        .msg {
            text-align: center;
            line-height: 88px;
        }
        a {
            text-decoration-line: none;
            color: #abc1ee;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-wrapper">
            <div class="header">Login</div>
            <div class="form-wrapper">
                <input type="text" name="username" onkeyup="this.value=this.value.replace(/[^\w_]/g,'');" required="required" placeholder="用户名" class="input-item" maxlength="15">
                <input type="password" name="password" onkeyup="this.value=this.value.replace(/[^\w_]/g,'');" required="required" placeholder="密码" class="input-item" maxlength="15">
                <button class="btn0" id="btn_signUp">注   册</button>
                <button  class="btn0" id="btn_getUserData">查   询</button>
                <button  class="btn0" id="btn_login">登   录</button>
                <p id="p1" style="font-size:15px;color:red">这是一个段落1。</p>
                <button  class="btn1" id="btn_createUserTable">创建用户表单</button>
                <button  class="btn1" id="btn_test">测   试</button>
            </div>
            <div class="msg">
                Don't have account?
                <a href="#">Sign up</a>
            </div>
        </div>
    </div>

<!-- 根据按钮ID决定执行哪个JQuery事件-->
 <!--
$(document).ready(function() {
    $('#btn_login').click(function() {
var postParam = 
{
'username':"$('input[name='username']').val()",
'password':"$('input[name='password']').val()"
};
document.getElementById("p1").innerHTML= "新文本！";
 $.post(func.php,JSON.stringify(postParam),function(response)
{
alert(response);
},"json");
    });
});-->

<script>//jQuery脚本程序
    $(document).ready(function() {
        $('#btn_signUp').click(function() {//id为btn_signUp的按钮点击后执行的jQuery脚本
        if(($.trim($("input[name='username']").val()) === "")||($.trim($("input[name='password']").val()) === ""))//获取输入框的内容
        {
            alert("用户名和密码不能为空！");
            return;
        }
        //特定的post数据格式
        var postData = 'postType=0&username=' + $("input[name='username']").val() + '&' + 'userPassword=' +  $("input[name='password']").val();
        document.getElementById("p1").innerHTML= postData;//获取id为p1的段落,并修改为post的用户名和密码 
        //1、创建xhr的对象
        let xhr = new XMLHttpRequest();
        //2、调用open函数('请求类型','url')
        xhr.open('POST', "func.php",true);
        //3、设置 Content-Type属性（固定写法）
        xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=utf-8");
        //4、调用send函数
        xhr.send(postData);
        //5、监听事件
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                if(xhr.responseText == 2)
                {
                    alert("用户名已存在！");
                }
                else if(xhr.responseText == 1)
                {
                    alert("注册成功！");
                }
            }
        }
    });
});
    </script>

<script>
$(document).ready(function() {
    $('#btn_getUserData').click(function() {
        if(($.trim($("input[name='username']").val()) === ""))
        {
            alert("用户名不能为空！");
            return;
        }

        var postData = 'postType=1&username=' + $("input[name='username']").val();
        document.getElementById("p1").innerHTML= postData;
        //1、创建xhr的对象
        let xhr = new XMLHttpRequest();
        //2、调用open函数('请求类型','url')
        xhr.open('POST', "func.php",true);
        //3、设置 Content-Type属性（固定写法）
        xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=utf-8");
        //4、调用send函数
        xhr.send(postData);
        //5、监听事件
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                if(xhr.responseText == 4)
                {
                    alert("用户名不存在！");
                }
                else
                {
                    alert("成功获取数据:" + xhr.responseText);
                    document.getElementById("p1").innerHTML= xhr.responseText;
                }
            }
        }
    });
});
</script>

<script>
    $(document).ready(function() {
        $('#btn_login').click(function() {
        if(($.trim($("input[name='username']").val()) === "")||($.trim($("input[name='password']").val()) === ""))
        {
            alert("用户名和密码不能为空！");
            return;
        }
        var postData = 'postType=2&username=' + $("input[name='username']").val() + '&' + 'userPassword=' +  $("input[name='password']").val();
        document.getElementById("p1").innerHTML= postData;
        //1、创建xhr的对象
        let xhr = new XMLHttpRequest();
        //2、调用open函数('请求类型','url')
        xhr.open('POST', "func.php",true);
        //3、设置 Content-Type属性（固定写法）
        xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=utf-8");
        //4、调用send函数
        xhr.send(postData);
        //5、监听事件
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                if(xhr.responseText == 0)
                {
                    localStorage.name =  $("input[name='username']").val();
                    location.href = 'chat.html'; 
                }
                else if(xhr.responseText == 3)
                {
                    alert("密码不正确！");
                }
                else if(xhr.responseText == 4)
                {
                    alert("用户名不存在！");
                }
            }
        }
    });
});
    </script>

<script>
$(document).ready(function() {
    $('#btn_createUserTable').click(function() {
     var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4 && xhr.status == 200){
      // 处理服务器的响应
     alert(xhr.responseText);
    }
  }
  xhr.open("GET", "func.php?getAction=createUserTable", true);//XML 名为getAction的GET方法带参数createUserTable
  xhr.send();
    });
});
</script>

<script>
$(document).ready(function() {
    $('#btn_test').click(function() {
     var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4 && xhr.status == 200){
      // 处理服务器的响应.
     alert(xhr.responseText);
    }
  }
  xhr.open("GET", "func.php?getAction=myTest", true);
  xhr.send();
    });
});
</script>

</body>
</html>