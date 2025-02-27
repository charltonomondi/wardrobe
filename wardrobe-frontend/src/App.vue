<template>
  <div>
    <nav>
      <router-link to="/login">Login</router-link> |
      <router-link to="/register">Register</router-link>
    </nav>
    <router-view />
  </div>
</template>

<script setup>
// No additional script logic is needed for now
</script>

<style>
/* Global styles */
body {
  margin: 0;
  font-family: Arial, sans-serif;
  background-color: #f0f2f5;
}

nav {
  padding: 1rem;
  background-color: #007bff;
  text-align: center;
}

nav a {
  color: white;
  text-decoration: none;
  margin: 0 10px;
  font-weight: bold;
}

nav a:hover {
  text-decoration: underline;
}
</style>