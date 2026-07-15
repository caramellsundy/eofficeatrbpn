document.addEventListener("DOMContentLoaded", function () {

    /* ==========================================================
       SIDEBAR TOGGLE
    ========================================================== */

    const sidebar = document.getElementById("sidebar");
    const toggle = document.getElementById("toggleSidebar");

    if (toggle) {

        toggle.addEventListener("click", function () {

            sidebar.classList.toggle("collapsed");

            document.body.classList.toggle("sidebar-collapse");

        });

    }

    /* ==========================================================
       ACTIVE MENU
    ========================================================== */

    const current = window.location.href;

    document.querySelectorAll(".sidebar-menu a").forEach(function (link) {

        if (link.href === current) {

            link.classList.add("active");

        }

    });

    /* ==========================================================
       AUTO CLOSE ALERT
    ========================================================== */

    document.querySelectorAll(".alert").forEach(function (alert) {

        setTimeout(function () {

            const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);

            bsAlert.close();

        }, 4000);

    });

    /* ==========================================================
       MOBILE SIDEBAR
    ========================================================== */

    if (window.innerWidth < 992) {

        sidebar.classList.remove("collapsed");

    }

    window.addEventListener("resize", function () {

        if (window.innerWidth > 992) {

            sidebar.classList.remove("show");

        }

    });

});