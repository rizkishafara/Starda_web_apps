<main id="main">


  <!-- ======= Blog Section ======= -->
  <section id="blog" class="blog mt-5">
    <div class="container" data-aos="fade-up">

      <div class="row">

        <div class="col-lg-8 entries">
          <?php foreach ($allblog as $b) : ?>
            <article class="entry">

              <div class="entry-img">
                <img src="<?= base_url('assets/images/blog/' . $b['gambar']) ?>" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a href="<?= base_url('website/detail_blog/' . $b['slug']) ?>"><?= $b['judul'] ?></a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="#"><?= $b['name'] ?></a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#">
                      <?php
                      $time = $b['tgl_blog'];
                      echo format_indo($time);
                      ?></a>
                  </li>
                  <li class="d-flex align-items-center"><i class="bi bi-tags"></i><a href="#"><?= $b['tags_name'] ?></a></li>

                </ul>
              </div>

              <div class="entry-content">
                <p>
                  <?= word_limiter($b['deskripsi'], 25)  ?>
                </p>
                <div class="read-more">
                  <a href="<?= base_url('website/detail_blog/' . $b['slug']) ?>">Read More</a>
                </div>
              </div>

            </article><!-- End blog entry -->

          <?php endforeach; ?>

          <?= $this->pagination->create_links(); ?>
          <!-- 
          <div class="blog-pagination">
            <ul class="justify-content-center">
              <li><a href="#">1</a></li>
              <li class="active"><a href="#">2</a></li>
              <li><a href="#">3</a></li>
            </ul>
          </div> -->

        </div><!-- End blog entries list -->

        <div class="col-lg-4">

          <div class="sidebar">



            <h3 class="sidebar-title">Recent Posts</h3>
            <div class="sidebar-item recent-posts">
              <?php foreach ($recents as $r) : ?>
                <div class="post-item clearfix">
                  <img src="<?= base_url('assets/images/blog/' . $r['gambar']) ?>" alt="">
                  <h4><a href="<?= base_url('website/detail_blog/' . $r['slug']) ?>"><?= word_limiter($r['judul'], 5)  ?></a></h4>
                  <time datetime="2020-01-01"> <?php
                                                $time = $r['tgl_blog'];
                                                echo time_ago(strtotime($time));
                                                ?></time>
                </div>
              <?php endforeach; ?>


            </div><!-- End sidebar recent posts-->

            <h3 class="sidebar-title">Tags</h3>
            <div class="sidebar-item tags">
              <ul>
                <?php foreach ($tags as $ta) : ?>
                  <li><a href="<?= base_url('website/detail_tag/' . $ta['tags_name']) ?>"><?= $ta['tags_name'] ?></a></li>
                <?php endforeach; ?>
              </ul>
            </div><!-- End sidebar tags-->

          </div><!-- End sidebar -->

        </div><!-- End blog sidebar -->

      </div>

    </div>
  </section><!-- End Blog Section -->

</main><!-- End #main -->