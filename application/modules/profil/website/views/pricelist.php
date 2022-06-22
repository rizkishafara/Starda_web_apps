<main id="main">




  <!-- ======= Pricing Section ======= -->
  <section id="pricing" class="pricing mt-5">

    <div class="container" data-aos="fade-up">

      <header class="section-header">
        <h2>Paket Harga?</h2>
        <p>Paket Layanan Partnership dapat dipilih berdasarkan kebutuhan dari penyelenggaraan event technology yang
          akan anda laksanakan</p>
      </header>

      <div class="row gy-4" data-aos="fade-left">

        <?php foreach ($price as $p) :

        ?>

          <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="box">
              <h3 style="color: <?= $p['colorplan']; ?>;"> <?= $p['nameplan'] ?></h3>

              <div class="price"><sup>Rp.</sup><?= $p['harga'] ?>K<span> / Event</span></div>
              <img src="<?= base_url('assets/images/pricelist/' . $p['gambar']); ?>" class="img-fluid" alt="">
              <ul>
                <li><?= $p['offer']; ?></li>
                <li class="na"><?= $p['not_offer']; ?></li>
              </ul>
              <!-- <a href="#" class="btn-buy">Buy Now</a> -->
            </div>
          </div>
        <?php endforeach; ?>

        <!-- <p>Syarat dan Ketentuan :</p>
      <p>*Platform Zoom Meeting full Participant hanya tersedia pada paket Ultimate, Paket Business terbatas hanya
        100 Participant</p> -->
      </div>

    </div>

  </section><!-- End Pricing Section -->




</main><!-- End #main -->