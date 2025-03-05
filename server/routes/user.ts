import { Router } from 'express'
import bcrypt from 'bcrypt'
import { NewUser } from '~/types/database'
import { db } from '../database'

const UserRouter = Router()

UserRouter.get<{ id: string }>('/user/:id', async (req, res) => {
  const user = await db.selectFrom('user')
    .where('id', '=', Number(req.params.id))
    .selectAll()
    .executeTakeFirstOrThrow()

  res.json({ user })
})

UserRouter.post<{}, {}, NewUser>('/user', async (req, res) => {
  const password = bcrypt.hashSync(req.body.password, 4)

  const values: NewUser = {
    username: req.body.username,
    password,
  }

  const user = await db.insertInto('user')
    .values(values)
    .returningAll()
    .executeTakeFirstOrThrow()

  res.json({ user })
})

export default UserRouter
