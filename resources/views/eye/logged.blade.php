<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="strict-origin-when-cross-origin" name="referrer">
    <meta content="light dark" name="color-scheme">
    <meta content="notranslate" name="google">
    <meta content="noindex,nofollow" name="googlebot-news">
    <meta content="noindex,nofollow" name="googlebot">
    <meta content="noindex,nofollow" name="robots">
    <meta content="width=device-width,initial-scale=1,minimum-scale=1" name="viewport">
    <meta content="George Marinos" name="author">
    <meta content="LifeSpy" name="description">
    <title>Life Spy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC">
    <link href="{{ asset('css/style_logged.css') }}" rel="stylesheet">
    <link href="{{ asset('favicon.ico') }}" rel="icon" sizes="64x64" type="image/icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('script.js') }}"></script>
</head>

<body>
    <video autoplay class="back_videos" loop muted>
        <source src="{{ asset('vids/back_mobi.webm') }}" type="video/webm">
    </video>

    <section id="grid_form" role="application">
        <img alt="Life Spy Logo" draggable="false" id="logo" src="{{ asset('img/logo.webp') }}" type="image/webp">

        <div id="grid_flex">
            <div id="div_form">
                <p class="msg">You are logged in! Welcome, {{ $email }}!</p>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button id="button_logout" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"></script>
</body>

</html>

<style>
    #form,.msg{text-align:center}html{--active_color:#a36700;box-sizing:border-box;height:100%;overflow:hidden;position:fixed}*,::after,::before{box-sizing:inherit}body{background-color:#000;font-family:Montserrat,Verdana,sans-serif;font-weight:500;margin:0;padding:0}.back_videos{animation:4s ease-in forwards reveal;height:100vh;min-height:100%;min-width:100%;object-fit:cover;opacity:0;position:fixed;width:100vw;z-index:-1}@keyframes reveal{10%{opacity:.1}30%{opacity:.3}60%{opacity:.6}100%{opacity:1}}#grid_form{animation:5s ease-in forwards grid_anime;background-color:rgba(0,0,0,.55);display:grid;grid-template:1fr min(100vh,100vw) 3fr/2fr 1fr 2fr;opacity:0;place-items:center;grid-template-areas:". logo ." ". fluid ." ". . ."}@keyframes grid_anime{0%,20%{opacity:0}70%{opacity:.9}100%{opacity:1}}#grid_flex{display:flex;flex-shrink:0;flex-wrap:wrap;grid-area:fluid}#logo{grid-area:logo;height:auto;margin-top:clamp(15%,30%,20%);padding-bottom:25%;width:clamp(15%,30%,45%)}#form{background-color:rgba(0,0,0,.65);border-radius:5px;margin-bottom:100%;padding-inline:min(24vh,24vw);padding-block:min(7vh,7vw)}.msg{bottom:100%;color:#fff;position:relative;width:33ch}#button_logout{background-color:#fff;border-radius:5px;border:none;color:#000;font-size:clamp(.86rem, 1.11vw, 2rem);height:clamp(2rem,2vw,5rem);margin-bottom:5%;margin-top:8%;margin-inline:39%;width:clamp(4rem,4vw,4rem)}#button_logout:active,#button_logout:focus,#button_logout:hover,#button_logout:visited{background-color:var(--active_color);text-decoration:none}@media only screen and (min-width:1400px){#button_logout{font-size:16px;width:clamp(3rem,4vw,5rem)}}@media only screen and (max-width:500px) and (min-width:430px){#form{padding-inline:min(10vh,10vw);margin-bottom:50%}.input{width:clamp(20rem,20vw,20vh)}#logo{width:clamp(15%,35%,45%);margin-top:clamp(15%,30%,30%);padding-bottom:10%}}@media only screen and (max-width:429px) and (min-width:345px){#form{margin-bottom:70%;padding-inline:min(10vh,10vw);padding-top:3%}.input{width:clamp(17rem,17vw,17vh)}}@media only screen and (max-width:344px) and (min-width:345px){#form{margin-bottom:50%;padding-inline:min(10vh,10vw);padding-top:3%}.input{width:clamp(16rem,16vw,16vh)}}@media only screen and (max-height:510px) and (min-height:435px){#button,#button_logout{height:clamp(2rem,2vw,2rem);margin-left:38%;width:clamp(4.5rem,4.5vw,4.5rem)}#logo{margin-top:clamp(20%,20%,20%)}#form{padding-inline:min(10vh,10vw);padding-top:3%;margin-bottom:80%}.input{width:clamp(20rem,20vw,20vh)}.msg{bottom:35%}#button_logout{margin-bottom:35%}}@media only screen and (max-height:434px) and (min-height:385px){#logo{margin-top:clamp(12%,12%,12%);height:80%;width:30%}#form{margin-bottom:68%;padding-inline:min(10vh,10vw);padding-top:2%}.msg{bottom:25%}.input{width:clamp(20rem,20vw,20vh)}#button_logout{height:clamp(2rem,2vw,2rem);margin-bottom:45%;margin-left:38%;width:clamp(4.5rem,4.5vw,4.5rem)}}@media only screen and (max-height:384px) and (min-height:320px){#button,#button_logout{height:clamp(2rem,2vw,2rem);margin-left:38%;width:clamp(4.5rem,4.5vw,4.5rem)}#logo{margin-top:clamp(9%,9%,9%);height:80%;width:25%}#form{margin-bottom:60%;padding-inline:min(10vh,10vw);padding-top:0}.input{width:clamp(20rem,20vw,20vh)}.msg{bottom:30%}#button{margin-bottom:1%}#button_logout{margin-bottom:30%}}@media only screen and (max-height:319px) and (min-height:260px){#logo{margin-top:clamp(9%,9%,9%);height:76%;width:25%}#form{margin-bottom:60%;padding-inline:min(10vh,10vw);padding-top:0}.input{width:clamp(15rem,15vw,15vh)}#button_logout{height:clamp(1.5rem,2vw,2rem);margin-bottom:8%;margin-left:37%;width:clamp(4rem,4vw,4rem)}}@media only screen and (max-height:260px){#button,#button_logout{height:clamp(1.5rem,1.5vw,1.5rem);margin-left:28%;width:clamp(4.5rem,4.5vw,4.5rem)}#logo{margin-top:clamp(20%,20%,20%);height:70%;width:35%}#form{margin-bottom:68%;padding-inline:min(10vh,10vw);padding-top:2%}.input{width:clamp(10rem,10vw,10vh)}#button{margin-bottom:5%}#button_logout{margin-bottom:6%}}
</style>
