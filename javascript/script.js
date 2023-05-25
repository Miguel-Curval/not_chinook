const searchTicket = document.querySelector('#searchticket')
if (searchTicket) {
  searchTicket.addEventListener('input', async function() {
    const response = await fetch('../api/api_tickets.php?search=' + this.value)
    const tickets = await response.json()

    const section = document.querySelector('#tickets')
    section.innerHTML = ''

    for (const ticket of tickets) {
      article = document.createElement('article')
      h2 = document.createElement('h2')
      article.appendChild(h2)
      article.textContent = 'ID: ' + ticket.id
      const link = document.createElement('a')
      link.href = '../pages/ticket.php?id=' + ticket.id
      link.textContent = ticket.title
      article.appendChild(link)
      section.appendChild(article)
    }
  })
}