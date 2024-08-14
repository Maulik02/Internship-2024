<html>
    <title>Form</title>
    <head></head>
    <style>
        body {
            padding: 10px 50px;
        }
        .formdesign{
            font-size: 20px;
        }
        .formdesign input{
            width: 50%;
            padding: 12px 20px;
            border: 1px solid blue;
            margin: 15px;
            border-radius: 12px;
            font-size: 15px;
        }
        .formerror{
            color: red;
            font-size: 15px;
            font-weight: bold;  
        }
        .but{
            border-radius: 9px;
            width: 100px;
            height: 50px;
            font-size:25px;
            margin:22px 20px;
        }
    </style>
    <body>
        <h1>Sign Form</h1>
        <form action="/myaction.php" name="myform" onsubmit="return validateForm()" method="post">
        <div class="formdesign" id="name">
            Name:<input type="text" name="fname" require>
            <span class="formerror"></span>
        </div>

        <div class="formdesign" id="email">
            Email:<input type="email" name="femail">
            <span class="formerror"></span>
        </div>

        <div class="formdesign" id="phone">
            Phone:<input type="phone" name="fphone">
            <span class="formerror"></span>
        </div>

        <div class="formdesign" id="pass">
            Password:<input type="password" name="fpass">
            <span class="formerror"></span>
        </div>

        <div class="formdesign" id="cpass">
            Confirm Password:<input type="password" name="fcpass">
            <span class="formerror"></span>
        </div>

        <input type="submit" class="but">
        </form>
    </body>
    <script>
        function seterror(id,error){
            element = document.getElementById(id);
            element.getElementsByClassName('formerror')[0].innerHTML = error;
        }
        function validateForm(){
            var returnval = true;

            var name= document.forms['myform']["fnname"].value;
            if(name.lengh < 5){
                seterror("name","*length of name is to zero");
                returnval = false;
            }

            if(name.lengh == 0){
                seterror("name","*length of name is to short");
                returnval = false;
            }

            return returnval;
        }
    </script>
</html>