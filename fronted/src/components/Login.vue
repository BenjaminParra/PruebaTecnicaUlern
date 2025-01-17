<script setup>
import { ref, onMounted } from "vue"; //onMounted para realizar una accion cuando el componente se inicializa o monta
import axios from "axios"; //Para realizar consultar http
import { useRouter } from "vue-router"; //Para navegar entre rutas

const email = ref("");
const password = ref("");
const router = useRouter();
// Verifica si ya hay un usuario logueado al momento de montar el componente
onMounted(() => {
  const userId = localStorage.getItem("userId");
  if (userId) {
    // Si ya hay un userId en el localStorage, redirigir al perfil
    alert("Ya existe una sesión iniciada");
    router.push(`/perfil`);
  }
});
const onLogin = async () => {
  try {
    // Solicitud a la api de Laravel
    const response = await axios.post("http://localhost:8000/api/login", {
      email: email.value,
      password: password.value,
    });

    if (response.data.status === 200) {
      // Almacenamos el id del usuario en localStorage
      localStorage.setItem("userId", response.data.data.id);

      // Luego dirigimos al perfil del usuario logueado
      router.push(`/perfil`);
      alert("Inicio de sesión exitoso");
    } else {
      alert(response.data.message);
    }
  } catch (error) {
    console.error("Error al iniciar sesión", error);
    alert("Ocurrió un error. Inténtalo de nuevo");
  }
};
</script>

<template>
  <div class="max-w-md mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-6 text-center">Inicio de Sesión</h2>
    <form @submit.prevent="onLogin">
      <div class="mb-4">
        <label class="block text-sm font-medium mb-1" for="email"
          >Correo Electrónico</label
        >
        <input
          v-model="email"
          id="email"
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
          v-model="password"
          id="password"
          type="password"
          placeholder="*******"
          class="w-full border border-gray-300 p-2 rounded-md"
        />
      </div>
      <button
        type="submit"
        class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-700"
      >
        Iniciar Sesión
      </button>
    </form>
  </div>
</template>

<style scoped></style>
