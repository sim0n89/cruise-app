
<template>
  <header class="d-flex justify-content-center py-3">
    <container>
      <ul class="nav nav-pills">
        <li class="nav-item">
          <router-link to="/" class="nav-link " aria-current="page">Список кораблей</router-link>
        </li>
        <li class="nav-item">
          <router-link to="/categories" class="nav-link">Список категорий</router-link>
        </li>

      </ul>
    </container>
  </header>
</template>	
<script>
import { defineComponent } from 'vue'

export default defineComponent({
  components: {},
  setup() {
    return {}
  },
})
</script>