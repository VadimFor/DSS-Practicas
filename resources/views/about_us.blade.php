
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <title>Home</title>

    </head>

    <style>

.v1 {
    font-size: 26px;
    font-family: sans-serif;
}

.img{
  height: 150px !important;
  width: 200px !important;

}

   a{
    font-size: 25px;
   }
    </style>


    <body>
        @include('navbar')

        <!-- Muestra mensaje de error durante 30 seg en el caso de que se haga click en el botón de restaurantes y no haya restaurantes -->
        @if (session('error-message'))
            <div class="alert alert-danger">
                <ul>                
                    <li>{{ session('error-message') }}</li>
                </ul>
            </div>
        @endif

        <div class="container mt-5 mb-5">
          <div class="row">
            <div class="col-md-6 offset-md-3">
              <h2>Sobre nosotros</h2>
              <ul class="timeline" style="font-size:20px">

                <li>
                  <a  href="#">Nuestra Historia</a>
                  <p>Fundado en 2023, Fudrater nació con la visión de conectar a los amantes de la comida con los mejores restaurantes, menús y platos de la ciudad. Nuestro fundador, un apasionado de la gastronomía, se dio cuenta de la necesidad de tener una plataforma donde los usuarios pudieran explorar y descubrir las joyas culinarias de su localidad.</p>
                </li>

                <li>
                  <a  href="#">Nuestra Misión</a>
                  <p>Creemos en la magia de la buena comida y cómo puede unir a las personas. En Fudrater, nos esforzamos por ser la plataforma de referencia para los entusiastas de la comida, ofreciendo reseñas auténticas, menús actualizados y la posibilidad de descubrir nuevos sabores. Nuestra misión es simple: facilitar el encuentro entre los amantes de la comida y los restaurantes que crean experiencias culinarias inolvidables.</p>

                <li>
                  <a  href="#">Nuestro Equipo</a>
                  <p>Nuestro equipo está compuesto por profesionales apasionados de la industria gastronómica. Desde críticos culinarios experimentados, hasta diseñadores web y fotógrafos, todos compartimos una pasión común: la comida. Trabajamos en conjunto para proporcionarte las reseñas más precisas y atractivas, imágenes de los platos y menús que te hagan salivar, y la información más actualizada sobre los restaurantes que te interesa visitar.</p>
                </li>

                <li>
                  <a  href="#">Nuestros Valores</a>
                  <p>En Fudrater, valoramos la autenticidad, la integridad y la pasión por la comida. Nos comprometemos a proporcionar contenido honesto y transparente, siempre respetando a los restaurantes y a nuestros usuarios. Creemos en fomentar una comunidad de amantes de la comida que apoye a los restaurantes locales y celebre la diversidad de la gastronomía.</p>
                </li>

                <li>
                  <a  href="#">Contáctanos</a>
                  <p>Nos encantaría escuchar tus sugerencias, comentarios o preguntas. Si eres un restaurante que quisiera unirse a nuestra plataforma, o simplemente un amante de la comida buscando recomendaciones, no dudes en ponerte en contacto con nosotros a través de [correo electrónico] o [número de teléfono].</p>
                </li>

              </ul>
            </div>
          </div>
        </div>
        
        <div class="text-muted mt-5 mb-5 text-center small">by : <a class="text-muted" target="_blank" href="http://127.0.0.1:8000/">FudRater.com</a></div>






        @include('footer')
        <script src="{{ url('/assets/js/bootstrap.bundle.min.js')}}"></script>

    </body>


</html>



