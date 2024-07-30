<!DOCTYPE html>
<html>
<head> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pop-up Message - Asmaan MircoFinance</title>
    <style>
        body{
            font-family: Times New Roman, sans-serif;
            text-align: center;
	        background-image: url('../img/m6.jpg'); 
    	    background-size: cover;
    	    background-attachment: fixed;
    	    background-position: bottom;
    	    background-repeat: no-repeat;
    	    margin: 0;
    	    padding: 0;
        }

        .container { 
            width: 50%;
            height: 30vh;
            display: flex;
            align-items: center;
            justify-content:center;
        }

        .popup {
            width: 400px;
            background: #fff;
            border-radius: 6px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.1);
            text-align: center;
            padding: 0 30px 30px;
            color: #333;
            visibility: hidden;
            transition: transform 0.4s, top 0.4s;
        }

        .open-popup {
            visibility: visible;
            transform: translate(-50%, -50%) scale(1);
        }

        .popup img {
            width: 100px;   
            margin-top: -50px;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .popup h2 {
            font-size: 38px;
            font-weight: 500;
            margin: 30px 0 10px;
        }
        
        .popup button {
            width: 100%;
            margin-top: 50px;
            padding: 10px 0;
            background: #6fd649;
            color: #fff;
            border: 0;
            outline: none;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0 5px 5px rgba(0,0,0,0.2);
        }

        .popup button:hover {
            background: red;
        }

        .btnnn{
            padding: 10px 60px;
            background: #fff;
            border: 0;
            outline: none;
            cursor: pointer;
            font-size: 22px;
            font-weight: 500;
            border-radius: 30px;
        }

        button {
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #ff7200;
            color: #fff;
        }

        button:hover {
            background-color: beige;
            color: maroon;  
        }
        
    </style>

</head>
<body>
    <div class="container">
        <div class="popup" id="popup">
            <img src="../img/failed2.webp">
            <h1>No Record Found Alert!</h1>
            <p style="font-size:21px">You provided a <b style="color: red">non-existent</b> email</p>
            <button type="button" onclick="redirect()" style="color: beige; background-color: red;">OK</button>
        </div>
    </div>

<script>
let popup = document.getElementById("popup");

// Automatically open the popup
window.onload = function() {
    popup.classList.add("open-popup");
}

// Redirect function
function redirect() {
    // Redirect to the login view
    window.location.href = "../login/login_view.php";
}
</script>
</body>
</html> 
