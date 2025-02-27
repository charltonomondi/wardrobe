<template>
    <div class="auth-container">
      <div class="auth-box">
        <h2>Register</h2>
        <form @submit.prevent="register" class="auth-form">
          <div class="form-group">
            <label for="name">Name</label>
            <input v-model="name" type="text" id="name" placeholder="Enter your name" required />
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input v-model="email" type="email" id="email" placeholder="Enter your email" required />
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input v-model="password" type="password" id="password" placeholder="Enter your password" required />
          </div>
          <div class="form-group">
            <label for="passwordConfirmation">Confirm Password</label>
            <input v-model="passwordConfirmation" type="password" id="passwordConfirmation" placeholder="Confirm your password" required />
          </div>
          <button type="submit" class="auth-button">Register</button>
        </form>
        <p class="auth-link">
          Already have an account? <router-link to="/login">Login here</router-link>
        </p>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { useRouter } from 'vue-router';
  import api from '../api';
  
  const name = ref('');
  const email = ref('');
  const password = ref('');
  const passwordConfirmation = ref('');
  const router = useRouter();
  
  const register = async () => {
    try {
      await api.post('/register', {
        name: name.value,
        email: email.value,
        password: password.value,
        password_confirmation: passwordConfirmation.value,
      });
      router.push('/login');
    } catch (error) {
      if (error.response && error.response.data.errors) {
        alert(JSON.stringify(error.response.data.errors));
      } else {
        alert('Registration failed. Please try again.');
      }
    }
  };
  </script>
  
  <style scoped>
  .auth-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    width: 100vw;
    background-color: #f0f2f5;
    padding: 20px;
  }
  
  .auth-box {
    background: white;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 450px;
    text-align: center;
  }
  
  h2 {
    margin-bottom: 1.5rem;
    font-size: 1.75rem;
    color: #333;
  }
  
  .auth-form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }
  
  .form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    text-align: left;
  }
  
  label {
    font-weight: 500;
    color: #555;
  }
  
  input {
    padding: 0.75rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1rem;
    outline: none;
    transition: border-color 0.3s ease;
  }
  
  input:focus {
    border-color: #007bff;
  }
  
  .auth-button {
    padding: 0.75rem;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  
  .auth-button:hover {
    background-color: #0056b3;
  }
  
  .auth-link {
    margin-top: 1rem;
    color: #666;
  }
  
  .auth-link a {
    color: #007bff;
    text-decoration: none;
    font-weight: 500;
  }
  
  .auth-link a:hover {
    text-decoration: underline;
  }
  </style>
  