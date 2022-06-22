 <!-- ======= Home Section ======= -->

 <section id="home" class=" hero d-flex align-items-center">
   <div class="container-fluid">
     <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
       <div class="carousel-indicators">
         <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
         <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
         <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
       </div>
       <div class="carousel-inner">
         <div class="carousel-item active">
           <img src="<?= base_url('assets/website/img/school.jpg') ?>" class="d-block w-100">
         </div>
         <div class="carousel-item">
           <img src="<?= base_url('assets/website/img/oncafe.jpg') ?>" class="d-block w-100">
         </div>
         <div class="carousel-item">
           <img src="<?= base_url('assets/website/img/event.jpg') ?>" class="d-block w-100">
         </div>
       </div>
       <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
         <span class="carousel-control-prev-icon" aria-hidden="true"></span>
         <span class="visually-hidden">Previous</span>
       </button>
       <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
         <span class="carousel-control-next-icon" aria-hidden="true"></span>
         <span class="visually-hidden">Next</span>
       </button>
     </div>
   </div>
 </section>
 <!-- End Home Section -->

 <main id="main">

   <section id="event" class="event">
     <div class="container" data-aos="fade-up">
       <header class="section-header">
         <h2>New Event</h2>
         <!-- <p>Event Tech</p> -->
         <p>Event terbaru akan muncul disini</p>
       </header>

       <div class="row">
         <?php
          foreach ($newevent as $new) :
          ?>

           <div class="col-lg-4 eventpost">
             <a href="<?= base_url('website/detail_event/' . $new['event_id']) ?>">
               <div class="post-box">
                 <div class="post-img"><img src="<?= base_url('assets/images/event/thumbs' . $new['thumbs']) ?>" class="img-fluid" alt=""></div>
                 <h3 class="post-title"><?= $new['judul'] ?></h3>
                 <span class="post-date"><i class="fas fa-calendar-alt"></i> <?php $tgl = $new['tgl_event'];
                                                                              echo format_indo($tgl); ?></span>
               </div>
             </a>
           </div>
         <?php endforeach; ?>



       </div>
     </div>


     </div>


     </div>

   </section>
   <!-- ======= Features Section ======= -->
   <section id="features" class="features ">
     <div class="container" data-aos="fade-up">
       <!-- <div class="row "> -->
       <header class="section-header">
         <h2>Apa saja penawaran untuk user kami?</h2>
         <!-- <p>Event Tech</p> -->
         <p>Kami menawarkan layanan - layanan yang kami miliki kepada anda yang ingin
           bekerja sama dengan kami mengenai event yang anda buat. Layanan yang kami berikan dapat menunjang anda
           dalam
           pelaksanaan event yang akan anda laksanakan.</p>
       </header>
       <!-- Feature Icons -->
       <div class="feature-icons">
         <div class="row" data-aos="fade-up">


           <div class="col-xl-4 text-center" data-aos="fade-right" data-aos-delay="100">
             <img src="<?= base_url('assets/website') ?>/img/features-3.png" class="img-fluid p-4" alt="">
           </div>

           <div class="col-xl-8 d-flex content">
             <div class="row align-self-center gy-4">

               <div class="col-md-6 icon-box" data-aos="fade-up">
                 <i class=" ri-computer-line"></i>
                 <div>
                   <h4>Promo Sosial Media</h4>
                   <p>Kami akan melakukan promosi menggunakan social media yang tersedia di internet.
                     Dengan cara yang memiliki event melakukan share posternya kepada kami. Social Media yang kami
                     gunakan adalah Instagram, Twitter, Facebook, dan Telegram</p>
                 </div>
               </div>

               <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                 <i class="ri-live-line"></i>
                 <div>
                   <h4>Live Streaming</h4>
                   <p>Layanan live streaming untuk event - event yang ingin di tayangkan secara live melalui media
                     youtube.
                     Kami yang akan mengoperasikan untuk melakukan live.</p>
                 </div>
               </div>

               <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                 <i class="ri-coupon-4-line"></i>
                 <div>
                   <h4>Tiket</h4>
                   <p>Bagi yang ingin mengikuti seminar dapat mealakukan pembelian tiket pada website event technology
                     information
                     dengan mudah dan dapat mengunduh sertifikat seminar, webinar, maupun lomba yang diikuti oleh
                     peserta yang mendaftar</p>
                 </div>
               </div>

               <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                 <i class=" ri-parent-line"></i>
                 <div>
                   <h4>Platform</h4>
                   <p>Penyedia jasa zoom yang bisa dilakukan sewa untuk event - event yang akan dilakukan oleh para
                     penyedia event seperti
                     kampus, komunitas, maupun umum.</p>
                 </div>
               </div>

             </div>
           </div>

         </div>
       </div>

     </div><!-- End Feature Icons -->

     <!-- </div> -->

   </section><!-- End Features Section -->

   <!-- ======= Event Section ======= -->
   <section id="event" class="portfolio event">

     <div class="container" data-aos="fade-up">

       <header class="section-header">
         <h2>Cari event yang ingin anda ikuti</h2>
         <p>Event - event technology yang dapat anda ikuti sesuai dengan keinginan maupun minat anda. Anda dapat
           memilihnya dan melakukan pemesanan tiket untuk event yang ingin anda ikuti.</p>
       </header>

       <div class="row" data-aos="fade-up" data-aos-delay="100">
         <div class="col-lg-12 d-flex justify-content-center">
           <ul id="portfolio-flters">
             <li data-filter="*" class="filter-active">All</li>
             <li data-filter=".filter-lomba">Lomba </li>
             <li data-filter=".filter-webinar">Webinar</li>
             <li data-filter=".filter-workshop">Workshop</li>
             <!-- <li data-filter="">Lainnya</li> -->
           </ul>
         </div>
       </div>

       <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">
         <?php foreach ($workshop as $f) : ?>
           <div class="col-lg-3 col-md-6 portfolio-item filter-workshop">
             <a href="<?= base_url('website/detail_event/' . $f['event_id']) ?>">
               <div class="post-box">
                 <div class="post-img"><img src="<?= base_url('assets/images/event/thumbs' . $f['thumbs']) ?>" class="img-fluid" alt=""></div>
                 <h3 class="post-title"><?= $f['judul'] ?></h3>
                 <span class="post-date"><i class="fas fa-calendar-alt"></i> <?php $tgl = $f['tgl_event'];
                                                                              echo format_indo($tgl); ?></span>

               </div>
             </a>
           </div>
         <?php endforeach; ?>

         <?php foreach ($webinar as $w) : ?>
           <div class="col-lg-3 col-md-6 portfolio-item filter-webinar">
             <a href="<?= base_url('website/detail_event/' . $w['event_id']) ?>">
               <div class="post-box">
                 <div class="post-img"><img src="<?= base_url('assets/images/event/thumbs' . $w['thumbs']) ?>" class="img-fluid" alt=""></div>
                 <h3 class="post-title"><?= $w['judul'] ?></h3>
                 <span class="post-date"><i class="fas fa-calendar-alt"></i> <?php $tgl = $w['tgl_event'];
                                                                              echo format_indo($tgl); ?></span>

               </div>
             </a>
           </div>
         <?php endforeach; ?>

         <?php foreach ($lomba as $l) : ?>
           <div class="col-lg-3 col-md-6 portfolio-item filter-lomba">
             <a href="<?= base_url('website/detail_event/' . $l['event_id']) ?>">
               <div class="post-box">
                 <div class="post-img"><img src="<?= base_url('assets/images/event/thumbs' . $l['thumbs']) ?>" class="img-fluid" alt=""></div>
                 <h3 class="post-title"><?= $l['judul'] ?></h3>
                 <span class="post-date"><i class="fas fa-calendar-alt"></i> <?php $tgl = $l['tgl_event'];
                                                                              echo format_indo($tgl); ?></span>

               </div>
             </a>
           </div>
         <?php endforeach; ?>


       </div>
       <div class="text-center text-lg-start d-flex flex-column justify-content-center mt-5">
         <a href="<?= base_url('website/event') ?>" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
           <span>Read More</span>
           <i class="bi bi-arrow-right"></i>
         </a>
       </div>
       <!-- <button href="#" class="btn-1"><span>Read More</span></button> -->
     </div>




   </section><!-- End Portfolio Section -->




   <!-- Testimonials -->
   <section id="testimonials" class="testimonials">

     <div class="container" data-aos="fade-up">

       <header class="section-header">
         <h2>Kata Mereka?</h2>
         <p>Telah menggunakan platform Event Tech sebagai penunjang penyelenggaraan event technology</p>
       </header>

       <div class="testimonials-slider swiper-container" data-aos="fade-up" data-aos-delay="200">
         <div class="swiper-wrapper">
           <?php foreach ($testi as $t) : ?>
             <div class="swiper-slide">
               <div class="testimonial-item">
                 <!-- <div class="stars">
                   <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                 </div> -->
                 <div class="profile mt-auto">
                   <img src="<?= base_url('assets/images/testimoni/' . $t['gambar']) ?>" class="testimonial-img" alt="">
                   <h3><?= $t['penyelenggara'] ?></h3>
                 </div>
                 <p>
                   <?= $t['desk'] ?>
                 </p>
               </div>
             </div><!-- End testimonial item -->
           <?php endforeach; ?>







         </div>
         <div class="swiper-pagination"></div>
       </div>

     </div>

   </section><!-- End Testimonials Section -->





 </main><!-- End #main -->