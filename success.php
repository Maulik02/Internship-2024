<html>
<head>
    <title>Success</title>
</head>
<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        background-image: url('image/15.jpg');
        background-size: cover;
    }
    h1 {
        margin-top: 10px;
        text-align: center;
        font-size: 30px;
        color: #ccc;
    }
    .box {
        width: 300px;
        height: 300px;
        background-color: #64a4e0;
        border-radius: 10px;
        margin: 0 auto;
        padding: 20px;
        text-align: center;
        color: white;
        font-size: 20px;
        font-weight: bold;
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.75);
        transition: all 0.5s ease-in-out;
        margin-top: 200px;
    }
    .box2{
        height: 130px;
        margin-top: 45px;
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.75);
        transition: all 0.5s ease-in-out;
        background-color: #64a4e0;
        border-radius: 10px;
    }
    .box3 {
        background-color:#61df91;
        border: 1px solid #efa31d;
        border-radius:9px;
        color: white;
        margin-top: 30px;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        -webkit-transition-duration: 0.4s;
        transition-duration: 0.4s;
    }
    .label {
        margin-top: 0px;
        padding-top: 0px;
        font-size: 16px;
        color: #77e2db;
        font-weight: bold;
    }
    a {
        text-decoration: none;
        color: white;
        padding: 15px 5px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px;
        cursor: pointer;
        -webkit-transition-duration: 0.4s;
        transition-duration: 0.4s;
    }
    </style>
<body>
    <div class = "box">
        <h1>Registration Successful</h1>
        <div class = "box2">
            <label class="label">Congratulations and thanks for signing up and logging in to the page, Go to the login page</label>
            <div class="box3">
            <a href = "index1.php" class = "btn btn-primary">Home</a>
            </div>   
        </div>
    </div>
    <script>
        function(){
            window.location.href = "index1.php";
        };
    </script>
    
</body>
</html>