<template>
  <div class="wardrobe-container">
    <h2>My Wardrobe</h2>

    <!-- Add Clothing Item Form -->
    <form @submit.prevent="addItem" class="add-item-form">
      <input v-model="newItem.name" type="text" placeholder="Name" required />
      <select v-model="newItem.category" required>
        <option value="" disabled>Select Category</option>
        <option value="tops">Tops</option>
        <option value="bottoms">Bottoms</option>
        <option value="shoes">Shoes</option>
      </select>
      <textarea v-model="newItem.description" placeholder="Description"></textarea>
      <button type="submit">Add Item</button>
    </form>

    <!-- Filter and Search -->
    <div class="filter-search">
      <input v-model="searchQuery" type="text" placeholder="Search by name" />
      <select v-model="filterCategory">
        <option value="">All Categories</option>
        <option value="tops">Tops</option>
        <option value="bottoms">Bottoms</option>
        <option value="shoes">Shoes</option>
      </select>
    </div>

    <!-- Clothing Items List -->
    <ul class="clothing-items-list">
      <li v-for="item in filteredItems" :key="item.id" class="clothing-item">
        <div class="item-details">
          <h3>{{ item.name }}</h3>
          <p><strong>Category:</strong> {{ item.category }}</p>
          <p><strong>Description:</strong> {{ item.description }}</p>
        </div>
        <div class="item-actions">
          <button @click="editItem(item)">Edit</button>
          <button @click="deleteItem(item.id)">Delete</button>
        </div>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

// Mock data for clothing items
const items = ref([
  { id: 1, name: 'T-Shirt', category: 'tops', description: 'A comfortable cotton T-shirt.' },
  { id: 2, name: 'Jeans', category: 'bottoms', description: 'Classic blue jeans.' },
  { id: 3, name: 'Sneakers', category: 'shoes', description: 'Stylish white sneakers.' },
]);

// New item form data
const newItem = ref({
  name: '',
  category: '',
  description: '',
});

// Search and filter data
const searchQuery = ref('');
const filterCategory = ref('');

// Add a new item
const addItem = () => {
  if (!newItem.value.name || !newItem.value.category) return;

  items.value.push({
    id: items.value.length + 1,
    ...newItem.value,
  });

  // Reset the form
  newItem.value = { name: '', category: '', description: '' };
};

// Edit an item
const editItem = (item) => {
  const updatedName = prompt('Enter new name:', item.name);
  const updatedCategory = prompt('Enter new category:', item.category);
  const updatedDescription = prompt('Enter new description:', item.description);

  if (updatedName && updatedCategory) {
    item.name = updatedName;
    item.category = updatedCategory;
    item.description = updatedDescription;
  }
};

// Delete an item
const deleteItem = (id) => {
  items.value = items.value.filter((item) => item.id !== id);
};

// Filtered items based on search and category
const filteredItems = computed(() => {
  return items.value.filter((item) => {
    const matchesSearch = item.name.toLowerCase().includes(searchQuery.value.toLowerCase());
    const matchesCategory = filterCategory.value ? item.category === filterCategory.value : true;
    return matchesSearch && matchesCategory;
  });
});
</script>

<style scoped>
/* Ensure html & body fill the viewport */
html, body {
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
}

/* Fullscreen container with background image */
.wardrobe-container {
  width: 100vw;
  min-height: 100vh;
  padding: 20px;
  box-sizing: border-box;
  background: url('') no-repeat center center;
  background-size: cover;
  overflow-y: auto;
  display: flex;
  flex-direction: column;
  align-items: center;
}

/* Heading style */
.wardrobe-container h2 {
  margin-bottom: 20px;
  color: #fff;
}

/* Common content box styling */
.content-box {
  width: 90%;
  max-width: 800px;
  background: rgba(255, 255, 255, 0.8);
  padding: 15px;
  border-radius: 8px;
}

/* Add Item Form */
.add-item-form {
  display: flex;
  flex-direction: column;
  gap: 10px;
  margin-bottom: 20px;
}
.add-item-form input,
.add-item-form select,
.add-item-form textarea {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}
.add-item-form button {
  padding: 10px;
  background-color: #28a745;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
.add-item-form button:hover {
  background-color: #218838;
}

/* Filter and Search */
.filter-search {
  display: flex;
  flex-direction: column;
  gap: 10px;
  margin-bottom: 20px;
}
.filter-search input,
.filter-search select {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

/* Clothing Items List */
.clothing-items-list {
  list-style: none;
  padding: 0;
  width: 100%;
}
.clothing-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-bottom: 10px;
  background: #fff;
}
.item-details {
  flex: 1;
}
.item-actions {
  display: flex;
  gap: 10px;
}
.item-actions button {
  padding: 5px 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
.item-actions button:first-child {
  background-color: #ffc107;
  color: black;
}
.item-actions button:last-child {
  background-color: #dc3545;
  color: white;
}
.item-actions button:hover {
  opacity: 0.8;
}

/* Responsive adjustments */
@media (min-width: 768px) {
  .add-item-form, .filter-search, .clothing-items-list {
    width: 90%;
    max-width: 800px;
  }
}
</style>
