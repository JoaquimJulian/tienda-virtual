@extends('layouts.app') <!-- Aquí extiendes tu layout principal -->

@section('title', 'Sobre nosotros') <!-- Aquí defines un título específico para esta página -->

@section('content')
    <div class="bg-beigclaro sm:flex sm:h-auto">
        <div class="text-marron p-6 sm:p-16 sm:w-2/3">
            <p>En Tempo & Tono, nuestra pasión es la música, y nuestra misión es llevar esa pasión a cada rincón. Desde instrumentos hasta accesorios, ofrecemos una amplia variedad de artículos para músicos de todos los niveles y estilos.</p>
            <p class="text-2xl font-bold mt-6">¿Quiénes somos?</p>
            <p class="mt-1">Somos un equipo de amantes de la música que entiende lo que significa encontrar el sonido perfecto. Fundada con la idea de ser un punto de encuentro para músicos y melómanos, Tempo & Tono nació con el propósito de ofrecer productos de alta calidad que inspiren creatividad y pasión por la música.</p>
            <p class="text-2xl font-bold mt-6">Nuestra filosofía</p>
            <p class="mt-1">Nos guiamos por tres principios:</p>
            <ol class="mt-1">
                <li>Calidad: Trabajamos con marcas reconocidas y productos probados para asegurar que cada músico encuentre lo mejor.</li>
                <li>Accesibilidad: Creemos que la música debe estar al alcance de todos. Por eso, nos esforzamos por ofrecer precios justos y promociones especiales.</li>
                <li>Comunicación: Queremos ser más que una tienda. Nos importa escuchar y ayudar a nuestros clientes en cada paso de su camino musical.</li>
            </ol>
            <p class="text-2xl font-bold mt-6">Nuestra comunidad</p>
            <p class="mt-1">Tempo & Tono no solo es una tienda; es un lugar donde los músicos pueden compartir sus experiencias, aprender unos de otros y crecer. Síguenos en nuestras redes sociales para conocer nuestras novedades, talleres, y eventos musicales. 🎤
            🎯 ¡Únete a nuestra familia musical y encuentra tu propio ritmo en Tempo & Tono!</p>
        </div>
        <div class="w-full flex justify-center mt-6 pb-10 sm:w-1/2">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1882.9685622795814!2d2.4017099765643866!3d41.50750887943833!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sca!2ses!4v1740473130456!5m2!1sca!2ses" 
                class="w-4/5 h-64 sm:w-2/3 sm:h-auto" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>        
@endsection