const searchTicket = document.querySelector('#searchticket')
if (searchTicket) {
  searchTicket.addEventListener('input', async function() {
    const response = await fetch('../api/api_tickets.php?search=' + this.value)
    const tickets = await response.json()

    const section = document.querySelector('#tickets')
    section.innerHTML = ''

    for (const artist of tickets) {
      const article = document.createElement('article')
      const img = document.createElement('img')
      img.src = 'https://picsum.photos/200?' + artist.id
      const link = document.createElement('a')
      link.href = '../pages/artist.php?id=' + artist.id
      link.textContent = artist.name
      article.appendChild(img)
      article.appendChild(link)
      section.appendChild(article)
    }
  })
}