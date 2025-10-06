import axios from 'axios'

const API_BASE_URL = import.meta.env.DEV 
  ? 'http://localhost/rintegra/backend/public/api'  // Local XAMPP
  : 'https://r-integra.com/api'                     // Producción

const notesApi = {
  // Obtener todas las notas
  async getAll() {
    try {
      console.log('Fetching notes from:', `${API_BASE_URL}/notes`)
      const response = await axios.get(`${API_BASE_URL}/notes`)
      console.log('Notes response:', response.data)
      return response.data
    } catch (error) {
      console.error('Error fetching notes:', error)
      console.error('API URL:', `${API_BASE_URL}/notes`)
      console.error('Error details:', error.response || error.message)
      throw error
    }
  },

  // Obtener una nota por ID
  async getById(id) {
    try {
      const response = await axios.get(`${API_BASE_URL}/notes/${id}`)
      return response.data
    } catch (error) {
      console.error('Error fetching note:', error)
      throw error
    }
  },

  // Crear nueva nota
  async create(noteData) {
    try {
      const response = await axios.post(`${API_BASE_URL}/notes`, noteData)
      return response.data
    } catch (error) {
      console.error('Error creating note:', error)
      throw error
    }
  },

  // Actualizar nota
  async update(id, noteData) {
    try {
      const response = await axios.put(`${API_BASE_URL}/notes/${id}`, noteData)
      return response.data
    } catch (error) {
      console.error('Error updating note:', error)
      throw error
    }
  },

  // Eliminar nota
  async delete(id) {
    try {
      const response = await axios.delete(`${API_BASE_URL}/notes/${id}`)
      return response.data
    } catch (error) {
      console.error('Error deleting note:', error)
      throw error
    }
  },

  // Buscar notas
  async search(query, filters = {}) {
    try {
      const params = new URLSearchParams({
        q: query,
        ...filters
      })
      
      const response = await axios.get(`${API_BASE_URL}/notes/search?${params}`)
      return response.data
    } catch (error) {
      console.error('Error searching notes:', error)
      throw error
    }
  },

  // Obtener categorías
  async getCategories() {
    try {
      const response = await axios.get(`${API_BASE_URL}/notes/categories`)
      return response.data
    } catch (error) {
      console.error('Error fetching categories:', error)
      throw error
    }
  }
}

export { notesApi }