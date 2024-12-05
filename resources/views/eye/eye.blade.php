<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="referrer" content="strict-origin-when-cross-origin" />
    <meta name="color-scheme" content="light dark" />
    <meta name="google" content="notranslate" />
    <meta name="googlebot-news" content="noindex,nofollow" />
    <meta name="googlebot" content="noindex,nofollow" />
    <meta name="robots" content="noindex,nofollow" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <meta name="author" content="George Marinos" />
    <meta name="description" content="LifeSpy">
    <title>Life Spy</title>
    <link rel="icon" type="image/icon" sizes="64x64" href="{{ asset('favicon.ico') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('script.js') }}"></script>

</head>

<body>
    <!-- Background video -->
    <video autoplay muted loop class="back_videos">
        <source src="{{ asset('vids/back_mobi.webm') }}" type="video/webm" />
        <img src="{{ asset('img/back_ff.png') }}" alt="Background Fallback">
    </video>

    <!-- Error/warning messages for password rules -->
    <div id="warn_container" class="d-flex flex-row text-center">
        <div id="warning" class="alert alert-warning fade show p-0 h6">
            <strong>Error:</strong> Your password must include a lowercase letter.
        </div>
        <div id="warning2" class="alert alert-warning fade show p-0 h6">
            <strong>Error:</strong> Your password must include a number.
        </div>
        <div id="warning3" class="alert alert-warning fade show p-0 h6">
            <strong>Error:</strong> Your password must include an uppercase letter.
        </div>
        <div id="warning4" class="alert alert-warning fade show p-0 h6">
            <strong>Error:</strong> Your password must include a symbol.
        </div>
        <div id="warning5" class="alert alert-warning fade show p-0 h6">
            <strong>Error:</strong> Your password can't include non-English characters.
        </div>
    </div>

    <!-- Main section for forms -->
    <section role="application" id="grid_form">
        <img src="{{ asset('img/logo.webp') }}" alt="Life Spy Logo" id="logo" draggable="false">
        <div id="grid_flex">
            <!-- Sign Up Form -->
            <form method="POST" action="{{ route('signup') }}" id="form">
                @csrf
                <div id="div_form">
                    <input type="email" name="email" placeholder="Email" class="input" id="email" required>
                    <br>
                    <input type="password" name="password" placeholder="Password" class="input" id="pass" minlength="8" required>
                    <br>
                    <button type="submit" id="button">Sign Up</button>
                </div>
            </form>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div id="div_form">
                    <button type="submit" id="button_login">Login</button>
                </div>
            </form>
        </div>

        <!-- Display success or error messages -->
        @if (isset($error)) <!-- Display cookie error message -->
        <div class="alert alert-danger">
            {{ $error }}
        </div>
        @endif
    </section>




    <div id="cookie-info" style="display: none; position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); background-color: rgba(0,0,0,0.8); color: white; padding: 10px 20px; border-radius: 5px; z-index: 1000; opacity: 1; transition: opacity 1s, transform 1s;">
        <p style="margin: 0; font-size: 14px; text-align:center">We use cookies essential for login.</p>
    </div>


    <script>
        window.addEventListener('load', () => {
            const banner = document.getElementById('cookie-info');

            // Show the banner
            banner.style.display = 'block';

            // Automatically minimize the banner after 5 seconds
            setTimeout(() => {
                banner.style.opacity = '0'; // Fade out
                banner.style.transform = 'translateX(-50%) translateY(20px)'; // Move down slightly
            }, 5000);

            // Remove the banner from the DOM after the transition completes
            setTimeout(() => {
                banner.style.display = 'none';
            }, 6000); // Match transition duration (5 seconds fade + 1 second buffer)
        });
    </script>


    <!-- jQuery and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>


