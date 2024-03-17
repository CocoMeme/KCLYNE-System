@extends('Layouts/header')
@extends('Layouts/footer')

<body>
    


    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <section class="main-home">
        <div class="main-text">
            <h5 style="font-size: 20px">KCLYNE</h5>
            <h1 style="color: rgb(74, 83, 118)">LIQUI MOLY<br></h1>
            <h1>SHOPPING 2024</h1>
            <p>New Collections Featured</p>

            <a href="/" class="main-btn">Shop Now! <i class='bx bxs-chevron-right'></i></a>
        </div>
    </section>

    <section class="search-products">
        
    </section>

</body>