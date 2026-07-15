/*
|--------------------------------------------------------------------------
| Dashboard Umum
| E-Office ATR/BPN
|--------------------------------------------------------------------------
*/

document.addEventListener("DOMContentLoaded", function () {

    /* ==========================================================
       Tooltip Bootstrap
    ========================================================== */

    const tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );

    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });


    /* ==========================================================
       Animasi Card
    ========================================================== */

    const cards = document.querySelectorAll(".card");

    cards.forEach(function(card, index){

        card.style.opacity = 0;
        card.style.transform = "translateY(20px)";

        setTimeout(function(){

            card.style.transition = "all .45s ease";
            card.style.opacity = 1;
            card.style.transform = "translateY(0)";

        }, index * 100);

    });


    /* ==========================================================
       Hover Card
    ========================================================== */

    document.querySelectorAll(".feature-card").forEach(function(card){

        card.addEventListener("mouseenter", function(){

            this.style.transform = "translateY(-8px)";

        });

        card.addEventListener("mouseleave", function(){

            this.style.transform = "translateY(0px)";

        });

    });


    /* ==========================================================
       Counter Statistik
    ========================================================== */

    document.querySelectorAll(".counter").forEach(function(counter){

        let target = parseInt(counter.innerText);

        if(isNaN(target)) return;

        let number = 0;

        let speed = Math.max(1, Math.ceil(target / 40));

        counter.innerText = 0;

        let interval = setInterval(function(){

            number += speed;

            if(number >= target){

                counter.innerText = target;

                clearInterval(interval);

            }else{

                counter.innerText = number;

            }

        },25);

    });


    /* ==========================================================
       Highlight Table
    ========================================================== */

    document.querySelectorAll("tbody tr").forEach(function(row){

        row.addEventListener("mouseenter",function(){

            this.style.background="#f8fbff";

        });

        row.addEventListener("mouseleave",function(){

            this.style.background="";

        });

    });


    /* ==========================================================
       Tombol Scroll Atas
    ========================================================== */

    const scrollBtn = document.createElement("button");

    scrollBtn.innerHTML = '<i class="bi bi-arrow-up"></i>';

    scrollBtn.className = "btn btn-primary";

    scrollBtn.id = "scrollTopBtn";

    scrollBtn.style.position = "fixed";
    scrollBtn.style.bottom = "25px";
    scrollBtn.style.right = "25px";
    scrollBtn.style.display = "none";
    scrollBtn.style.borderRadius = "50%";
    scrollBtn.style.width = "50px";
    scrollBtn.style.height = "50px";
    scrollBtn.style.zIndex = "9999";

    document.body.appendChild(scrollBtn);


    window.addEventListener("scroll",function(){

        if(window.scrollY > 300){

            scrollBtn.style.display = "block";

        }else{

            scrollBtn.style.display = "none";

        }

    });


    scrollBtn.addEventListener("click",function(){

        window.scrollTo({

            top:0,

            behavior:"smooth"

        });

    });


    /* ==========================================================
       Jam Digital
    ========================================================== */

    const clock = document.getElementById("clock");

    if(clock){

        setInterval(function(){

            const now = new Date();

            clock.innerHTML = now.toLocaleTimeString("id-ID");

        },1000);

    }


    /* ==========================================================
       Notifikasi
    ========================================================== */

    const alertBox = document.querySelector(".alert");

    if(alertBox){

        setTimeout(function(){

            alertBox.classList.add("fade");

            setTimeout(function(){

                alertBox.remove();

            },500);

        },5000);

    }

});