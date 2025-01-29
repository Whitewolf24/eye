$(document).ready(function () {
    let t = !1,
        e = $("#pass"),
     n = /[a-z]/,
        a = /[A-Z]/,
        r = /[0-9]/,
        s = /[α-ω]/,
        o = /[Α-Ω]/,
        i = /[ά-ώ]/,
        c = /[Ά-Ώ]/,
        d = /[!@#$%^&*(),.?":{}|<>]/;


        setTimeout(function () {
            $("#cookie-info").fadeIn(2000);
        }, 2500);


        setTimeout(function () {
            $("#cookie-info").fadeOut(1000);
        }, 8000);

    function l(e) {
        var n,
            a = "hide_warning",
            r = "show_warning";
        (n = e).removeClass(a),
            n.addClass(r),
            (t = !0),
            e.on("animationend", function () {
                setTimeout(function () {
                    e.addClass("hide_warning").removeClass("show_warning");
                }, 4500);
            });
    }
    $("#button").click(async function (t) {
        t.preventDefault();
        let u = e.val(),
            w = $("#email").val();
        if (($(".warning-banner").hide(), !w || !u)) {
            alert("Please fill in both the email and password fields.");
            return;
        }
        try {
            var g;
            (await ((g = w),
            new Promise((t, e) => {
                $.ajax({
                    url: "/check-user",
                    method: "POST",
                    data: { email: g },
                    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                    success: function (e) {
                        e.exists ? t(!0) : t(!1);
                    },
                    error: function (t, n, a) {
                        e(!1);
                    },
                });
            })))
                ?
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
                      data: { email: w, password: u, _token: $('meta[name="csrf-token"]').attr("content") },
                      success: function (t) {
                          "error" === t.status
                              ? (l($("#warning_incorrect_password")), record_fail(w))
                              : "success" === t.status
                              ? (localStorage.removeItem(`block_${w}`), (window.location.href = t.redirect_url || "/logged"))
                              : (l($("#warning_incorrect_password")), record_fail(w));
                      },
                      error: function (t, e, n) {
                          l($("#warning_incorrect_password")), record_fail(w);
                      },
                  })
                : (n.test(u) || l($("#warning")),
                  r.test(u) || l($("#warning2")),
                  a.test(u) || l($("#warning3")),
                  d.test(u) || l($("#warning4")),
                  (s.test(u) || o.test(u) || i.test(u) || c.test(u)) && l($("#warning5")),
                  a.test(u) &&
                      r.test(u) &&
                      n.test(u) &&
                      d.test(u) &&
                      !s.test(u) &&
                      !o.test(u) &&
                      !i.test(u) &&
                      !c.test(u) &&
                      $.ajax({
                          url: "/signup",
                          method: "POST",
                          data: { email: w, password: u },
                          headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                          success: function (t) {
                              "success" === t.status ? (window.location.href = t.redirect_url || "/logged") : l($("#warning_incorrect_password"));
                          },
                          error: function () {
                              l($("#warning_incorrect_password"));
                          },
                      }));
        } catch (f) {
            l($("#warning_incorrect_password"));
        }
    });
});
