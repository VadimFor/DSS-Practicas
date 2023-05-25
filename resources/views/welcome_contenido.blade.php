<style>

*{
 margin: 0px;
 padding: 0px;
}
body{
 font-family: arial;
}
.main{

 margin: 2%;
}

.card{
     width: 20%;
     display: inline-block;
     box-shadow: 2px 2px 20px black;
     border-radius: 5px; 
     margin: 2%;
    }

.image img{
  width: 100%;
  border-top-right-radius: 5px;
  border-top-left-radius: 5px;
 
 }

.title{
 
  text-align: center;
  padding: 10px;
  
 }

h1{
  font-size: 20px;
 }

.des{
  padding: 3px;
  text-align: center;
 
  padding-top: 10px;
        border-bottom-right-radius: 5px;
  border-bottom-left-radius: 5px;
}
button{
  margin-top: 40px;
  margin-bottom: 10px;
  background-color: white;
  border: 1px solid black;
  border-radius: 5px;
  padding:10px;
}
button:hover{
  background-color: black;
  color: white;
  transition: .5s;
  cursor: pointer;
}

.fa-star, .fa-star-half-alt{
        color: #ffbf00;
    }


.top1 {     
   width: 20%;
   box-shadow: 2px 2px 20px black;
   border-radius: 5px; 
   margin-top: 0%;
   margin: 2%;
   transition: all 0.5s ease-in-out;

}

.top1:hover {
 
   transition: all 0.5s ease-in-out;
   box-shadow: 0 0 10px #d4af37, 0 0 40px #d4af37, 0 0 80px #d4af37;
   transform: scale(1.1);
}

.top2 {
   width: 20%;
   box-shadow: 2px 2px 20px black;
   border-radius: 5px; 
   margin: 2%;
   transition: all 0.5s ease-in-out;

}
.top2:hover {

      transition: all 0.5s ease-in-out;
      box-shadow: 0 0 10px #838996,  0 0 40px  #838996, 0 0 80px #838996 ;
      transform: scale(1.1);

}
.top3 {
   width: 20%;
   box-shadow: 2px 2px 20px black;  
   border-radius: 5px; 
   margin: 2%;
   transition: all 0.5s ease-in-out;

}
.top3:hover {
 
   transition: all 0.5s ease-in-out;
   box-shadow: 0 0 10px #d99058, 0 0 40px #d99058, 0 0 80px #d99058;
   transform: scale(1.1);
}
.resto {
   width: 20%;
   box-shadow: 2px 2px 20px black;
   border-radius: 5px; 
   margin: 2%;
   transition: all 0.5s ease-in-out;

}

.resto:hover {
   transition: all 0.5s ease-in-out;
   transform: scale(1.05);
}



</style>



<div class="main card-deck">


   <div class="d-flex flex-row justify-content-evenly">
         <!--TOP2-->
         
         <div class="top2 mb-0">

            <div class="image">
               <img src="{{asset('storage/img/menu/'.$menus[0]->img)}}" width="240" height="240">         
            </div>

            <div class="title">
               <h1>{{$menus[0]->nombre}}</h1>
            </div>
            <ul class="list-inline text-center m-0">
               @for($i=0; $i < $menus[0]->promedio; $i++)
               <li class="list-inline-item"> <i class="fas fa-star"></i></li>
               @endfor
            </ul>

         
            <div class="des">
            <p>{{$menus[0]->descripcion}}</p>
            <a href="{{ url('/restaurante-detalle-' . $menus[0]->restaurante_id . '/') }}" class="btn btn-xs btn-info pull-right mb-2">Ir al restaurante</a>
            </div>
         </div>
         

         <!--TOP1-->
         
         <div class="top1 mt-0">
         
            <div class="image">
            <img src="{{asset('storage/img/menu/'.$menus[1]->img)}}" width="240" height="240"/>  
            </div>
            <div class="title">
               <h1>{{$menus[1]->nombre}}</h1>
              
            </div>
            <ul class="list-inline text-center m-0">
            @for($i=0; $i < $menus[1]->promedio; $i++)
               <li class="list-inline-item"> <i class="fas fa-star"></i></li>
            @endfor
            </ul>

         
            <div class="des">
            <p>{{$menus[1]->descripcion}}</p>
            <a href="{{ url('/restaurante-detalle-' . $menus[1]->restaurante_id . '/') }}" class="btn btn-xs btn-info pull-right">Ir al restaurante</a>
            </div>
         </div>
        
     

         <!--TOP3-->
         
         <div class="top3 mb-0">
         
            <div class="image">
            <img src="{{asset('storage/img/menu/'.$menus[2]->img)}}" width="240" height="240"/>  
            </div>
            <div class="title">
               <h1>{{$menus[2]->nombre}}</h1>
            </div>
            <ul class="list-inline text-center m-0">
            @for($i=0; $i < $menus[2]->promedio; $i++)
               <li class="list-inline-item"> <i class="fas fa-star"></i></li>
               @endfor
            </ul>

            <div class="des">
            <p>{{$menus[2]->descripcion}}</p>
            <a href="{{ url('/restaurante-detalle-' . $menus[2]->restaurante_id . '/') }}" class="btn btn-xs btn-info pull-right">Ir al restaurante</a>
         </div>
      
         </div>

   </div>
   <div class="d-flex flex-row flex-wrap">
  <!--RESTO-->
  @for ($i=3 ; $i < $menus_cont ; $i++)
      <div class="resto">
         
         <div class="image">
         <img src="{{asset('storage/img/menu/'.$menus[$i]->img)}}" width="240" height="240"/>  
         </div>
         <div class="title">
            <h1>{{$menus[$i]->nombre}}</h1>
         </div>
         <ul class="list-inline text-center m-0">
         @for($j=0; $j < $menus[$i]->promedio; $j++)
               <li class="list-inline-item"> <i class="fas fa-star"></i></li>
               @endfor
         </ul>
      
         <div class="des">
         <p>{{$menus[$i]->descripcion}}</p>
         <a href="{{ url('/restaurante-detalle-' . $menus[$i]->restaurante_id . '/') }}" class="btn btn-xs btn-info pull-right mb-2">Ir al restaurante</a>
         </div>
      </div>
   @endfor
   </div>

   </div>
