$(document).ready((function(){let e=!1,t=$("#pass"),n=/[a-z]/,a=/[A-Z]/,r=/[0-9]/,s=/[α-ω]/,o=/[Α-Ω]/,i=/[ά-ώ]/,c=/[Ά-Ώ]/,d=/[!@#$%^&*(),.?":{}|<>]/;function u(t){var n;(n=t).removeClass("hide_warning"),n.addClass("show_warning"),e=!0,t.on("animationend",(function(){setTimeout((function(){t.addClass("hide_warning").removeClass("show_warning")}),4500)}))}setTimeout((function(){$("#cookie-info").fadeIn(2e3)}),2500),setTimeout((function(){$("#cookie-info").fadeOut(1e3)}),8e3),$("#button").click((async function(e){e.preventDefault();let l=t.val(),f=$("#email").val();if($(".warning-banner").hide(),f&&l)try{var w;await(w=f,new Promise(((e,t)=>{$.ajax({url:"/check-user",method:"POST",data:{email:w},headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},success:function(t){t.exists?e(!0):e(!1)},error:function(e,n,a){t(!1)}})})))?$.ajax({beforeSend:function(){$("#email").fadeOut(500),$("#pass").fadeOut(500),setTimeout((function(){$("#loader_div").fadeIn(1500)}),500)},url:"/login",method:"POST",data:{email:f,password:l,_token:$('meta[name="csrf-token"]').attr("content")},success:function(e){"error"===e.status?(u($("#warning_incorrect_password")),record_fail(f)):"success"===e.status?(localStorage.removeItem(`block_${f}`),window.location.href=e.redirect_url||"/logged"):(u($("#warning_incorrect_password")),record_fail(f))},error:function(e,t,n){u($("#warning_incorrect_password")),record_fail(f)}}):(n.test(l)||u($("#warning")),r.test(l)||u($("#warning2")),a.test(l)||u($("#warning3")),d.test(l)||u($("#warning4")),(s.test(l)||o.test(l)||i.test(l)||c.test(l))&&u($("#warning5")),a.test(l)&&r.test(l)&&n.test(l)&&d.test(l)&&!s.test(l)&&!o.test(l)&&!i.test(l)&&!c.test(l)&&$.ajax({url:"/signup",method:"POST",data:{email:f,password:l},headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},success:function(e){"success"===e.status?window.location.href=e.redirect_url||"/logged":u($("#warning_incorrect_password"))},error:function(){u($("#warning_incorrect_password"))}}))}catch(e){u($("#warning_incorrect_password"))}else alert("Please fill in both the email and password fields.")}))}));