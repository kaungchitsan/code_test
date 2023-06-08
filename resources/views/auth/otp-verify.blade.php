<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Otp Verify</title>
    <style>
        .height-100 {
            height: 100vh
        }
        .card {
            width: 400px;
            border: none;
            height: 300px;
            box-shadow: 0px 5px 20px 0px #d2dae3;
            /* z-index: 1; */
            /* display: flex;
            justify-content: center;
            align-items: center; */
            margin: 0 auto;
            /* margin-top: 200px; */
            padding: 50px
        }

        .card h6 {
            font-size: 20px;
            text-align: center;
        }
        .card-body{
            text-align: center;
        }

        .card-body div{
            margin-bottom: 20px;
        }

        .inputs input {
            width: 40px;
            height: 40px
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0
        }

        .form-control:focus {
            box-shadow: none;
            border: 2px solid red
        }

        .verify {
            border-radius: 20px;
            height: 40px;
            background-color: red;
            border: 1px solid red;
            width: 140px;
            color: #fff;
            cursor: pointer;
        }
        .verify:hover{
            background: rgba(255, 0, 0, .7)
        }
    </style>
</head>
<body>
    <div class="container height-100 d-flex justify-content-center align-items-center">
        <div class="position-relative">
            <div class="card p-2 text-center">
                <div class="card-header">
                    <h6>Please enter the one time password <br> to verify your account</h6>
                </div>
                <div class="card-body">
                    <div><span>A code has been sent to</span> <small> +{{$msisdn}}</small> </div>
                    <form action="{{ route('verify') }}" method="POST">
                        @csrf
                        <input type="hidden" name="msisdn" value="{{$msisdn}}">
                        <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2"> 
                            <input class="m-2 text-center form-control rounded" name="first" type="text" id="first" maxlength="1" /> 
                            <input class="m-2 text-center form-control rounded" name="second" type="text" id="second" maxlength="1" /> 
                            <input class="m-2 text-center form-control rounded" name="third" type="text" id="third" maxlength="1" /> 
                            <input class="m-2 text-center form-control rounded" name="fourth" type="text" id="fourth" maxlength="1" /> 
                            <input class="m-2 text-center form-control rounded" name="fifth" type="text" id="fifth" maxlength="1" /> 
                            <input class="m-2 text-center form-control rounded" name="sixth" type="text" id="sixth" maxlength="1" /> 
                        </div>
                        <div class="mt-4"> 
                            <input type="submit" value="Verify" class="btn btn-success verify">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {

function OTPInput() {
const inputs = document.querySelectorAll('#otp > *[id]');
for (let i = 0; i < inputs.length; i++) { inputs[i].addEventListener('keydown', function(event) { if (event.key==="Backspace" ) { inputs[i].value='' ; if (i !==0) inputs[i - 1].focus(); } else { if (i===inputs.length - 1 && inputs[i].value !=='' ) { return true; } else if (event.keyCode> 47 && event.keyCode < 58) { inputs[i].value=event.key; if (i !==inputs.length - 1) inputs[i + 1].focus(); event.preventDefault(); } else if (event.keyCode> 64 && event.keyCode < 91) { inputs[i].value=String.fromCharCode(event.keyCode); if (i !==inputs.length - 1) inputs[i + 1].focus(); event.preventDefault(); } } }); } } OTPInput(); });
    </script>
</body>
</html>