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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style_logged.css') }}">
    <link rel="icon" type="image/icon" sizes="64x64" href="{{ asset('favicon.ico') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('script.js') }}"></script>
</head>

<body>
    <video autoplay muted loop class="back_videos">
        <source src="{{ asset('vids/back_mobi.webm') }}" type="video/webm" />
    </video>
    <section role="application" id="grid_form">
        <img src="{{ asset('img/logo.webp') }}" type="image/webp" alt="Life Spy Logo" id="logo" draggable="false">
        <div id="grid_flex">
            <div id="div_form">
                <p class='msg'>You are logged in! Welcome, {{ $email }}!</p>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" id="button_logout">Logout</button>
                </form>
            </div>
        </div>
    </section>
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
5.1 button 
6. alerts
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
        margin-bottom: 100%;
        padding-inline: min(24vh, 24vw);
        padding-block: min(7vh, 7vw);
        text-align: center;
    }

    .msg {
        bottom: 100%;
        color: white;
        position: relative;
        text-align: center;
        width: 33ch;
    }

    /* -------------------------------------------- */

    /* 5.1 button */
    /* διαμόρφωση του κουμπιου logout*/

    #button_logout {
        background-color: white;
        border-radius: 5px;
        border: none;
        color: black;
        font-size: clamp(0.86rem, 1.11vw, 2rem);
        height: clamp(2rem, 2vw, 5rem);
        margin-bottom: 5%;
        margin-top: 8%;
        margin-inline: 39%;
        width: clamp(4rem, 4vw, 4rem);
    }

    #button_logout:hover,
    #button_logout:visited,
    #button_logout:focus,
    #button_logout:active {
        background-color: var(--active_color);
        text-decoration: none;
    }

    /* -------------------------------------------- */

    /* 6.media */

    @media only screen and (min-width: 1400px) {
        #button_logout {
            font-size: 16px;
            /*   height: clamp(1.5rem, 1.5vw, 5rem); */
            width: clamp(3rem, 4vw, 5rem);
        }
    }

    /* //// */

    @media only screen and (max-width: 500px) and (min-width: 430px) {
        #form {
            padding-inline: min(10vh, 10vw);
            margin-bottom: 50%;
        }

        .input {
            width: clamp(20rem, 20vw, 20vh);
        }


        #logo {
            width: clamp(15%, 35%, 45%);
            margin-top: clamp(15%, 30%, 30%);
            padding-bottom: 10%;
        }

    }

    /* //// */

    @media only screen and (max-width: 429px) and (min-width: 345px) {
        #form {
            margin-bottom: 70%;
            padding-inline: min(10vh, 10vw);
            padding-top: 3%;
        }

        .input {
            width: clamp(17rem, 17vw, 17vh);
        }
    }

    /* //// */

    @media only screen and (max-width: 344px) and (min-width: 345px) {
        #form {
            margin-bottom: 50%;
            padding-inline: min(10vh, 10vw);
            padding-top: 3%;
        }

        .input {
            width: clamp(16rem, 16vw, 16vh);
        }

    }

    /* //// */

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

        .msg {
            bottom: 35%;
        }

        #button {
            height: clamp(2rem, 2vw, 2rem);
            margin-left: 38%;
            width: clamp(4.5rem, 4.5vw, 4.5rem);
        }

        #button_logout {
            height: clamp(2rem, 2vw, 2rem);
            margin-bottom: 35%;
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

        .msg {
            bottom: 25%;
        }

        .input {
            padding-bottom: -15px;
            width: clamp(20rem, 20vw, 20vh);
        }

        #button_logout {
            height: clamp(2rem, 2vw, 2rem);
            margin-bottom: 45%;
            margin-left: 38%;
            width: clamp(4.5rem, 4.5vw, 4.5rem);
        }
    }

    /* //// */

    @media only screen and (max-height: 384px) and (min-height: 320px) {
        #logo {
            margin-top: clamp(9%, 9%, 9%);
            height: 80%;
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

        .msg {
            bottom: 30%;
        }

        #button {
            height: clamp(2rem, 2vw, 2rem);
            margin-bottom: 1%;
            margin-left: 38%;
            width: clamp(4.5rem, 4.5vw, 4.5rem);
        }

        #button_logout {
            height: clamp(2rem, 2vw, 2rem);
            margin-bottom: 30%;
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

        #button_logout {
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

        #button_logout {
            height: clamp(1.5rem, 1.5vw, 1.5rem);
            margin-bottom: 6%;
            margin-left: 28%;
            width: clamp(4.5rem, 4.5vw, 4.5rem);
        }
    }
</style>