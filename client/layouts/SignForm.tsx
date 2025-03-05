import { useFormik } from 'formik'
import { NewUser } from '~/types/database'
import { api } from '../utils/axios'

export default function SignForm() {
  const formik = useFormik<NewUser>({
    initialValues: {},
    onSubmit: async (values) => {
      await api.post('/user', values)
    }
  })
  return (
    <form onSubmit={formik.handleSubmit}>
      <label for="username">Username</label>
      <input
        id="username"
        name="username"
        type="text"
        onChange={formik.handleChange}
        value={formik.values.username}
        required
      />

      <button type="submit" disabled={formik.isSubmitting}>
        Submit
      </button>
    </form>
  )
}
