import 'dotenv/config'
import express from 'express'
import ViteExpress from 'vite-express'
import UserRouter from './routes/user'

const app = express()

app.use(express.json())
app.use(express.urlencoded({ extended: true }))
app.use(UserRouter)

app.get('/message', (_, res) => void res.send('Hello from express!'))

ViteExpress.listen(app, 5173, () => console.log('Server is listening...'))
