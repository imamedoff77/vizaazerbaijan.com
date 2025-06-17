<script setup>

const props = defineProps({
  steps: {
    type: Object,
    required: true
  },
  form: {
    type: Object,
    required: true
  }
})

const validateForm = step => {
  if (step == 1) {
    return props.form.nationality && props.form.travel_document
  }

  if (step == 2) {
    return props.form.purpose && props.form.arrival_date
  }

  if (step == 3) {
    return props.form.given_name && props.form.birthday && props.form.country_of_birth && props.form.place_of_birth && props.form.sex && props.form.occupation && props.form.phone_number && props.form.address && props.form.email && props.form.passport_file && props.form.passport_issue_date && props.form.passport_expire_date && props.form.address_in_azerbaijan && props.form.terms
  }
}


const canPrev = computed(() => props.steps.current > 1)
const canNext = computed(() =>
    (props.steps.current < props.steps.total)
    && validateForm(props.steps.current)
)

</script>
<template>
  <div class="navigation">
    <button :disabled="!canPrev" @click.prevent="steps.prev" type="button" id="prev"
            class="btn btn-sm btn-secondary">
      Prev
    </button>
    <button :disabled="!canNext" @click.prevent="steps.next" type="button" id="next"
            class="btn btn-sm btn-success">
      Next
    </button>
  </div>
</template>
