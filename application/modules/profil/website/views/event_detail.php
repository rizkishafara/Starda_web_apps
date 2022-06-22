<main id="main">


  <!-- ======= Portfolio Details Section ======= -->
  <section id="portfolio-details" class="portfolio-details mt-5" data-aos="fade-up">
    <div class="container">

      <div class="row gy-4">

        <div class="col-lg-4">
          <div class="portfolio-details-slider swiper-container">
            <div class="swiper-slide">
              <!-- <div class="shadow p-3 mb-5 bg-body rounded">Regular shadow</div> -->
              <img src="<?= base_url('assets/images/event/' . $detailevent['gambar']); ?>" class="rounded img-thumbnail shadow mb-5">



            </div>
            <div class="swiper-wrapper align-items-center">


              <!-- <div class="swiper-slide">
                  <img src="assets/img/gallery/2.jpg" style="max-height: 940px;" alt="">
                </div>

                <div class="swiper-slide">
                  <img src="assets/img/gallery/1.jpeg" style="max-height: 940px;" alt="">
                </div> -->

            </div>
            <!-- <div class="swiper-pagination"></div> -->
          </div>
        </div>

        <div class="col-md-8">
          <div class="portfolio-info">

            <!-- <h3></h3> -->
            <ul>
              <li>
                <img src="<?= base_url('assets/images/users/' . $detailevent['image']) ?>" class="rounded-circle" width="70px"> <strong class="ms-2"><?= $detailevent['name'] ?></strong>
              </li>
              <li>
                <h4><b><?= $detailevent['judul'] ?></b></h4>
              </li>
              <li><i class="fas fa-calendar-alt"></i> <?php $tgl = $detailevent['tgl_event'];
                                                      echo format_indo($tgl); ?></li>
              <li><i class="fas fa-clock"></i> <?php $waktu = $detailevent['tgl_event'];
                                                echo waktu_indo($waktu); ?></li>
              <li><i class="fas fa-map-marked-alt"></i> Online</li>
              <li><i class="fas fa-ticket-alt"></i>
                <?php if ($detailevent['harga'] == 0) {
                  echo "FREE";
                } else { ?>
                  Rp. <?= number_format($detailevent['harga'], 0); ?>
                <?php
                } ?>

              </li>
              <li><i class="fas fa-users"></i> Kuota Tersisa <?= $detailevent['kuota'] ?> Peserta</li>
              <li> <span class="badge rounded-pill bg-secondary"><?= $detailevent['categories'] ?></span></li>
            </ul>
            <a href="<?= base_url('snap/index/' . $detailevent['event_id'])  ?>">
              <div class="d-grid gap-3 mt-5 mb-2 col-md-3">
                <button type="button" class="btn shadow mb-3" style="outline-color: #5969f3;background-color: #5969f3;color: whitesmoke; border-radius: 10px;">Pesan
                  Tiket</button>
              </div>
            </a>
          </div>
          <!-- <div class="portfolio-description">
              <h2>Keikutsertaan</h2>
              <p>
                Silakan masuk dahulu ke Event Tech untuk dapat melakukan pemesanan tiket acara ke event ini.
              </p>

            </div> -->
        </div>
        <div class="features portfolio-info">

          <div class="container" data-aos="fade-right">

            <!-- Feature Tabs -->
            <div class="row feture-tabs" data-aos="fade-right">
              <div class="col-md">
                <!-- Tabs -->
                <ul class="nav nav-pills mb-3">

                  <li></li>
                  <li>
                    <a class="nav-link active" data-bs-toggle="pill" href="#tab1">Deskripsi</a>
                  </li>
                  <li>
                    <a class="nav-link" data-bs-toggle="pill" href="#tab2">Rundown Acara</a>
                  </li>

                </ul><!-- End Tabs -->

                <!-- Tab Content -->
                <div class="tab-content">

                  <div class="tab-pane fade show active justify-content-center" id="tab1">
                    <p style="text-align: justify; margin: 10px;">
                      <?= $detailevent['deskripsi'] ?>
                    </p>
                  </div><!-- End Tab 1 Content -->

                  <div class="tab-pane fade show" id="tab2">
                    <h4 class="mb-3">Rundown acara:</h4>
                    <div class="d-flex align-items-center mb-2">
                      <i class="bi bi-square"></i>
                      <h6>19.00 - 19.10 Pembukaan oleh moderator (Ahmad Arif Faizin - Google Associate Android
                        Developer,
                        Curriculum Developer Dicoding).</h6>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                      <i class="bi bi-square"></i>
                      <h6>19.10 - 20.00 "Dicoding Developer Coaching #36: Android | Performance Matter dalam
                        Aplikasi
                        Android" akan dibawakan oleh Dimas Catur Wibowo (Google Associate Android Developer, Code
                        Reviewer
                        Dicoding).</h6>
                    </div>
                  </div><!-- End Tab 2 Content -->



                </div>

              </div>

            </div><!-- End Feature Tabs -->

          </div>

        </div><!-- End Features Section -->

      </div>

    </div>
    <!-- ======= Features Section ======= -->
  </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->