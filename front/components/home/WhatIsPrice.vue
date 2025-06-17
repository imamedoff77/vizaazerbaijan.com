<script setup>
const meta = {
  title: 'Get Ready for Azerbaijan!',
  description: `We're here to support you and make sure everything goes smoothly.`
}
</script>
<template>
  <section class="what-is-price">
    <div class="container">
      <div class="top">
        <div class="left">
          <h3 class="title">What’s the Price?</h3>
          <p class="description">We offer three service options: Standard, Fast, and Emergency. Each option has its own
            pricing, which includes both the application and service fees. To find out the price:</p>
          <p>
            1. Select the speed of service you need using the buttons below.
          </p>
          <p>
            2. Choose your nationality.
          </p>
          <p>
            3. See the price!
          </p>
        </div>
        <div class="right">
          <div class="img">
            <img src="/assets/custom/images/baku2.jpg" alt="">
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