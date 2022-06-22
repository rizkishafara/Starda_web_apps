<main id="main">


  <section id="pastevent" class="blog mt-5">
    <div class="container" data-aos="fade-up">

      <div class="row">



        <div class="col-lg-3">

          <div class="sidebar filter">

            <h3 class="sidebar-title"><i class="fas fa-filter fa-sm"></i>Filter</h3>
            <ul> <b>Kategori Event</b>
              <hr>
              <?php foreach ($getcat as $cat) : ?>
                <li>
                  <a href="<?= base_url('website/eventcategory/' . $cat['id']) ?>"> <?= $cat['categories'] ?></a>
                </li>
              <?php endforeach; ?>
            </ul>
            <ul> <b>Tipe Event</b>
              <hr>

              <li>
                <a href="<?= base_url('website/tipe_event_bayar/') ?>">Berbayar</a>
              </li>

              <li>
                <a href="<?= base_url('website/tipe_event_gratis/') ?>">Gratis</a>
              </li>




            </ul>
            <!-- <ul> <b>Lokasi</b>
              <hr>
              <li>

                <select class="form-select" id="chosen">
                  <option selected>Choose</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>

              </li>




            </ul> -->


          </div><!-- End sidebar -->

        </div><!-- End blog sidebar -->
        <div class="col-lg-9 entries event">

          <!-- <article class="entry"> -->

          <!-- ======= Recent Blog Posts Section ======= -->


          <div class="row">

            <?php foreach ($event as $e) : ?>

              <div class="col-lg-4 eventpost">
                <a href="<?= base_url('website/detail_event/' . $e['event_id']) ?>">
                  <div class="post-box">
                    <div class="post-img"><img src="<?= base_url('assets/images/event/thumbs' . $e['thumbs']) ?>" class="img-fluid" alt=""></div>
                    <h3 class="post-title"><?= $e['judul'] ?></h3>
                    <span class="post-date"><i class="fas fa-calendar-alt"></i> <?php $tgl = $e['tgl_event'];
                                                                                echo format_indo($tgl); ?></span>


                    <!-- <div class="col-3">

                      <span class="badge rounded-pill bg-secondary"><?= $e['categories']; ?></span>
                    </div> -->

                  </div>
                </a>
              </div>

            <?php endforeach; ?>
          </div>

        </div>

      </div>
  </section><!-- End Blog Section -->

  <!-- ======= Services Section ======= -->




</main><!-- End #main -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="<?= base_url('assets/website/chosen/chosen.jquery.min.js'); ?>"></script>
<script>
  $(document).ready(function() {
    $("#chosen").chosen({
      width: '100%',
    })


  });
</script>