<style>
    /* 
1.basics 
2.pseudo_loader
3.background
4.main_grid
5 main_content
5.1 inputs+animations
5.2 button 
6. alerts
7. media 
*/

    /* -------------------------------------------- */

    /* 1.basics */
    html {
        --active_color: #a36700;
        box-sizing: border-box;
        /* κουτια χωρίς overflow */
        height: 100%;
        overflow: hidden;
        position: fixed;
    }

    *,
    *::before,
    *::after {
        box-sizing: inherit;
    }

    body {
        background-color: black;
        font-family: "Montserrat", Verdana, sans-serif;
        font-weight: 500;
        margin: 0;
        padding: 0;
    }

    /* -------------------------------------------- */

    /* 2.pseudo_loader */
    /* loader που φευγει με animation

#loader {
  animation: disappear 7.5s ease-out forwards;
  height: min(25vh, 30vw);
  left: 45%;
  position: fixed;
  right: 45%;
  top: 30%;
  width: min(20vh, 20vw);
}
*/
    /* #loader > * {
  border-radius: 50%;
} */

    /* #loader_black {
  border-top: 15px solid black;
  border-radius: 50%;
  width: 100%;
  height: 100%;
  margin-bottom: -95%;
  animation: rotation 3s linear infinite;
}

#loader_orange {
  animation: rotation 2.5s linear infinite;
  border-bottom: 15px solid var(--active_color);
  border-radius: 50%;
  height: 100%;
  width: 100%;
}

@keyframes rotation {
  50% {
    rotate: 160deg;
  }
  70% {
    rotate: 260deg;
  }
  100% {
    rotate: 360deg;
  }
}

@keyframes disappear {
  100% {
    opacity: 0;
  }
}
 */
    /* 3.background */
    /* διαμόρφωση των backgrounds */
    .back_videos {
        animation: reveal 4s ease-in forwards;
        height: 100vh;
        min-height: 100%;
        min-width: 100%;
        object-fit: cover;
        opacity: 0;
        position: fixed;
        width: 100vw;
        z-index: -1;
    }

    @keyframes reveal {
        10% {
            opacity: 0.1;
        }

        30% {
            opacity: 0.3;
        }

        60% {
            opacity: 0.6;
        }

        100% {
            opacity: 1;
        }
    }

    /* -------------------------------------------- */

    /* 4.main_grid */
    /* responsive grid στο οποιο τα αντικείμενα του είναι flex */
    #grid_form {
        animation: grid_anime 5s ease-in forwards;
        background-color: rgba(0, 0, 0, 0.55);
        display: grid;
        grid-template: 1fr min(100vh, 100vw) 3fr / 2fr 1fr 2fr;
        opacity: 0;
        place-items: center;
        margin-top: -8rem;
        grid-template-areas:
            ". logo ."
            ". fluid ."
            ". . .";
    }

    @keyframes grid_anime {
        0% {
            opacity: 0;
        }

        20% {
            opacity: 0;
        }

        70% {
            opacity: 0.9;
        }

        100% {
            opacity: 1;
        }
    }

    #grid_flex {
        display: flex;
        flex-shrink: 0;
        flex-wrap: wrap;
        grid-area: fluid;
    }

    /* -------------------------------------------- */

    /* 5 main_content */
    /* διαμόρφωση του logo/div της φόρμας */
    #logo {
        grid-area: logo;
        height: auto;
        margin-top: clamp(15%, 30%, 20%);
        padding-bottom: 25%;
        width: clamp(15%, 30%, 45%);
    }

    #form {
        background-color: rgba(0, 0, 0, 0.65);
        border-radius: 5px;
        margin-bottom: 70%;
        padding-inline: min(5vh, 5vw);
        padding-top: 0%;
    }

    /* -------------------------------------------- */

    /* 5.1 inputs+animations */
    /* διαμόρφωση και animation των inputs*/

    button:active,
    button:focus,
    button_login:active,
    button_login:focus,
    input:active,
    input:focus {
        outline-style: dotted;
        outline: 0;
    }

    .input {
        background-color: rgba(0, 0, 0, 0);
        border-bottom: 2px solid white;
        border: none;
        color: white;
        font-size: clamp(1rem, 1.5vw, 2rem);
        margin-block: 8%;
        text-align: center;
        width: clamp(25rem, 25vw, 25vh);
    }

    .input:hover {
        /* animation: hover_animation 0.15s ease forwards; */
        border-bottom: 2px solid var(--active_color);
        border-top: 2px solid var(--active_color);
        padding-block: +3%;
        transition: all ease 0.25s;
    }

    .input:not(:hover),
    .input:not(:active) {
        padding-block: -3%;
        transition: all ease 0.2s;
    }

    .input:active {
        padding-block: +3%;
        transition: all ease 0.25s;
    }

    .input:focus,
    .input:focus-within {
        background-color: black;
        border-radius: 5px;
        border-radius: 5px;
        border: 2px solid var(--active_color);
        padding-block: +3%;
        text-align: left;
        transition: all ease 0.2s;
    }

    .input:focus-within:hover {
        animation: none;
    }

    .input:focus-within:not(:hover) {
        padding-block: 2%;
    }

    .input:not(:focus-within) {
        text-align: center;
    }

    /* -------------------------------------------- */

    /* 5.2 button */
    /* διαμόρφωση του κουμπιου login*/
    #button {
        background-color: white;
        border-radius: 5px;
        border: none;
        color: black;
        font-size: clamp(0.86rem, 1.11vw, 2rem);
        height: clamp(2.5rem, 2.5vw, 5.5rem);
        margin-bottom: 5%;
        margin-left: 40.5%;
        margin-top: 10%;
        width: clamp(5rem, 5vw, 7rem);
    }

    #button_login {
        background-color: white;
        border-radius: 5px;
        border: none;
        color: black;
        font-size: clamp(0.86rem, 1.11vw, 2rem);
        height: clamp(2.5rem, 2.5vw, 5.5rem);
        margin-bottom: 5%;
        margin-left: 40.5%;
        margin-top: 8%;
        width: clamp(5rem, 5vw, 7rem);
    }

    #button:hover,
    #button:visited,
    #button:focus,
    #button:active,
    #button_login:hover,
    #button_login:visited,
    #button_login:focus,
    #button_login:active {
        background-color: var(--active_color);
        text-decoration: none;
    }

    /* -------------------------------------------- */

    /* 6.alerts */

    #warn_container {
        display: flex;
    }

    #warning,
    #warning2,
    #warning3,
    #warning4,
    #warning5 {
        height: 5rem;
        transform: translate(0%, -100%);
        width: 30%;
        z-index: 999;
    }

    #warning2,
    #warning3,
    #warning4,
    #warning5 {
        margin-left: 1.5rem;
    }

    .show_warning {
        animation: warning_animation 2s ease both;
    }

    .hide_warning {
        animation: warning_animation_retract 2s ease both;
    }

    @keyframes warning_animation {
        0% {
            transform: translate(0%, -100%);
        }

        100% {
            transform: translate(0%, 3%);
        }
    }

    @keyframes warning_animation_retract {
        0% {
            transform: translate(0%, 3%);
        }

        100% {
            transform: translate(0%, -100%);
        }
    }

    /* -------------------------------------------- */

    /* 7.media */
    @media only screen and (max-width: 900px) and (min-width: 740px) {

        #warning,
        #warning2,
        #warning3,
        #warning4,
        #warning5 {
            height: 6rem;
        }

        #grid_form {
            margin-top: -10rem;
        }
    }

    @media only screen and (max-width: 740px) and (min-width: 650px) {

        #warning,
        #warning2,
        #warning3,
        #warning4,
        #warning5 {
            height: 7.5rem;
        }

        #grid_form {
            margin-top: -12rem;
        }
    }

    @media only screen and (max-width: 650px) and (min-width: 500px) {

        #warning,
        #warning2,
        #warning3,
        #warning4,
        #warning5 {
            height: 9rem;
            transform: translate(0%, -105%);
        }

        #grid_form {
            margin-top: -14rem;
        }

        @keyframes warning_animation {
            0% {
                transform: translate(0%, -105%);
            }

            100% {
                transform: translate(0%, 3%);
            }
        }

        @keyframes warning_animation_retract {
            0% {
                transform: translate(0%, 3%);
            }

            100% {
                transform: translate(0%, -105%);
            }
        }
    }

    @media only screen and (max-width: 499px) and (min-width: 430px) {
        #form {
            padding-top: 3%;
            padding-inline: min(10vh, 10vw);
        }

        .input {
            width: clamp(20rem, 20vw, 20vh);
        }

        #button {
            margin-left: 38%;
            width: clamp(4.5rem, 4.5vw, 4.5rem);
            height: clamp(2rem, 2vw, 2rem);
        }

        #button_login {
            height: clamp(2rem, 2vw, 2rem) !important;
            margin-bottom: 3%;
            margin-left: 38%;
            width: clamp(4.5rem, 4.5vw, 4.5rem);
        }

        #warning,
        #warning2,
        #warning3,
        #warning4,
        #warning5 {
            height: 10rem;
            transform: translate(0%, -110%);
        }

        #grid_form {
            margin-top: -14rem;
        }

        @keyframes warning_animation {
            0% {
                transform: translate(0%, -110%);
            }

            100% {
                transform: translate(0%, 3%);
            }
        }

        @keyframes warning_animation_retract {
            0% {
                transform: translate(0%, 3%);
            }

            100% {
                transform: translate(0%, -110%);
            }
        }
    }

    /* //// */

    @media only screen and (max-width: 429px) and (min-width: 345px) {
        #logo {
            margin-top: 0;
            position: relative;
            right: 0vw;
            top: 65vw;
        }

        #form {
            margin: 0;
            /* left: 50%; */
            right: 0vw;
            padding-inline: min(10vh, 10vw);
            padding-top: 3%;
            transform: scale(0.7);
            position: relative;
            text-align: center;
            top: 40vw;
        }

        .input {
            width: clamp(17rem, 17vw, 17vh);
        }

        #button {
            height: clamp(2rem, 2vw, 2rem);
            margin-bottom: 5%;
            margin-inline: 37%;
            margin-top: 12%;
            width: clamp(4.5rem, 4.5vw, 4.5rem);
        }

        #button_login {
            height: clamp(2rem, 2vw, 2rem);
            margin-bottom: 12%;
            margin-inline: 37%;
            width: clamp(4.5rem, 4.5vw, 4.5rem);
        }

        #warning,
        #warning2,
        #warning3,
        #warning4,
        #warning5 {
            transform: translate(0%, -120%);
            font-size: 1ch;
            line-height: 1.6ch;
        }
    }

    /* //// 

@media only screen and (max-width: 344px) and (min-width: 345px) {
  #form {
    margin-bottom: 50%;
    padding-inline: min(10vh, 10vw);
    padding-top: 3%;
  }

  .input {
    width: clamp(16rem, 16vw, 16vh);
  }

  #button {
    height: clamp(1.5rem, 1.5vw, 1.5rem);
    margin-left: 35%;
    width: clamp(4rem, 4vw, 4rem);
  }
}

 //// */

    @media only screen and (max-height: 510px) and (min-height: 435px) {
        #logo {
            margin-top: clamp(20%, 20%, 20%);
        }

        #form {
            padding-inline: min(10vh, 10vw);
            padding-top: 3%;
            margin-bottom: 80%;
        }

        .input {
            width: clamp(20rem, 20vw, 20vh);
        }

        #button {
            height: clamp(2rem, 2vw, 2rem);
            margin-left: 38%;
            width: clamp(4.5rem, 4.5vw, 4.5rem);
        }

        #button_login {
            height: clamp(2rem, 2vw, 2rem);
            margin-bottom: 3%;
            margin-left: 38%;
            width: clamp(4.5rem, 4.5vw, 4.5rem);
        }
    }

    /* //// */

    @media only screen and (max-height: 434px) and (min-height: 385px) {
        #logo {
            margin-top: clamp(12%, 12%, 12%);
            height: 80%;
            width: 30%;
        }

        #form {
            margin-bottom: 68%;
            padding-inline: min(10vh, 10vw);
            padding-top: 2%;
        }

        .input {
            padding-bottom: -15px;
            width: clamp(20rem, 20vw, 20vh);
        }

        #button {
            height: clamp(2rem, 2vw, 2rem);
            margin-bottom: 1%;
            margin-left: 38%;
            width: clamp(4.5rem, 4.5vw, 4.5rem);
        }

        #button_login {
            height: clamp(2rem, 2vw, 2rem);
            margin-bottom: 3%;
            margin-left: 38%;
            width: clamp(4.5rem, 4.5vw, 4.5rem);
        }

    }

    /* //// */

    @media only screen and (max-height: 384px) and (min-height: 320px) {
        #logo {
            margin-top: clamp(9%, 9%, 9%);
            height: 76%;
            width: 25%;
        }

        #form {
            margin-bottom: 60%;
            padding-inline: min(10vh, 10vw);
            padding-top: 0%;
        }

        .input {
            padding-bottom: -15px;
            width: clamp(20rem, 20vw, 20vh);
        }

        #button {
            height: clamp(2rem, 2vw, 2rem);
            margin-bottom: 1%;
            margin-left: 38%;
            width: clamp(4.5rem, 4.5vw, 4.5rem);
        }

        #button_login {
            height: clamp(2rem, 2vw, 2rem);
            margin-bottom: 3%;
            margin-left: 38%;
            width: clamp(4.5rem, 4.5vw, 4.5rem);
        }
    }

    /* //// */

    @media only screen and (max-height: 319px) and (min-height: 260px) {
        #logo {
            margin-top: clamp(9%, 9%, 9%);
            height: 76%;
            width: 25%;
        }

        #form {
            margin-bottom: 60%;
            padding-inline: min(10vh, 10vw);
            padding-top: 0%;
        }

        .input {
            padding-bottom: -15px;
            width: clamp(15rem, 15vw, 15vh);
        }

        #button {
            height: clamp(1.5rem, 1.5vw, 1.5rem);
            margin-bottom: 1%;
            margin-left: 37%;
            width: clamp(4rem, 4vw, 4rem);
        }

        #button_login {
            height: clamp(1.5rem, 2vw, 2rem);
            margin-bottom: 8%;
            margin-left: 37%;
            width: clamp(4rem, 4vw, 4rem);
        }

    }

    /* //// */

    @media only screen and (max-height: 260px) {
        #logo {
            margin-top: clamp(20%, 20%, 20%);
            height: 70%;
            width: 35%;
        }

        #form {
            margin-bottom: 68%;
            padding-inline: min(10vh, 10vw);
            padding-top: 2%;
        }

        .input {
            padding-bottom: -15px;
            width: clamp(10rem, 10vw, 10vh);
        }

        #button {
            height: clamp(1.5rem, 1.5vw, 1.5rem);
            margin-bottom: 5%;
            margin-left: 28%;
            width: clamp(4.5rem, 4.5vw, 4.5rem);
        }

        #button_login {
            height: clamp(1.5rem, 1.5vw, 1.5rem);
            margin-bottom: 6%;
            margin-left: 28%;
            width: clamp(4.5rem, 4.5vw, 4.5rem);
        }
    }
</style>