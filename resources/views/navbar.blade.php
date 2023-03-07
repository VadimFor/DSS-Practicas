
<style>

    *{
        margin:0;
        padding: 0;
        box-sizing: border-box;
    }

    .bg{
        background-color: whitesmoke;
    }

    .navbar{
        padding: 0;
    }

    .navbar-toogler:focus{
        box-shadow: none;
    }

    .ul-bg{
        back
    }

     .navbar .navbar-collapse {
    text-align: center;
    }


</style>


<nav class="navbar navbar-expand-md bg" >
    <a href="" class="navbar-brand fs-3 ms-3 fw-bold  text-success bx bx-bowl-hot" style="">FudRater</a>


    <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#btn">
        <i class='bx bx-menu'></i>
    </button>

   <div class="collapse navbar-collapse ul-bg" id="btn">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a href="#" class="bx bxs-home nav-link mx-3 text-dark fs-5">Home</a>
            </li>
            <li class="nav-item">
                <a href="#" class="bx bx-folder-plus nav-link mx-3 text-dark fs-5">About</a>
            </li>
            <li class="nav-item">
                <a href="#" class="bx bx-folder-plus bx bxs-user-voice nav-link mx-3 text-dark fs-5">Service</a>
            </li>
            <li class="nav-item">
                <a href="#" class="bx bxs-contact nav-link mx-3 text-dark fs-5">Our team</a>
            </li>
            <li class="nav-item">

                @guest
                <a href="/login" class="btn btn-dark" id="myprofile" name="myprofile">Login</a>
                <a href="/registro" class="btn btn-dark" id="myprofile" name="myprofile">Registro</a>
                @endguest

                  
                @auth
                <a href="/panelusuario/perfil" class="btn btn-dark" ><i class='bx bxs-user'></i> {{auth()->user()->email}}</a>
                <a href="/logout" class="btn btn-dark" ><i class='bx bx-log-out'></i> Logout</a>
                @endauth

            </li>
            &nbsp;&nbsp;&nbsp;

        </ul>
    </div>
</nav>
