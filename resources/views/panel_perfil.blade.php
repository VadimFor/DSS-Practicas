


<div class="container rounded bg-white mt-1 mb-1">

    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                <span class="font-weight-bold">{{auth()->user()->name}} {{auth()->user()->apellido}}</span>
                <span class="text-black-50">{{auth()->user()->email}}</span>
                <span> </span>
            </div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <form action="{{route("home.modperfil")}}" method="POST">
                    @csrf
                    <input name="email" value={{auth()->user()->email}} type="hidden">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Perfil</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">Nombre</label><input type="text" name="name" class="form-control"  value={{auth()->user()->name}}></div>
                        <div class="col-md-6"><label class="labels">Apellido</label><input type="text" class="form-control" name="apellido" value={{auth()->user()->apellido}} ></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Teléfono</label><input type="text" class="form-control" name="telefono" value={{auth()->user()->telefono}}></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Dirección</label><input type="text" class="form-control" name="direccion" value={{auth()->user()->direccion}}></div>
                        <div class="col-md-6"><label class="labels">Pais</label><input type="text" class="form-control" name="pais" value={{auth()->user()->pais}}></div>
                        <div class="col-md-6"><label class="labels">Provincia</label><input type="text" class="form-control" name="provincia" value={{auth()->user()->provincia}} ></div>
                        <div class="col-md-6"><label class="labels">Población</label><input type="text" class="form-control" name="poblacion" value={{auth()->user()->poblacion}} ></div>
                        <div class="col-md-6"><label class="labels">Código postal</label><input type="text" class="form-control" name="cod_postal" value={{auth()->user()->cod_postal}}></div>
                    </div>
                    <div class="mt-5 text-center">
                        <button class="btn btn-primary profile-button" type="submit">Guardar</button>
                    </div>
                    @if (session("correcto"))
                    <div class="aler alert-success text-center">{{session("correcto")}}</div>
                    @endif
                    @if (session("incorrecto"))
                    <div class="aler alert-danger text-center">{{session("incorrecto")}}</div>
                    @endif

                </form>
            </div>

        </div>

    </div>
</div>
