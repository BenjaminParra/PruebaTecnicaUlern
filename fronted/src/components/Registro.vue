<script setup>
import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const nombre = ref("");
const apellido = ref("");
const telefono = ref("");
const email = ref("");
const password = ref("");

const router = useRouter();

const onRegister = async (e) => {
  e.preventDefault();

  if (
    !nombre.value ||
    !apellido.value ||
    !telefono.value ||
    !email.value ||
    !password.value
  ) {
    alert("Por favor, completa todos los campos");
    return;
  }

  try {
    const response = await axios.post("http://localhost:8000/api/usuarios", {
      nombre: nombre.value,
      apellido: apellido.value,
      telefono: telefono.value,
      email: email.value,
      password: password.value,
    });

    alert(response.data.message);
    router.push("/login");
  } catch (error) {
    console.error(error);

    if (error.response && error.response.data && error.response.data.message) {
      alert(error.response.data.message);
    } else {
      alert("Hubo un error al registrar el usuario. Inténtalo de nuevo.");
    }
  }
};
</script>

<template>
  <div class="max-w-md mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-6 text-center">Registro de Usuario</h2>
    <form @submit="onRegister">
      <div class="mb-4">
        <label class="block text-sm font-medium mb-1" for="nombre"
          >Nombre</label
        >
        <input
          id="nombre"
          v-model="nombre"
          type="text"
          placeholder="Tu nombre"
          class="w-full border border-gray-300 p-2 rounded-md"
        />
      </div>
      <div class="mb-4">
        <label class="block text-sm font-medium mb-1" for="apellido"
          >Apellido</label
        >
        <input
          id="apellido"
          v-model="apellido"
          type="text"
          placeholder="Tu apellido"
          class="w-full border border-gray-300 p-2 rounded-md"
        />
      </div>
      <div class="mb-4">
        <label class="block text-sm font-medium mb-1" for="telefono"
          >Número de Teléfono</label
        >
        <input
          id="telefono"
          v-model="telefono"
          type="tel"
          placeholder="Tu número de teléfono"
          class="w-full border border-gray-300 p-2 rounded-md"
        />
      </div>
      <div class="mb-4">
        <label class="block text-sm font-medium mb-1" for="email"
          >Correo Electrónico</label
        >
        <input
          id="email"
          v-model="email"
          type="email"
          placeholder="email@email.com"
          class="w-full border border-gray-300 p-2 rounded-md"
        />
      </div>
      <div class="mb-6">
        <label class="block text-sm font-medium mb-1" for="password"
          >Contraseña</label
        >
        <input
          id="password"
          v-model="password"
          type="password"
          placeholder="*******"
          class="w-full border border-gray-300 p-2 rounded-md"
        />
      </div>
      <button
        type="submit"
        class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-700"
      >
        Registrarse
      </button>
    </form>
  </div>
</template>

<style scoped></style>
