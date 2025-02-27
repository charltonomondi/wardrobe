<template>
    <div class="login-container">
      <div class="login-box">
        <h2>Login</h2>
        <form @submit.prevent="login" class="login-form">
          <div class="form-group">
            <label for="email">Email</label>
            <input
              v-model="email"
              type="email"
              id="email"
              placeholder="Enter your email"
              required
            />
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input
              v-model="password"
              type="password"
              id="password"
              placeholder="Enter your password"
              required
            />
          </div>
          <button type="submit" class="login-button">Login</button>
        </form>
        <p class="register-link">
          Don't have an account?
          <router-link to="/register">Register here</router-link>
        </p>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { useRouter } from 'vue-router';
  import axios from 'axios';
  
  const email = ref('');
  const password = ref('');
  const router = useRouter();
  
  const login = async () => {
    try {
      const response = await axios.post('http://localhost:8000/api/login', {
        email: email.value,
        password: password.value,
      });
      localStorage.setItem('auth_token', response.data.token);
      router.push('/');
    } catch (error) {
      alert('Login failed. Please check your credentials.');
    }
  };
  </script>
  
  <style scoped>
  .login-container {
    /* Full viewport with background image */
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    width: 100vw;
    background: url('/images2.webp') no-repeat center center;
    background-size: cover;
    padding: 20px;
  }
  
  .login-box {
    background: rgba(255, 255, 255, 0.9); /* slight transparency for better readability */
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
  
  .login-form {
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
  
  .login-button {
    padding: 0.75rem;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  
  .login-button:hover {
    background-color: #0056b3;
  }
  
  .register-link {
    margin-top: 1rem;
    color: #666;
  }
  
  .register-link a {
    color: #007bff;
    text-decoration: none;
    font-weight: 500;
  }
  
  .register-link a:hover {
    text-decoration: underline;
  }
  </style>
  