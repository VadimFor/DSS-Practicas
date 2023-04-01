
<style>
.iconos {
  display: inline-block;
  width: 70px;
  height: 70px;
  border-radius: 50%;
  background-size:75% 75%;
  background-position: center;
  background-repeat: no-repeat;
  background-clip: padding-box;
  text-align:center;
  background-position-x: center;
  background-position-y: center;
  
}
.icon-cuchillotenedor{background-image: url('/icons/icon-fork.svg');}
.icon-menu{background-image: url('/icons/icon-menu.svg');}
.icon-pizza{background-image: url('/icons/icon-pizza.svg');}
.icon-users{background-image: url('/icons/icon-users.svg');}
.icon-comentarios{background-image: url('/icons/icon-comentarios.svg');}
</style>



<div class="p-5 table-responsive">

    <div class="row g-3 my-2">
        <div class="col-md-3" style="text-align:center;">
            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div>
                    <h3 class="fs-2">{{$restaurante_cont}}</h3>
                    <p class="fs-5">Restaurantes</p>
                </div>
                <div class="primary-text secondary-bg iconos icon-cuchillotenedor" ></div>
            </div>
        </div>
    
        <div class="col-md-3" style="text-align:center;">
            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div>
                    <h3 class="fs-2">{{$menu_cont}}</h3>
                    <p class="fs-5">Menus</p>
                </div>
                <div class="primary-text secondary-bg iconos icon-menu" ></div>
            </div>
        </div>
    
        <div class="col-md-3" style="text-align:center;">
            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div>
                    <h3 class="fs-2">{{$plato_cont}}</h3>
                    <p class="fs-5">Platos</p>
                </div>
                <div class="primary-text secondary-bg iconos icon-pizza" ></div>
            </div>
        </div>
    
        <div class="col-md-3" style="text-align:center;">
            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div>
                    <h3 class="fs-2">{{$users_cont}}</h3>
                    <p class="fs-5">Usuarios</p>
                </div>
                <div class="primary-text secondary-bg iconos icon-users" ></div>
            </div>
        </div>

        <div class="col-md-3" style="text-align:center;">
            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div>
                    <h3 class="fs-2">{{$valoracion_cont}}</h3>
                    <p class="fs-5">Valoraciones</p>
                </div>
                <div class="primary-text secondary-bg iconos icon-comentarios" ></div>
            </div>
        </div>
    </div>
</div> 