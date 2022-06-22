<main id="main">

  <!-- ======= Blog Single Section ======= -->
  <section id="blog" class="blog mt-5">
    <div class="container" data-aos="fade-up">

      <div class="row">

        <div class="col-lg-8 entries">

          <article class="entry entry-single">

            <div class="entry-img">
              <img src="<?= base_url('assets/images/blog/' . $detailblog['gambar']) ?>" alt="" class="img-fluid">
            </div>

            <h2 class="entry-title">
              <a href="#"><?= $detailblog['judul'] ?></a>
            </h2>

            <div class="entry-meta">
              <ul>
                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="#"><?= $detailblog['name'] ?></a></li>
                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#"><time datetime="2020-01-01"> <?php
                                                                                                                            $time = $detailblog['tgl_blog'];
                                                                                                                            echo format_indo($time);
                                                                                                                            ?></time></a></li>
                <li class="d-flex align-items-center"><i class="bi bi-tags"></i><a href="#"><?= $detailblog['tags_name'] ?></a></li>

              </ul>
            </div>

            <div class="entry-content">


              <p>
                <?= $detailblog['deskripsi'] ?>
              </p>

            </div>



          </article><!-- End blog entry -->
          <div id="disqus_thread"></div>
          <script>
            /**
             *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
             *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
            /*
            var disqus_config = function () {
            this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
            };
            */
            (function() { // DON'T EDIT BELOW THIS LINE
              var d = document,
                s = d.createElement('script');
              s.src = 'https://eventtech-com.disqus.com/embed.js';
              s.setAttribute('data-timestamp', +new Date());
              (d.head || d.body).appendChild(s);
            })();
          </script>
          <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

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
  </section><!-- End Blog Single Section -->

</main><!-- End #main -->