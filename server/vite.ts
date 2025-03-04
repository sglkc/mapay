import ViteExpress from 'vite-express'
import app from './api'

const PORT = Number(process.env.PORT) || 5173

ViteExpress.listen(app, PORT, () => console.log(`Server is listening on ${PORT}`))
