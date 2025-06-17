<script setup>
import {useLoginForm} from "~/composables/auth/LoginComposable.js";

const {user, login} = useLoginForm()

const isPassword = ref(true)

</script>
<template>
  <form class="my-4" @submit.prevent="login">
    <div class="form-group mb-2">
      <label class="form-label" for="email">E-mail</label>
      <input type="text" v-model="user.email" class="form-control" id="email"
             placeholder="E-mail" required>
    </div><!--end form-group-->

    <div class="form-group">
      <label class="form-label visually-hidden" for="inlineFormInputGroupUsername">Username</label>
      <label class="form-label" for="password">Şifrə</label>
      <div class="input-group">
        <input :type="isPassword ? 'password' : 'text'" v-model="user.password" class="form-control" id="password"
               placeholder="Şifrə" required>
        <div class="input-group-text"><i style="cursor: pointer" @click.prevent="isPassword = !isPassword "
                                         class="fas fa-eye"></i></div>
      </div>
    </div><!--end form-group-->

    <div class="form-group mb-0 row">
      <div class="col-12">
        <div class="d-grid mt-3">
          <button class="btn btn-primary" type="submit">Daxil ol <i
              class="fas fa-sign-in-alt ms-1"></i></button>
        </div>
      </div><!--end col-->
    </div> <!--end form-group-->
  </form><!--end form-->
</template>
