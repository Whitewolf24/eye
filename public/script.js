$(document).ready(function () {
    let e = false,
        t = $("#pass"),
        n = /[a-z]/,
        a = /[A-Z]/,
        r = /[0-9]/,
        s = /[α-ω]/,
        o = /[Α-Ω]/,
        i = /[ά-ώ]/,
        c = /[Ά-Ώ]/,
        d = /[!@#$%^&*(),.?":{}|<>]/;

    function u(t) {
        t.removeClass("hide_warning").addClass("show_warning");
        e = true;
        t.on("animationend", function () {
            setTimeout(function () {
                t.addClass("hide_warning").removeClass("show_warning");
            }, 4500);
        });
    }

    $(window).on("load", function () {
        setTimeout(function () {
            $("#cookie_info").css({
                "opacity": 1,
                "transition": "opacity 2s ease-in-out"
            });
            $("#creator").fadeIn(2000);
        }, 2500);
    });

    setTimeout(function () {
        $("#cookie_info").css({
            "opacity": 0,
            "transition": "opacity 2s ease-in-out"
        });
    }, 8000);

    $("#button").click(async function (e) {
        e.preventDefault();
        let l = t.val(),
            f = $("#email").val();

        $(".warning-banner").hide();

        if (f && l) {
            try {
                let exists = await check_user(f);
                if (exists) {
                    login_user(f, l);
                } else {
                    signup_user(f, l);
                }
            } catch (error) {
                console.error("Error during user check:", error);
                u($("#warning_incorrect_password"));
            }
        } else {
            alert("Please fill in both the email and password fields.");
        }
    });

    async function check_user(email) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: "/check-user",
                method: "POST",
                data: {
                    email: email
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    if (response.exists) {
                        resolve(true); // User exists
                    } else {
                        resolve(false); // User does not exist
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error: " + error);
                    reject(false);
                }
            });
        });
    }

    function login_user(email, password) {
        $.ajax({
            beforeSend: function () {
                $("#email").fadeOut(500);
                $("#pass").fadeOut(500);
                setTimeout(function () {
                    $("#loader_div").fadeIn(1500);
                }, 500);
            },
            url: "/login",
            method: "POST",
            data: {
                email: email,
                password: password,
                _token: $('meta[name="csrf-token"]').attr("content")
            },
            success: function (response) {
                console.log('Login response:', response);
                if (response.status === "error") {
                    u($("#warning_incorrect_password"));
                } else if (response.status === "success") {
                    window.location.href = response.redirect_url || "/logged";
                }
            },
            error: function (xhr, status, error) {
                console.error('Login failed:', status, error);
                u($("#warning_incorrect_password"));
            }
        });
    }

    function signup_user(email, password) {
        $.ajax({
            url: "/signup",
            method: "POST",
            data: {
                email: email,
                password: password,
                _token: $('meta[name="csrf-token"]').attr("content")
            },
            success: function (response) {
                if (response.status === "success") {
                    window.location.href = response.redirect_url || "/logged";
                } else {
                    u($("#warning_incorrect_password"));
                }
            },
            error: function () {
                u($("#warning_incorrect_password"));
            }
        });
    }
});