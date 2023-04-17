<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project Management Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    .navbar {
      background-color: #ffffff;
    }


    .navbar-brand {
      font-size: 1.5rem;
      font-weight: bold;
    }

    .nav-link {
      font-size: 1.2rem;
    }

    .session-data {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      background-color: #0047AB;
      color:#ffff;
      padding: 10px;
      font-size: 1.2rem;
    }

    .add-button {
      position: fixed;
      bottom: 20px;
      right: 20px;
      width: 60px;
      height: 60px;
      background-color: rgba(0, 71, 171, 0.8);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      color: #ffffff;
      text-decoration: none;
    }
    .proj{
    text-align: center;
    padding-top: 20px;
    }
    #card-container{
        height: 45rem;
        overflow-x: hidden;
        overflow-y: auto;
        padding: 20px;
        padding-top: 20px;
}
    #search-bar {
      width: 300px;
    }
   .btn{
   border: 1px solid #ccc;
   }
  .active {
    background:#dfe0e5;
    overflow:hidden;
    border-left:2px solid #00f;
  }

  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">TaskMinder</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <form class="d-flex">
  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="search-bar">
</form>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item active">
            <a class="nav-link active" href="dashboard.php">Projects</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admininfo.php">Administrator</a>
          </li>
          <li class="nav-item">
                      <a class="nav-link logout" href="login.html">Logout</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>

  <div class="session-data">
    Hey, <?php echo $_SESSION['email'];?>

  </div>





  <div class="navbar-brand proj">Open Projects</div> <hr>

  <div class="container">
        <div class="row" id="card-container">
          <!-- Cards dynamically added here -->
        </div>
        <div class="row justify-content-center mt-5">

        </div>
      </div>


  <a href="#" class="add-button" id="add-card-btn">+</a>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
  <script>
  // Keep track of number of cards added
  let cardCount = 0;
  let cardsData = [];

  // Add event listener for add-card-btn
  const addCardBtn = document.getElementById('add-card-btn');
  addCardBtn.addEventListener('click', addCard);

  // Load card data from local storage when the page is loaded
  window.addEventListener('load', () => {
    const savedCardsData = localStorage.getItem('cardsData');
    if (savedCardsData) {
      cardsData = JSON.parse(savedCardsData);
      cardCount = cardsData.length;
      renderCards();
    }
  });

  // Add event listener for search-bar input
  const searchBar = document.getElementById('search-bar');
  searchBar.addEventListener('input', filterCards);

  function addCard() {
    // Prompt user for title and description
    const title = prompt('Enter a title for the new card:');
    const description = prompt('Enter a description for the new card:');

    if (title && description) {
      // Increment card count and add new card data to cardsData array
      cardCount++;
      const cardData = { title, description };
      cardsData.push(cardData);

      // Save cardsData to local storage
      localStorage.setItem('cardsData', JSON.stringify(cardsData));

      renderCards();
    }
  }

  function renderCards() {
    // Clear the existing cards HTML
    const cardContainer = document.getElementById('card-container');
    cardContainer.innerHTML = '';

    // Loop through the cardsData array and generate card HTML for each card
    cardsData.forEach((cardData, index) => {
      const cardHTML = `
        <div class="col-sm 3">
          <div class="card" style="width:300px">
            <img class="card-img-top" src="images/card.jpeg" alt="Card image" style="width:100%">
            <div class="card-body">
              <h4 class="card-title">${cardData.title}</h4>
              <p class="card-text">${cardData.description}</p>
              <a href="projectView.php?title=${cardData.title}" class="btn btn-light">Manage</a>
              <button class="btn btn-dark delete-card-btn" data-card-index="${index}">X</button>
            </div>
          </div>
        </div>
      `;

      // Add new card HTML to card-container
      cardContainer.insertAdjacentHTML('beforeend', cardHTML);
    });

    // Add event listener for delete-card-btn
    const deleteCardBtns = document.querySelectorAll('.delete-card-btn');
    deleteCardBtns.forEach((btn) => {
      btn.addEventListener('click', deleteCard);
    });
  }

  function deleteCard(event) {
    const cardIndex = event.target.dataset.cardIndex;
    const confirmation = confirm("Are you sure you want to delete this card?");
    if (confirmation) {
      cardsData.splice(cardIndex, 1);
      localStorage.setItem('cardsData', JSON.stringify(cardsData));
      renderCards();
    }
  }

  function filterCards() {
    // Get the search query from the search bar
    const query = searchBar.value.toLowerCase();

    // Filter the cardsData array based on the search query
    const filteredCardsData = cardsData.filter((cardData) => {
      return cardData.title.toLowerCase().includes(query) || cardData.description.toLowerCase().includes(query);
    });

    // Update the cards displayed on the page
    cardsData = filteredCardsData;
    renderCards();
  }
</script>

</body>
</html>
