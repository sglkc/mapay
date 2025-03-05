import axios from 'axios'

const API_URL = import.meta.env.VITE_API_URL
const API_PORT = import.meta.env.VITE_API_PORT
const baseURL = `${API_URL}:${API_PORT}`

export const api = axios.create({
  baseURL,
})
