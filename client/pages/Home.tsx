export default function HomePage() {
  return (
    <>
      <div>HELL OWORDL!</div>
      <form action="http://localhost:5000/user" method="post">
        <input name="username" />
        <button type="submit">SUBMIT</button>
      </form>
    </>
  )
}
