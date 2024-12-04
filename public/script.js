$(document).ready(function () {
    let timer = 5500;
    let error = false;

    const pass = $("#pass"); // Grabbing the password input element

    // Define regex for password requirements
    const letter = /[a-z]/;
    const upper = /[A-Z]/;
    const number = /[0-9]/;
    const greekLow = /[α-ω]/;
    const greekUpper = /[Α-Ω]/;
    const greekLowTone = /[ά-ώ]/;
    const greekUpperTone = /[Ά-Ώ]/;
    const symbols = /[!@#$%^&*(),.?":{}|<>]/;

    // Function to show or hide the warning animations
    function showWarning(warningElement) {
        add_animation(warningElement, "hide_warning", "show_warning");
        error = true;
        warningElement.on("animationend", function () {
            setTimeout(function () {
                warningElement.addClass("hide_warning").removeClass("show_warning");
            }, timer);
        });
    }

    $("#button").click(function (event) {
        error = false; // Reset error flag each time the button is clicked

        const passValue = pass.val(); // Get the password value when the button is clicked

        // Password rules checks
        if (!letter.test(passValue) && !greekLow.test(passValue) && !greekUpper.test(passValue) && !greekLowTone.test(passValue) && !greekUpperTone.test(passValue)) {
            showWarning($("#warning"));
        }
        if (!number.test(passValue) && !greekLow.test(passValue) && !greekUpper.test(passValue) && !greekLowTone.test(passValue) && !greekUpperTone.test(passValue)) {
            showWarning($("#warning2"));
        }
        if (!upper.test(passValue) && !greekLow.test(passValue) && !greekUpper.test(passValue) && !greekLowTone.test(passValue) && !greekUpperTone.test(passValue)) {
            showWarning($("#warning3"));
        }
        if (!symbols.test(passValue) && !greekLow.test(passValue) && !greekUpper.test(passValue) && !greekLowTone.test(passValue) && !greekUpperTone.test(passValue)) {
            showWarning($("#warning4"));
        }
        if (greekLow.test(passValue) || greekUpper.test(passValue) || greekLowTone.test(passValue) || greekUpperTone.test(passValue)) {
            showWarning($("#warning5"));
        }

        // If all password conditions are satisfied
        if (upper.test(passValue) && number.test(passValue) && letter.test(passValue) && symbols.test(passValue) &&
            !greekLow.test(passValue) && !greekUpper.test(passValue) && !greekLowTone.test(passValue) && !greekUpperTone.test(passValue)) {
            error = false;
        }

        // Prevent form submission if errors are found
        if (error) {
            event.preventDefault();
            $("#button").attr('name', '');
        } else {
            $("#button").attr('name', 'signup');
        }
    });

    // Function to add or remove animations
    function add_animation(item, string_remove, string_add) {
        item.removeClass(string_remove);
        item.addClass(string_add);
    }
});
