<script setup>
defineProps({
  currentStep: {
    type: Number,
    required: true
  }
})
</script>
<template>
  <div class="steps">
    <div class="step" :class="{active: currentStep == 1}">
      <div class="icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
          <!-- Icon from Material Symbols Light by Google - https://github.com/google/material-design-icons/blob/master/LICENSE -->
          <path fill="currentColor"
                d="M12.003 21q-1.866 0-3.51-.708q-1.643-.709-2.859-1.924t-1.925-2.856T3 12.003t.709-3.51Q4.417 6.85 5.63 5.634t2.857-1.925T11.997 3t3.51.709q1.643.708 2.859 1.922t1.925 2.857t.709 3.509t-.708 3.51t-1.924 2.859t-2.856 1.925t-3.509.709M12 20q3.35 0 5.675-2.325T20 12q0-.175-.003-.353t-.022-.341q-.067.667-.53 1.104q-.464.436-1.137.436h-2.539q-.698 0-1.195-.496t-.497-1.193v-.845h-3.385v-1.69q0-.697.498-1.198q.497-.501 1.195-.501h.846v-.77q0-.728.476-1.146t1.137-.482q-.673-.26-1.38-.392T12 4Q8.65 4 6.325 6.325T4 12v.289q0 .134.02.288H8.5q1.42 0 2.402.983q.983.982.983 2.393v.855H9.346v2.73q.616.222 1.286.342T12 20"/>
        </svg>
      </div>
      <div class="title">
        Country
      </div>
    </div>
    <div class="line" :class="{active: currentStep > 1}"></div>
    <div class="step" :class="{active: currentStep == 2}">
      <div class="icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
          <!-- Icon from Material Design Icons by Pictogrammers - https://github.com/Templarian/MaterialDesign/blob/master/LICENSE -->
          <path fill="currentColor"
                d="M20.56 3.91c.59.59.59 1.54 0 2.12l-3.89 3.89l2.12 9.19l-1.41 1.42l-3.88-7.43L9.6 17l.36 2.47l-1.07 1.06l-1.76-3.18l-3.19-1.77L5 14.5l2.5.37L11.37 11L3.94 7.09l1.42-1.41l9.19 2.12l3.89-3.89c.56-.58 1.56-.58 2.12 0"/>
        </svg>
      </div>
      <div class="title">
        Arrival Date
      </div>
    </div>
    <div class="line" :class="{active: currentStep > 2}"></div>
    <div class="step" :class="{active: currentStep == 3}">
      <div class="icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
          <!-- Icon from Tabler Icons by Paweł Kuna - https://github.com/tabler/tabler-icons/blob/master/LICENSE -->
          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2"
                d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0-4 0m-2 8v-1a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v1M15 5a2 2 0 1 0 4 0a2 2 0 0 0-4 0m2 5h2a2 2 0 0 1 2 2v1M5 5a2 2 0 1 0 4 0a2 2 0 0 0-4 0m-2 8v-1a2 2 0 0 1 2-2h2"/>
        </svg>
      </div>
      <div class="title">
        Personal Information
      </div>
    </div>
<!--    <div class="line" :class="{active: currentStep > 3}"></div>-->
    <!--    <div class="step" :class="{active: currentStep == 4}">-->
    <!--      <div class="icon">-->
    <!--        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">-->
    <!--          &lt;!&ndash; Icon from Material Symbols by Google - https://github.com/google/material-design-icons/blob/master/LICENSE &ndash;&gt;-->
    <!--          <path fill="currentColor"-->
    <!--                d="m10.6 16.6l7.05-7.05l-1.4-1.4l-5.65 5.65l-2.85-2.85l-1.4 1.4zM12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22m0-2q3.35 0 5.675-2.325T20 12t-2.325-5.675T12 4T6.325 6.325T4 12t2.325 5.675T12 20m0-8"/>-->
    <!--        </svg>-->
    <!--      </div>-->
    <!--      <div class="title">-->
    <!--        Payment-->
    <!--      </div>-->
    <!--    </div>-->
  </div>
</template>
