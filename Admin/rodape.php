<?php
require_once("../dependencias.php");
require_once("../verificaSessao.php");
?>

<head>
    <style>
        .footer_bottom {
            margin-top: 20px;
            padding-top: 0.4em;
            padding-bottom: 0.1rem;
            background: rgb(20, 141, 197);
        }

        @media screen and (max-width: 960px) {
            .fixed-bottom {
                position: relative !important;
            }
        }

        .follow-us {
            margin-top: 10px;
            margin-bottom: 20px;
            text-align: center;
        }

        .fa {
            display: inline-block;
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
<footer class="footer fixed-bottom">
    <div class="footer_bottom">
        <div class="follow-us"> <a class="fa fa-facebook social-icon" href="https://www.facebook.com/elias.aguera.7"></a> <a class="fab fa-whatsapp social-icon" href="#"></a> <a class="fa fa-google-plus social-icon" href="#"></a> </div>
        <div class="copy">
            <p>Copyright &copy; Depósito Brasil - Materiais para Construcão - 1994 - 2021</p>
        </div>
    </div>
</footer>