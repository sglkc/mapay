import { Router } from 'express'
import { NewUser } from '~/types/database'
import { db } from '../database'

const UserRouter = Router()

UserRouter.post<{}, {}, NewUser>('/user', async (req, res) => {
  const user = await db.insertInto('user')
    .values({ username: 'gaming' })
    .returningAll()
    .executeTakeFirstOrThrow()

  res.json({ user })
})

export default UserRouter
