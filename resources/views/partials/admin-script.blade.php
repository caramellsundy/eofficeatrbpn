{{-- resources/views/partials/admin-script.blade.php --}}

{{-- ================================
    JQUERY
================================ --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

{{-- ================================
    BOOTSTRAP
================================ --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- ================================
    SELECT2
================================ --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- ================================
    SWEET ALERT
================================ --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

$(function(){

    /* ===================================
        SELECT2
    =================================== */

    $('.select2').select2({

        width:'100%',

        allowClear:true,

        placeholder:function(){

            return $(this).data('placeholder');

        }

    });


    /* ===================================
        TOOLTIP
    =================================== */

    $('[data-bs-toggle="tooltip"]').each(function(){

        new bootstrap.Tooltip(this);

    });

});



/* ===================================
    SIDEBAR MOBILE
=================================== */

const sidebar = document.querySelector('.sidebar');

const sidebarToggle = document.getElementById('sidebarToggle');

if(sidebarToggle){

    sidebarToggle.addEventListener('click',function(){

        sidebar.classList.toggle('show');

    });

}



/* ===================================
    TOGGLE SUB MENU
=================================== */

function toggleMenu(id){

    let menu = document.getElementById(id);

    if(menu){

        menu.classList.toggle('show');

    }

}



/* ===================================
    AUTO OPEN MENU
=================================== */

window.addEventListener('DOMContentLoaded',function(){

    const url = window.location.pathname;

    if(

        url.includes('/surat') ||

        url.includes('/disposisi')

    ){

        document
            .getElementById('persuratanMenu')
            ?.classList.add('show');

    }

    if(

        url.includes('/pegawai') ||

        url.includes('/jabatan') ||

        url.includes('/unitkerja')

    ){

        document
            .getElementById('masterMenu')
            ?.classList.add('show');

    }

});



/* ===================================
    ACTIVE MENU
=================================== */

document.querySelectorAll(".sidebar a").forEach(function(link){

    if(link.href===window.location.href){

        link.classList.add("active");

    }

});



/* ===================================
    LOADING BUTTON
=================================== */

document.querySelectorAll("form").forEach(function(form){

    form.addEventListener("submit",function(){

        let btn=form.querySelector("button[type='submit']");

        if(btn){

            btn.disabled=true;

            btn.innerHTML=`
                <span class="spinner-border spinner-border-sm me-2"></span>
                Memproses...
            `;

        }

    });

});



/* ===================================
    SWEET ALERT SUCCESS
=================================== */

@if(session('success'))

Swal.fire({

    icon:'success',

    title:'Berhasil',

    text:'{{ session("success") }}',

    timer:2500,

    showConfirmButton:false

});

@endif



/* ===================================
    SWEET ALERT ERROR
=================================== */

@if(session('error'))

Swal.fire({

    icon:'error',

    title:'Terjadi Kesalahan',

    text:'{{ session("error") }}'

});

@endif



/* ===================================
    AUTO CLOSE ALERT
=================================== */

setTimeout(function(){

    let alert=document.querySelector('.alert');

    if(alert){

        alert.remove();

    }

},4000);



/* ===================================
    KONFIRMASI DELETE
=================================== */

document.querySelectorAll('.btn-delete').forEach(function(btn){

    btn.addEventListener('click',function(e){

        e.preventDefault();

        let form=this.closest('form');

        Swal.fire({

            title:'Hapus Data?',

            text:'Data yang dihapus tidak dapat dikembalikan.',

            icon:'warning',

            showCancelButton:true,

            confirmButtonColor:'#0d6efd',

            cancelButtonColor:'#dc3545',

            confirmButtonText:'Ya, Hapus',

            cancelButtonText:'Batal'

        }).then((result)=>{

            if(result.isConfirmed){

                form.submit();

            }

        });

    });

});



/* ===================================
    RESPONSIVE
=================================== */

document.addEventListener('click',function(e){

    if(window.innerWidth>991){

        return;

    }

    if(

        sidebar.classList.contains('show') &&

        !sidebar.contains(e.target) &&

        !sidebarToggle.contains(e.target)

    ){

        sidebar.classList.remove('show');

    }

});



/* ===================================
    SCROLL TOP
=================================== */

window.addEventListener('scroll',function(){

    if(window.scrollY>100){

        document.body.classList.add('scrolled');

    }else{

        document.body.classList.remove('scrolled');

    }

});

</script>

{{-- Tambahan script dari halaman --}}
@stack('scripts')