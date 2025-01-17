<script setup></script>

<template>
  <div>
    <!-- Se crea un navegador-->
    <nav class="bg-gray-200 p-4">
      <ul class="flex space-x-4">
        <!-- Se agrega cada enlace de la página -->
        <li>
          <router-link to="/login" class="text-blue-500 hover:underline"
            >Login</router-link
          >
        </li>
        <li>
          <router-link to="/registro" class="text-blue-500 hover:underline"
            >Registro</router-link
          >
        </li>
        <li>
          <router-link to="/perfil" class="text-blue-500 hover:underline"
            >Perfil</router-link
          >
        </li>
      </ul>
    </nav>

    <router-view />
  </div>
</template>

<style scoped>
nav {
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}
</style>
