<!DOCTYPE html>
<html>
<head> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pop-up Message - Asmaan MircoFinance</title>
    <style>
        body{
            font-family: Times New Roman, sans-serif;
            text-align: center;
	    background-image: url('../img/m7.jpg'); 
    	    background-size: cover;
    	    background-attachment: fixed;
    	    background-position: bottom;
    	    background-repeat: no-repeat;
    	    margin: 0;
    	    padding: 0;
        }

        .containerrr{ 
            width: 50%;
            height: 30vh;
            display: flex;
            align-items: center;
            justify-content:center;
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

        .popup {
            width: 400px;
            background: #fff;
            border-radius: 6px;
            position: absolute;
            top: 0;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.1);
            text-align: center;
            padding: 0 30px 30px;
            color: #333;
            visibility: hidden;
            transition: transform 0.4s, top 0.4s;
        }

        .open-popup{
            visibility: visible;
            top: 50%;
            transform: translate(-50%, -50%) scale(1);
        }

        .popup img{
            width: 100px;   
            margin-top: -50px;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .popup h2{
            font-size: 38px;
            font-weight: 500;
            margin: 30px 0 10px;
        }
        
        .popup button{
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
    </style>
</head>
<body>
    <div class="container">
        <div class="popup" id="popup">
            <img src="../img/reg1a.jpg">
            <h1>!Congratulations</h1>
            <p style="font-size:21px">Your message was submitted successfully</p>
            <button type="button" onclick="redirect()">OK</button>
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
    window.location.href = "../view/contact_us.php";
}
</script>
</body>
</html> 
