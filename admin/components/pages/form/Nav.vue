<script setup>
const props = defineProps({
  activeTab: {
    type: Number,
    required: true
  },
  setActiveTab: {
    type: Function,
    required: true
  }
})
</script>
<template>
  <div class="card">
    <div class="card-body">
      <nav>
        <ul>
          <li :class="{active: activeTab == 0}">
            <button @click.prevent="setActiveTab(0)" type="button" class="btn">
              Meta
            </button>
          </li>
          <li :class="{active: activeTab == 1}">
            <button @click.prevent="setActiveTab(1)" type="button" class="btn">
              Blok 1
            </button>
          </li>
          <li :class="{active: activeTab == 2}">
            <button @click.prevent="setActiveTab(2)" type="button" class="btn">
              Blok 2
            </button>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</template>
