import 'dotenv/config'
import express from 'express'
import ViteExpress from 'vite-express'

const app = express()

app.get('/message', (_, res) => void res.send('Hello from express!'))

ViteExpress.listen(app, 3000, () => console.log('Server is listening...'))
