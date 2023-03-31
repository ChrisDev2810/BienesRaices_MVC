<main class="contenedor seccion">
        <h1>Mas sobre nosotros</h1>

        <div class="iconos-nosotros">

            <div class="icono">
            <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
            <h3>seguridad</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta commodi voluptatibus molestias sequi eum eos, qui ipsam corrupti 
            minus autem quas earum. Maxime, sed doloremque at deleniti quae ullam obcaecati!</p>
            </div>

            <div class="icono">
            <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
            <h3>precio</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta commodi voluptatibus molestias sequi eum eos, qui ipsam corrupti 
            minus autem quas earum. Maxime, sed doloremque at deleniti quae ullam obcaecati!</p>
            </div>

            <div class="icono">
            <img src="build/img/icono3.svg" alt="Icono a Tiempo" loading="lazy">
            <h3>a tiempo</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta commodi voluptatibus molestias sequi eum eos, qui ipsam corrupti 
            minus autem quas earum. Maxime, sed doloremque at deleniti quae ullam obcaecati!</p>
            </div>

        </div>
    </main>

    <section class="contenedor seccion">
        <h2>Casas y Departamentos En Venta</h2>

        <?php

        //$limite = 3; //Esta variable se comparte con el include de templates
        include 'listado.php';
        
        ?>

        <div class="alinear-derecha">
            <a class="boton-verde" href="/propiedades">Ver Todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra La Casa De Tus Sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondra en contcato contigo a la brevedad</p>
        <a class="boton-amarillo-inline" href="/contacto">Contactanos</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section>
            <h3>Nuestro Blog</h3>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="/entrada">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="informacion-meta">Escrito en: <span>02/01/2023</span> por: <span>Admin</span></p>
                        <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero</p>
                    </a>
                </div>
            </article>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="/entrada">
                        <h4>Guia para la decoracion de tu hogar</h4>
                        <p class="informacion-meta">Escrito en: <span>02/01/2023</span> por: <span>Admin</span></p>
                        <p>Maximiza el espacio en tu hogar con esa guia, aprende a combinar muebles y colores para darle vida a tu espacio</p>
                    </a>
                </div>
            </article>

        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>

            <div class="testimonial">
                <blockquote>
                    El personal se comporto de una excelente manera y la casa que me ofrecieron cumple todas mis expectativas
                </blockquote>
                <p>- Christopher Diaz -</p>
            </div>
        </section>
    </div>