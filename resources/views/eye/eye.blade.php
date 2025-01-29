<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta content="IE=edge" http-equiv="X-UA-Compatible" />
        <meta content="strict-origin-when-cross-origin" name="referrer" />
        <meta content="light dark" name="color-scheme" />
        <meta content="notranslate" name="google" />
        <meta content="noindex,nofollow" name="googlebot-news" />
        <meta content="noindex,nofollow" name="googlebot" />
        <meta content="noindex,nofollow" name="robots" />
        <meta content="width=device-width,initial-scale=1,minimum-scale=1" name="viewport" />
        <meta content="George Marinos" name="author" />
        <meta content="{{ csrf_token() }}" name="csrf-token" />
        <meta content="LifeSpy" name="description" />
        <title>Life Spy</title>
        <link href="{{ asset('favicon.ico') }}" rel="icon" sizes="64x64" type="image/icon" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"></script>
        <script src="{{ asset('script.js') }}"></script>
    </head>
    <body>
        <video autoplay class="back_videos" loop muted playsinline><source src="{{ asset('vids/back_mobi.webm') }}" type="video/webm" /></video>
        <div id="warn_container" class="d-flex flex-row text-center">
            <div id="warning" class="alert fade p-0 show alert-danger"><h6>Your password must include a lowercase letter.</h6></div>
            <div id="warning2" class="alert fade p-0 show alert-danger"><h6>Your password must include a number.</h6></div>
            <div id="warning3" class="alert fade p-0 show alert-danger"><h6>Your password must include an uppercase letter.</h6></div>
            <div id="warning4" class="alert fade p-0 show alert-danger"><h6>Your password must include a symbol.</h6></div>
            <div id="warning5" class="alert fade p-0 show alert-danger"><h6>Your password can't include non-English characters.</h6></div>
            <div id="warning_incorrect_password" class="alert fade p-0 show alert-warning"><h6>You typed something wrong.</h6></div>
        </div>
        <section id="grid_form" role="application">
            <img alt="Life Spy Logo" draggable="false" id="logo" src="{{ asset('img/logo.webp') }}" />
            <div id="grid_flex">
                <form action="{{ route('signup') }}" id="form" method="POST">
                    @csrf
                    <div id="div_form">
                        <input class="input" id="email" name="email" placeholder="Email" required type="email" /><br />
                        <input class="input" id="pass" name="password" placeholder="Password" required type="password" minlength="8" /><br />
                       <div id="loader_div"><span id="loader" ></span></div> 
                        <button id="button" type="submit">Enter</button>
                    </div>
                </form>
            </div>
        </section>
        <div id="cookie-info" style="display: none; position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); background-color: rgba(0, 0, 0, 0.8); color: #fff; padding: 10px 20px; border-radius: 5px; z-index: 1000;">
            <p style="margin: 0; font-size: 14px; text-align: center;">We use cookies essential for login.</p>
        </div>
    </body>
</html>


