<script setup>
const meta = {
  title: 'Start Your Journey',
  description: 'It only takes 5 minutes to provide the necessary information.'
}
</script>
<template>
  <section class="purpose-of-visit">
    <div class="line"></div>
    <div class="container">
      <div class="top">
        <div class="left">
          <h3 class="title">What Can Be the Purpose of Your Visit?</h3>
          <ul>
            <li>
              <p><b>Tourism:</b> Discover Azerbaijan’s breathtaking landscapes, rich history, and vibrant culture
                through its diverse attractions and activities.</p>
            </li>
            <li>
              <p>
                <b>Business Trip:</b> Take advantage of business opportunities and networking in Azerbaijan’s thriving
                economy, especially in Baku, a hub for trade and innovation.
              </p>
            </li>
            <li>
              <p>
                <b>Culture:</b> Immerse yourself in Azerbaijan’s unique cultural heritage, from traditional music and
                dance to captivating art and architecture.
              </p>
            </li>
            <li>
              <p>
                <b>Science:</b> Collaborate with local institutions and engage in research that highlights Azerbaijan’s
                contributions to various scientific fields.
              </p>
            </li>
            <li>
              <p>
                <b>Sports:</b> Participate in or enjoy a variety of sports events, from traditional games to modern
                competitions, all set against Azerbaijan’s stunning scenery.
              </p>
            </li>
          </ul>
          <p>And More…</p>
        </div>
        <div class="right">
          <div class="img">
            <img src="/assets/custom/images/haydar-aliyev-center.webp" alt="">
          </div>
          <div class="figure">
            <div class="top">
              <div class="left">
                <div class="p-32">
                  <div class="item">
                    <div class="inner"></div>
                  </div>
                </div>
              </div>
              <div class="right">
                <div class="p-32">
                  <div class="item">
                    <div class="inner"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="bottom">
              <div class="left">
                <div class="p-32">
                  <div class="item">
                    <div class="inner"></div>
                  </div>
                </div>
              </div>
              <div class="right">
                <div class="p-32">
                  <div class="item">
                    <div class="inner"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="bottom">
        <ReusableServices :meta="meta"/>
      </div>
    </div>
  </section>
</template>