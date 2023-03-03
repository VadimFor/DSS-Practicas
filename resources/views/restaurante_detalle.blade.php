<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
</head>
<body>
    <div class="header">
        <h1>@yield('header_title','RESTAURANTE')</h1>
        <h2>@yield('header_subtitle','FINE DINING EXPERIENCE')</h2>
    </div>
    <div class="image-grid">
        <h3>@yield('grid_title','MENU')</h3>
        <div class="images">
            @yield('image_grid')
            <div class="row">
                <div class="col-md-4">
                    <img src="image1.jpg">
                    <h4>Dish 1</h4>
                    <p>Description of dish 1</p>
                </div>
                <div class="col-md-4">
                    <img src="image2.jpg">
                    <h4>Dish 2</h4>
                    <p>Description of dish 2</p>
                </div>
                <div class="col-md-4">
                    <img src="image3.jpg">
                    <h4>Dish 3</h4>
                    <p>Description of dish 3</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