<style>
#grid_flex,#warn_container{display:flex}html{--active_color:#a36700;box-sizing:border-box;overflow:hidden;position:fixed}*,::after,::before{box-sizing:inherit}body{background-color:#000;font-family:Montserrat,Verdana,sans-serif;font-weight:500;margin:0;padding:0}.back_videos{animation:3s ease-in forwards reveal;height:100vh;min-height:100%;min-width:100%;object-fit:cover;opacity:0;position:fixed;width:100vw;z-index:-1}@keyframes reveal{10%{opacity:.1}30%{opacity:.3}60%{opacity:.6}100%{opacity:1}}#grid_form{animation:3s ease-in forwards grid_anime;background-color:rgba(0,0,0,.55);display:grid;grid-template:1fr min(100vh,100vw) 3fr/2fr 1fr 2fr;opacity:0;place-items:center;margin-top:-8rem;grid-template-areas:". logo ." ". fluid ." ". . ."}@keyframes grid_anime{0%,55%{opacity:0}100%{opacity:1}}#grid_flex{flex-shrink:0;flex-wrap:wrap;grid-area:fluid}#logo{grid-area:logo;height:auto;margin-top:clamp(15%,30%,20%);padding-bottom:25%;width:clamp(15%,30%,45%)}#form{background-color:rgba(0,0,0,.65);border-radius:5px;margin-bottom:70%;padding-inline:min(5vh,5vw);padding-top:0}button:active,button:focus,button_login:active,button_login:focus,input:active,input:focus{outline:0}.input{background-color:rgba(0,0,0,0);border-bottom:2px solid #fff;border:none;color:#fff;font-size:clamp(1rem, 1.5vw, 2rem);margin-block:8%;text-align:center;width:clamp(25rem,25vw,25vh)}.input:hover{border-bottom:2px solid var(--active_color);border-top:2px solid var(--active_color);padding-block:+3%;transition:.25s}.input:not(:active),.input:not(:hover){padding-block:-3%;transition:.2s}.input:active{padding-block:+3%;transition:.25s}.input:focus,.input:focus-within{background-color:#000;border-radius:5px;border:2px solid var(--active_color);padding-block:+3%;text-align:left;transition:.2s}.input:focus-within:hover{animation:none}.input:focus-within:not(:hover){padding-block:2%}.input:not(:focus-within){text-align:center}#button{background-color:#fff;border-radius:5px;border:none;color:#000;font-size:clamp(.86rem, 1.11vw, 2rem);height:clamp(2.5rem,2.5vw,5.5rem);margin-bottom:5%;margin-left:40.5%;margin-top:10%;width:clamp(5rem,5vw,7rem)}#button:active,#button:focus,#button:hover,#button:visited,#button_login:active,#button_login:focus,#button_login:hover,#button_login:visited{background-color:var(--active_color);text-decoration:none}#warning,#warning2,#warning3,#warning4,#warning5,#warning_incorrect_password{height:5rem;transform:translate(0,-100%);width:30%;z-index:999;opacity:.75}#warning2,#warning3,#warning4,#warning5,#warning_incorrect_password{margin-left:1.5rem}.show_warning{animation:2s both warning_animation}.hide_warning{animation:2s both warning_animation_retract}@keyframes warning_animation{0%{transform:translate(0,-100%)}100%{transform:translate(0,3%)}}@keyframes warning_animation_retract{0%{transform:translate(0,3%)}100%{transform:translate(0,-100%)}}@media only screen and (max-width:900px) and (min-width:740px){#warning,#warning2,#warning3,#warning4,#warning5,#warning_incorrect_password{height:6rem}#grid_form{margin-top:-10rem}@keyframes warning_animation{0%{transform:translate(0,-110%)}100%{transform:translate(0,3%)}}}@keyframes warning_animation_retract{0%{transform:translate(0,3%)}100%{transform:translate(0,-110%)}}@media only screen and (max-width:740px) and (min-width:650px){#warning,#warning2,#warning3,#warning4,#warning5,#warning_incorrect_password{height:7.5rem;transform:translate(0,-110%)}#grid_form{margin-top:-12rem}}@media only screen and (max-width:650px) and (min-width:500px){#warning,#warning2,#warning3,#warning4,#warning5,#warning_incorrect_password{height:9rem;transform:translate(0,-105%)}#grid_form{margin-top:-14rem}@keyframes warning_animation{0%{transform:translate(0,-105%)}100%{transform:translate(0,3%)}}@keyframes warning_animation_retract{0%{transform:translate(0,3%)}100%{transform:translate(0,-105%)}}}@media only screen and (max-width:600px) and (min-width:550px){#grid_form{margin-right:1rem}}@media only screen and (max-width:550px) and (min-width:500px){#grid_form{margin-right:3rem}}@media only screen and (max-width:500px){#grid_form{margin-right:3rem;scale:0.9;position:relative;right:2rem;bottom:2rem}}@media only screen and (max-width:500px) and (min-width:430px){#form{padding-top:3%;padding-inline:min(10vh,10vw)}.input{width:clamp(20rem,20vw,20vh)}#button{margin-left:38%;width:clamp(4.5rem,4.5vw,4.5rem);height:clamp(2rem,2vw,2rem)}#warning,#warning2,#warning3,#warning4,#warning5,#warning_incorrect_password{height:10rem;transform:translate(0,-110%)}#grid_form{margin-top:-14rem}@keyframes warning_animation{0%{transform:translate(0,-110%)}100%{transform:translate(0,3%)}}@keyframes warning_animation_retract{0%{transform:translate(0,3%)}100%{transform:translate(0,-110%)}}}@media only screen and (max-width:429px) and (min-width:345px){#form,#logo{right:0;position:relative}#logo{margin-top:0;top:65vw}#form{margin:0;padding-inline:min(10vh,10vw);padding-top:3%;transform:scale(.7);text-align:center;top:40vw}.input{width:clamp(17rem,17vw,17vh)}#button{height:clamp(2rem,2vw,2rem);margin-bottom:5%;margin-inline:37%;margin-top:12%;width:clamp(4.5rem,4.5vw,4.5rem)}#warning,#warning2,#warning3,#warning4,#warning5,#warning_incorrect_password{transform:translate(0,-120%);font-size:1ch;line-height:1.6ch}}@media only screen and (max-height:510px) and (min-height:435px){#logo{margin-top:clamp(20%,20%,20%)}#form{padding-inline:min(10vh,10vw);padding-top:3%;margin-bottom:80%}.input{width:clamp(20rem,20vw,20vh)}#button{height:clamp(2rem,2vw,2rem);margin-left:38%;width:clamp(4.5rem,4.5vw,4.5rem)}}@media only screen and (max-height:434px) and (min-height:385px){#logo{margin-top:clamp(12%,12%,12%);height:80%;width:30%}#form{margin-bottom:68%;padding-inline:min(10vh,10vw);padding-top:2%}.input{width:clamp(20rem,20vw,20vh)}#button{height:clamp(2rem,2vw,2rem);margin-bottom:1%;margin-left:38%;width:clamp(4.5rem,4.5vw,4.5rem)}}@media only screen and (max-height:384px) and (min-height:320px){#logo{margin-top:clamp(9%,9%,9%);height:76%;width:25%}#form{margin-bottom:60%;padding-inline:min(10vh,10vw);padding-top:0}.input{width:clamp(20rem,20vw,20vh)}#button{height:clamp(2rem,2vw,2rem);margin-bottom:1%;margin-left:38%;width:clamp(4.5rem,4.5vw,4.5rem)}}@media only screen and (max-height:319px) and (min-height:260px){#logo{margin-top:clamp(9%,9%,9%);height:76%;width:25%}#form{margin-bottom:60%;padding-inline:min(10vh,10vw);padding-top:0}.input{width:clamp(15rem,15vw,15vh)}#button{height:clamp(1.5rem,1.5vw,1.5rem);margin-bottom:1%;margin-left:37%;width:clamp(4rem,4vw,4rem)}}@media only screen and (max-height:260px){#logo{margin-top:clamp(20%,20%,20%);height:70%;width:35%}#form{margin-bottom:68%;padding-inline:min(10vh,10vw);padding-top:2%}.input{width:clamp(10rem,10vw,10vh)}#button{height:clamp(1.5rem,1.5vw,1.5rem);margin-bottom:5%;margin-left:28%;width:clamp(4.5rem,4.5vw,4.5rem)}}


#loader {
  width: 16px;
  height: 16px;
  border-radius: 50%;
  display: block;
  margin:15px auto;
  position: relative;
  background: #FFF;
  box-shadow: -24px 0 #FFF, 24px 0 #FFF;
  box-sizing: border-box;
  animation: loading 2s linear infinite;
}

#loader_div{
display: none;
padding-block: 100px;
padding-inline: 150px;
}

@keyframes loading {
  33% {
    background: #FFF;
    box-shadow: -24px 0 #FF3D00, 24px 0 #FFF;
  }
  66% {
    background: #FF3D00;
    box-shadow: -24px 0 #FFF, 24px 0 #FFF;
  }
  100% {
    background: #FFF;
    box-shadow: -24px 0 #FFF, 24px 0 #FF3D00;
  }
}
</style>