import { resolve } from 'node:path'
import SQLite from 'better-sqlite3'
import { Kysely, SqliteDialect } from 'kysely'
import { Database } from '~/types/database'

const dialect = new SqliteDialect({
  database: new SQLite(resolve(import.meta.dirname, 'database.sqlite')),
})

export const db = new Kysely<Database>({
  dialect,
})
