<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const userId = localStorage.getItem("userId"); //Intentamos obtener el userId del localStorage
const router = useRouter();

// Datos del usuario
const user = ref({
  nombre: "",
  apellido: "",
  telefono: "",
  email: "",
});

const cargarUsuario = async () => {
  //Si el userId es null significa que no existe sesión iniciada
  if (!userId) {
    alert("No estás autenticado. Redirigiendo al login.");
    router.push("/login"); //Si no hay sesión iniciada se redirige al login
    return;
  }

  try {
    //Si es que está logeado se realiza solicitud a la api
    const response = await axios.get(
      `http://localhost:8000/api/usuarios/${userId}`
    );

    if (response.data.status === 200) {
      //si todo resulta bien asignamos la respuesta al usuario
      user.value = response.data.data;
    } else {
      //Si no es encuentra el usuario se redirige al login
      alert("Usuario no encontrado");
      router.push("/login");
    }
  } catch (error) {
    console.error("Error al cargar el perfil del usuario", error);
    alert("Ocurrió un error. Inténtalo de nuevo");
  }
};

//Al momento de montarse el componente llamaos a la función
onMounted(cargarUsuario);

const onLogout = () => {
  localStorage.removeItem("userId");
  alert("Sesión cerrada");
  router.push("/login");
};
</script>

<template>
  <div class="max-w-md mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-6 text-center">Perfil de Usuario</h2>
    <div class="mb-4">
      <p class="text-sm font-medium">Nombre:</p>
      <p class="text-lg font-semibold">{{ user.nombre }}</p>
    </div>
    <div class="mb-4">
      <p class="text-sm font-medium">Apellido:</p>
      <p class="text-lg font-semibold">{{ user.apellido }}</p>
    </div>
    <div class="mb-4">
      <p class="text-sm font-medium">Número de Teléfono:</p>
      <p class="text-lg font-semibold">{{ user.telefono }}</p>
    </div>
    <div class="mb-4">
      <p class="text-sm font-medium">Correo Electrónico:</p>
      <p class="text-lg font-semibold">{{ user.email }}</p>
    </div>
    <button
      @click="onLogout"
      type="button"
      class="w-full bg-red-500 text-white py-2 rounded-md hover:bg-red-700"
    >
      Cerrar Sesión
    </button>
  </div>
</template>

<style scoped></style>
