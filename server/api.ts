import 'dotenv/config'
import { fileURLToPath } from 'node:url'
import express from 'express'
import UserRouter from './routes/user'

const PORT = Number(process.env.PORT) || 5000
const app = express()

app.use(express.json())
app.use(express.urlencoded({ extended: true }))
app.use(UserRouter)

app.get('/message', (_, res) => void res.send('Hello from express!'))

if (process.argv[1] === fileURLToPath(import.meta.url)) {
  app.listen(PORT, () => console.log(`Listening on port ${PORT}`))
}

export default app
