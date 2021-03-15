<?php
require_once("dependencias.php");

?>

<head>
    <style>
        .footer_bottom {
            margin-top: 20px;
            padding: 2em 0;
            /* background: #2ABB9B; */
            background: rgb(20, 141, 197);
        }

        .follow-us {
            margin-top: 10px;
            margin-bottom: 20px;
            text-align: center;
        }

        .fa {
            display: inline-block;
            font: normal normal normal 14px/1 FontAwesome;
            font-size: inherit;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .social-icon {
            padding-top: 6px;
            font-size: 16px;
            text-align: center;
            width: 32px;
            height: 32px;
            border: 2px solid #d5f1eb;
            border-radius: 50%;
            color: #d5f1eb;
            margin: 5px;
        }

        a.social-icon:hover,
        a.social-icon:active,
        a.social-icon:focus {
            text-decoration: none;
            color: #e5e52d;
            border-color: #e5e52d;
        }

        .copy {
            text-align: center;
        }

        .copy p {
            font-size: 1em;
            color: #fff;
        }

        .copy p a {
            color: #fff;
            border-bottom: 1px dotted;
        }

        .copy p a:hover {
            color: #e5e52d;
            border-bottom: 1px solid;
            text-decoration: none;
        }
    </style>
</head>
<div class="footer">
    <div class="footer_bottom">
        <div class="follow-us"> <a class="fa fa-facebook social-icon" href="https://www.facebook.com/elias.aguera.7"></a> <a class="fa fa-twitter social-icon" href="#"></a> <a class="fa fa-linkedin social-icon" href="#"></a> <a class="fa fa-google-plus social-icon" href="#"></a> </div>
        <div class="copy">
            <p>Copyright &copy; Depósito Brasil - Materiais para Construcão - 1994 - 2021</p>
        </div>
    </div>
</div>